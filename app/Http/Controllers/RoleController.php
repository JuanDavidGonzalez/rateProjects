<?php
/**
 * Created by PhpStorm.
 * User: Juan David
 * Date: 17/12/2018
 * Time: 6:28 PM
 */

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $perms = Permission::all();
        $nroRol = 0;
        $nroPerm = 0;
        return view('entrust.roles-perms',compact('roles','nroRol','nroPerm','perms'));
    }
    public function create()
    {
        $role = false;
        $action = 'Crear Rol';
//        foreach (User::all() as $user){
//            $users[$user->id] = $user->fullname;
//        }
        $users = User::pluck('name', 'id');
        $perms = Permission::all();
        $perms = $perms->pluck('display_name','id');
        return view('entrust.roles.role',compact('perms','action','users','role'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $action = 'Editar Rol';
        $users = User::orderBy('id',"ASC")->get();
        $users = $users->pluck('name', 'id');
        $perms = Permission::all();
        $perms = $perms->pluck('display_name','id');
        return view('entrust.roles.role',compact('perms','action','role','users'));
    }

    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'display_name' => 'required',
        ]);
        if($validator->fails())
            return redirect()->route('roles.edit')->withErrors($validator)->withInput();
        else{
            $role->fill($request->all());
            $role->users()->sync([]);
            $role->perms()->sync([]);
            $role->users()->attach($request->users);
            $role->perms()->attach($request->perms);
            $role->save();
            return redirect()->route('profile.index')->with('success','El Rol "' . $role->display_name . '" fue actualizado exitosamente');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4|unique:roles',
            'display_name' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->route('roles.create')->withErrors($validator)->withInput();
        }
        else{
            $role = new Role;
            $role->fill($request->all());
            $role->save();
            $role->users()->sync([]);
            $role->perms()->sync([]);
            $role->users()->attach($request->users);
            $role->perms()->attach($request->perms);
            return redirect()->route('profile.index')->with('success','El Rol "' . $role->display_name . '" fue guardado exitosamente');
        }
    }
}
