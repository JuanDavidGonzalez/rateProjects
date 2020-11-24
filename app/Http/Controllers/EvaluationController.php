<?php 

namespace App\Http\Controllers;

use App\Criterion;
use App\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller 
{

    public function index()
    {
        $user = Auth::user();
        $evaluations = collect();
        if($user->can(['see-all-evaluations']))
            $evaluations = Evaluation::all();
        elseif ($user->can(['see-evaluations']))
            $evaluations = Evaluation::where('user_id', $user->id)->get();
        return view('evaluation.index', compact('evaluations'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'score.*'=> 'required',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('fail', 'Dbe ingresar un puntaje valido');
        }
        $evaluation = Evaluation::findOrFail($request->evaluation_id);
        foreach ($request->score as $key=>$value){
          $evaluation->criteria()->attach($key, ['score'=>$value, 'observation'=>$request->observation[$key]]);
        }

        return redirect(route('evaluation.index'))->with('success', 'Proyecto Evaluado Exitosamente');
    }

    public function show($id)
    {
        $evaluation = Evaluation::with('criterion')->findOrFail($id);
        return view('evaluation.show', compact('evaluation'));
    }

    public function edit($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $criteria = Criterion::all();
        return view('evaluation.rate', compact('criteria', 'evaluation'));
    }
  
}