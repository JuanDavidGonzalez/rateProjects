<?php 

namespace App\Http\Controllers;

use App\College;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller 
{

    public function index(Request $request)
    {
        $groups = Group::search($request->get('search'))->get();
        return view('group.index', compact('groups'));
    }

    public function create()
    {
        $group=0;
        $colleges = College::pluck('name', 'id')->prepend('Seleccionar',-1);
        return view('group.create', compact('group', 'colleges'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'interest_area'=> 'required',
            'initials'=> 'required',
            'colciencias'=>'required|not_in:-1',
            'college_id'=>'required|not_in:-1',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
        }
        $group = new Group();
        $group->fill($request->all());
        $group->save();
        return redirect(route('group.index'))->with('success', 'Grupo Creado Exitosamente!');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $colleges = College::pluck('name', 'id')->prepend('Seleccionar',-1);
        return view('group.create', compact('group', 'colleges'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'interest_area'=> 'required',
            'initials'=> 'required',
            'colciencias'=>'required|not_in:-1',
            'college_id'=>'required|not_in:-1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password'))->with('fail', 'Datos proporcionados invalidos');
        }
        $group = Group::findOrFail($id);
        $group->fill($request->all());
        $group->update();
        return redirect(route('group.index'))->with('success', 'Grupo Editado Exitosamente !');
    }

    public function changeStatus($id)
    {
        $group = Group::findOrFail($id);
        $group->status = !$group->status;
        $group->update();
        return response()->json("Estado modificado a $group->statusName", 200);
    }
  
}