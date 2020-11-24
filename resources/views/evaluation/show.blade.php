@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Retro-Alimentación <small>Proyecto: {{$evaluation->project->name}}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Criterios  Evaluación
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px">
                        <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">Criterio</th>
                                <th style="text-align: center">Ponderación</th>
                                <th style="text-align: center">Componetes</th>
                                <th style="text-align: center;; width: 80px">Puntaje</th>
                                <th style="text-align: center; width: 300px">Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluation->criterion as $criterion)
                                <tr class="odd gradeX">
                                    <td align="center">{{$criterion->id}}</td>
                                    <td>{{$criterion->name}}</td>
                                    <td align="center">
                                        {{$criterion->weighing}} %
                                    </td>
                                    <td>{{$criterion->description}}</td>
                                    <td >
                                        {{$criterion->pivot->score}}
                                    </td>
                                    <td >
                                        {{$criterion->pivot->observation}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td align="right" colspan="4">
                                    <b>Puntaje Total: </b>
                                </td>
                                <td>
                                    <b>{{$evaluation->totalScore}}</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row" align="center">
                        <a  href="{{route('evaluation.index')}}" class="btn btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection