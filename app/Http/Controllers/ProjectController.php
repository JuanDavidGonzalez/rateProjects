<?php 

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use App\Project;
use App\Seedbed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller 
{
    public function index(Request $request)
    {
        $projects = Project::search($request->get('search'))->get();
        return view('project.index', compact('projects'));
    }

    public function create()
    {
        $project=0;
        $events=Event::where('status', 1)->pluck('name', 'id')->prepend('Seleccionar', -1);
        $groups=Group::where('status', 1)->pluck('name', 'id')->prepend('Seleccionar', -1);
        $seedbeds=Seedbed::where('status', 1)->pluck('name', 'id')->prepend('Seleccionar', -1);
        return view('project.create', compact('project' , 'groups', 'seedbeds', 'events'));
    }

    public function store(Request $request)
    {
        $rules = [
                'name'=> 'required',
//                'file'=> 'required',
                'from'=> 'required|not_in:-1',
                'educational_level'=> 'required|not_in:-1',
                'status'=> 'required|not_in:-1',
                'event_id'=> 'required|not_in:-1',
                'thematic'=> 'required|not_in:-1',

        ];
        if($request->from=='seedbed') {
           $rules['seedbed_id']='required|not_in:-1';
        }
        elseif ($request->from=='group') {
            $rules['group_id']='required|not_in:-1';
        }
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
        }

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $file_name = uniqid('P_').'.'.$ext;
        \Storage::disk('local')->put($file_name,  \File::get($file));

        $project = new Project();
        $project->fill($request->all());
        $project->file = $file_name;
        if($request->from=='seedbed') {
            $project->projectable_type = Seedbed::class;
            $project->projectable_id = $request->seedbed_id;
        }
        elseif ($request->from=='group') {
            $project->projectable_type = Group::class;
            $project->projectable_id = $request->group_id;
        }
        $project->save();


        return redirect(route('project.edit', $project->id))->with('success', 'Proyecto Creado Exitosamente, ahora debe agregar los ponentes');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $groups=Group::where('status', 1)->pluck('name', 'id')->prepend('Seleccionar', -1);
        $events=Event::where('status', 1)->pluck('name', 'id')->prepend('Seleccionar', -1);
        $seedbeds=Seedbed::where('status', 1)->pluck('name', 'id')->prepend('Seleccionar', -1);

        return view('project.create', compact('project', 'groups', 'seedbeds', 'events'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'=> 'required',
//            'file'=> 'required',
            'from'=> 'required|not_in:-1',
            'educational_level'=> 'required|not_in:-1',
            'status'=> 'required|not_in:-1',
            'event_id'=> 'required|not_in:-1',
            'thematic'=> 'required|not_in:-1',

        ];
        if($request->from=='seedbed') {
            $rules['seedbed_id']='required|not_in:-1';
        }
        elseif ($request->from=='group') {
            $rules['group_id']='required|not_in:-1';
        }
        $validator = Validator::make($request->all(),$rules);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password'))->with('fail', 'Datos proporcionados invalidos');
        }
        $project = Project::findOrFail($id);
        $project->fill($request->all());
        $project->update();
        return redirect(route('project.index'))->with('success', 'Proyecto Editado Exitosamente !');
    }

    public function showFile($file)
    {
        $url = storage_path('app/').$file;
        if (Storage::exists($file))
        {
            return response()->file($url);
        }
        abort(404);
//        return response()->file($pathToFile);
    }


    public function changeStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->enable = !$project->enable;
        $project->update();

        if ($project->enable)
            return response()->json("Proyecto Habilitado", 200);
        else
            return response()->json("Proyecto Deshabilitado", 200);
    }
  
}
