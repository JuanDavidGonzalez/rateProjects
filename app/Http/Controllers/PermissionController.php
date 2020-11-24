<?php
/**
 * Created by PhpStorm.
 * User: Juan David
 * Date: 17/12/2018
 * Time: 6:29 PM
 */

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function create()
    {
        $perm = false;
        $action = 'Crear Permiso';
        $roles = Role::all();
        $roles = $roles->pluck('display_name','id');
        return view('entrust.perms.perm',compact('roles','action','perm'));
    }

    public function edit($id)
    {
        $perm = Permission::findOrFail($id);
        $action = 'Editar Permiso';
        $roles = Role::all();
        $roles = $roles->pluck('display_name','id');
        return view('entrust.perms.perm',compact('roles','action','perm'));
    }

    public function update($id, Request $request)
    {
        $perm = Permission::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'display_name' => 'required',
        ]);
        if($validator->fails())
            return redirect()->route('perms.edit')->withErrors($validator)->withInput();
        else{
            $perm->fill($request->all());
            $perm->roles()->sync([]);
            $perm->roles()->attach($request->roles);
            $perm->save();
            return Redirect::to(route('profile.index') . "#permissions")->with('success','El Permiso "' . $perm->display_name . '" fue actualizado exitosamente');
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4|unique:permissions',
            'display_name' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->route('perms.create')->withErrors($validator)->withInput();
        }
        else{
            $perm = new Permission();
            $perm->fill($request->all());
            $perm->save();
            $perm->roles()->sync([]);
            $perm->roles()->attach($request->roles);
            return Redirect::to(route('profile.index') . "#permissions")->with('success','El Permiso "' . $perm->display_name . '" fue guardado exitosamente');
        }
    }
}
