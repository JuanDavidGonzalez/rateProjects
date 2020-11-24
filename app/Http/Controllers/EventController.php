<?php 

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller 
{

    public function index(Request $request)
    {
        $events = Event::search($request->get('search'))->get();
        return view('event.index', compact('events'));
    }

    public function create()
    {
        $event=0;
        return view('event.create', compact('event'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'headquarters'=>'required',
            'city'=>'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
        }
        $event = new Event();
        $event->fill($request->all());
        $event->save();
        return redirect(route('event.index'))->with('success', 'Evento Creado Exitosamente!');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.create', compact('event'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'headquarters'=>'required',
            'city'=>'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('fail', 'Datos proporcionados invalidos');
        }
        $event = Event::findOrFail($id);
        $event->fill($request->all());
        $event->update();
        return redirect(route('event.index'))->with('success', 'Evento Editado Exitosamente !');
    }

    public function changeStatus($id)
    {
        $event = Event::findOrFail($id);
        $event->status = !$event->status;
        $event->update();
        return response()->json("Estado modificado a $event->statusName", 200);
    }
  
}