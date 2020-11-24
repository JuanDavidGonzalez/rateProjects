<?php

namespace App\Http\Controllers;

use App\College;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::search($request->get('search'))->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $user = 0;
        $colleges = College::pluck('name', 'id')->prepend('Seleccionar', -1);
        return view('user.create', compact('user', 'colleges'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput($request->except('password'))->with('fail', 'Datos proporcionados invalidos');
        }
        $user = new User();
        if ($request->college_id== -1)
            $req =  $request->except('college_id');
        else
            $req = $request->all();

        $user->fill($req);
        if($request->password != '')
            $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('user.index'))->with('success', 'Usuario Creado Exitosamente!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $colleges = College::pluck('name', 'id')->prepend('Seleccionar', -1);
        return view('user.create', compact('user', 'colleges'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|email|',
            'password'=>'required|min:6|confirmed',
//            'phone'=>'min:7',
//            'cell_phone'=>'min:10',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput($request->except('password'))->with('fail', 'Datos proporcionados invalidos');
        }
        $user = User::findOrFail($id);

        if ($request->college_id== -1)
            $req =  $request->except('college_id');
        else
            $req = $request->all();

        $user->fill($req);
        if($request->password != '')
            $user->password = Hash::make($request->password);

        $user->update();
        return redirect(route('user.index'))->with('success', 'Usuario Editado Exitosamente!');

    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->update();
        return response()->json("Estado modificado a $user->statusName", 200);
    }
}
