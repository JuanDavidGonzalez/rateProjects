<?php 

namespace App\Http\Controllers;

use App\Assignment;
use App\Evaluation;
use App\Project;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller 
{

    public function index()
    {
        $assignments = Assignment::all();
        return view('assignment.index', compact('assignments'));
    }

    public function create()
    {
        $assignment=0;
        $evaluators = Role::where('name', 'evaluator')->first()->users->pluck('name', 'id')->prepend('Seleccionar', -1);
        $classrooms = [-1=>'Seleccionar'];
        for ($i=1; $i<16; $i++) {
            $classrooms[$i] = "Salon " . $i;
        }
        $days= [-1=>'Seleccionar', 'wednesday'=>'Miércoles', 'thursday'=>'Jueves'];
        $hours = [
            -1=>'Seleccionar',
            '09:30 - 09:55'=>'09:30 - 09:55',
            '09:55 - 10:20'=>'09:55 - 10:20',
            '10:50 - 11:15'=>'10:50 - 11:15',
            '11:15 - 11:40'=>'11:15 - 11:40',
            '11:40 - 12:05'=>'11:40 - 12:05',
            '02:00 - 02:25'=>'02:00 - 02:25',
            '02:25 - 02:50'=>'02:25 - 02:50',
            '02:50 - 03:15'=>'02:50 - 03:15',
            '03:15 - 03:40'=>'03:15 - 03:40'
        ];
        $projects=[-1=>'Seleccionar'];
        foreach (Project::all() as $project){
            if($project->enable)
                $projects[$project->id] =$project->name.' [ '.$project->statusName.' - '.$project->projectable->initials.' ]';
        }
        return view('assignment.create', compact('assignment' , 'evaluators', 'hours', 'days', 'classrooms', 'projects'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'project_id'=> 'required|not_in:-1',
            'classroom'=> 'required|not_in:-1',
            'day'=> 'required|not_in:-1',
            'hour'=> 'required|not_in:-1',
            'users.*'=> 'distinct',
            'users[1]*'=> 'required|not_in:-1',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
        }
        $assignment = new Assignment();
        $assignment->fill($request->all());
        $assignment->save();

        $evaluators = $request->users;
        foreach ($evaluators as $evaluator){
            if ($evaluator != "-1")
                $assignment->users()->attach($evaluator);
        }

        foreach ($request->users as $key=>$value){
            if ($value != "-1") {
                $evaluation = new Evaluation();
                $evaluation->project_id = $request->project_id;
                $evaluation->user_id = $value;
                $evaluation->save();
            }
        }

        return redirect(route('assignment.index'))->with('success', 'Asignación Creada Exitosamente');
    }


    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $evaluators = Role::where('name', 'evaluator')->first()->users->pluck('name', 'id')->prepend('Seleccionar', -1);
        $classrooms = [-1=>'Seleccionar'];
        for ($i=1; $i<16; $i++) {
            $classrooms[$i] = "Salon " . $i;
        }
        $days= [-1=>'Seleccionar', 'wednesday'=>'Miércoles', 'thursday'=>'Jueves'];
        $hours = [
            -1=>'Seleccionar',
            '09:30 - 09:55'=>'09:30 - 09:55',
            '09:55 - 10:20'=>'09:55 - 10:20',
            '10:50 - 11:15'=>'10:50 - 11:15',
            '11:15 - 11:40'=>'11:15 - 11:40',
            '11:40 - 12:05'=>'11:40 - 12:05',
            '02:00 - 02:25'=>'02:00 - 02:25',
            '02:25 - 02:50'=>'02:25 - 02:50',
            '02:50 - 03:15'=>'02:50 - 03:15',
            '03:15 - 03:40'=>'03:15 - 03:40'
        ];
        $projects=[-1=>'Seleccionar'];
        foreach (Project::all() as $project){
            $projects[$project->id] =$project->name.' [ '.$project->status.' - '.$project->projectable->initials.' ]';
        }
        return view('assignment.create', compact('assignment' , 'evaluators', 'hours', 'days', 'classrooms', 'projects'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'project_id'=> 'required|not_in:-1',
            'classroom'=> 'required|not_in:-1',
            'day'=> 'required|not_in:-1',
            'hour'=> 'required|not_in:-1',
            'users.*'=> 'distinct',
            'users[1]*'=> 'required|not_in:-1',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
        }
        $assignment = Assignment::findOrFail($id);
        $assignment->fill($request->all());
        $assignment->update();
        $assignment->users()->sync([]);

        $evaluators = $request->users;
        foreach ($evaluators as $evaluator){
            if ($evaluator != "-1")
                $assignment->users()->attach($evaluator);
        }

        Evaluation::where('project_id', $request->project_id)->delete();
        foreach ($request->users as $key=>$value){
            if ($value != "-1") {
                $evaluation = new Evaluation();
                $evaluation->project_id = $request->project_id;
                $evaluation->user_id = $value;
                $evaluation->save();
            }
        }

        return redirect(route('assignment.index'))->with('success', 'Asignación Editado Exitosamente !');
    }
  
}