<?php 

namespace App\Http\Controllers;

use App\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollegeController extends Controller 
{

  public function index(Request $request)
  {
      $colleges = College::search($request->get('search'))->get();
      return view('college.index', compact('colleges'));
  }

  public function create()
  {
      $college=0;
      return view('college.create', compact('college'));
  }

  public function store(Request $request)
  {
      $validator = Validator::make($request->all(),[
          'name'=> 'required',
          'initials'=> 'required',
          'city'=>'required',
      ]);

      if ($validator->fails()){
          return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
      }
      $college = new College();
      $college->fill($request->all());
      $college->save();
      return redirect(route('college.index'))->with('success', 'Institución Creada Exitosamente!');
  }

  public function show($id)
  {
    
  }

  public function edit($id)
  {
      $college = College::findOrFail($id);
      return view('college.create', compact('college'));
    
  }

  public function update(Request $request, $id)
  {
      $validator = Validator::make($request->all(),[
          'name'=> 'required',
          'initials'=> 'required',
          'city'=>'required',
      ]);

      if ($validator->fails()){
          return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
      }
      $college = College::findOrFail($id);
      $college->fill($request->all());
      $college->update();
      return redirect(route('college.index'))->with('success', 'Institución Editada Exitosamente !');
  }

  
}