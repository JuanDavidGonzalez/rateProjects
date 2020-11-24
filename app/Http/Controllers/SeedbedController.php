<?php 

namespace App\Http\Controllers;

use App\Group;
use App\Seedbed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeedbedController extends Controller 
{
    public function index(Request $request)
    {
        $seedbeds = Seedbed::search($request->get('search'))->get();
        return view('seedbed.index', compact('seedbeds'));
    }

    public function create()
    {
        $seedbed=0;
        $groups=Group::where('status', 1)->pluck('name', 'id')->prepend('Seleccionar', -1);
        return view('seedbed.create', compact('seedbed' , 'groups'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'line'=> 'required',
            'initials'=> 'required',
            'group_id'=>'required|not_in:-1',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
        }
        $seedbed = new Seedbed();
        $seedbed->fill($request->all());
        $seedbed->save();
        return redirect(route('seedbed.edit', $seedbed->id))->with('success', 'Semillero Creado Exitosamente, ahora debe agregar los miembros');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $seedbed = Seedbed::findOrFail($id);
        $groups=Group::where('status', 1)->pluck('name', 'id')->prepend('Seleccionar', -1);

        return view('seedbed.create', compact('seedbed', 'groups'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'line'=> 'required',
            'initials'=> 'required',
            'group_id'=>'required|not_in:-1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password'))->with('fail', 'Datos proporcionados invalidos');
        }
        $seedbed = Seedbed::findOrFail($id);
        $seedbed->fill($request->all());
        $seedbed->update();
        return redirect(route('seedbed.index'))->with('success', 'Semillero Editado Exitosamente !');
    }

    public function changeStatus($id)
    {
        $seedbed = Seedbed::findOrFail($id);
        $seedbed->status = !$seedbed->status;
        $seedbed->update();
        return response()->json("Estado modificado a $seedbed->statusName", 200);
    }
  
}