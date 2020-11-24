<?php 

namespace App\Http\Controllers;

use App\Participant;
use App\Project;
use App\Seedbed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller 
{

  public function store(Request $request)
  {
//      dd($request->all());
      $rules = [
          'nameP'=> 'required',
          'type'=> 'required',
      ];
    if($request->class=='project'){
      $obj = Project::findOrFail($request->project_id);
      if($obj->participants->count()>=2)
          return back()->with('fail', 'No se puede agregar mas de dos ponentes');

        $rules['document_type']='required|not_in:-1';
        $rules['email']='required|email';
        $rules['document_num']='required|min:4';
        $rules['phone']='required|min:7';
    }
    else {
      $obj = Seedbed::findOrFail($request->seedbed_id);
    }

    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()){
      return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
    }

    $obj->participants()->create([
        'name'=>$request->nameP,
        'type'=>$request->type,
        'document_type'=>$request->document_type,
        'email'=>$request->email,
        'document_num'=>$request->document_num,
        'phone'=>$request->phone,
    ]);
      return back()->with('success', 'Participante agregado Exitosamente !');
  }


  public function destroy($id)
  {
    Participant::destroy($id);
    return back()->with('warning', 'Participante eliminado!');
  }
  
}
