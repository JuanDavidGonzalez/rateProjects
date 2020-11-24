@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Retro-Alimentación <small>Gestión de Asesorías</small></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Evaluaciones del sistema
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align: center">Id</th>
                                <th style="text-align: center">Proyecto</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Evaluador</th>
                                <th style="text-align: center">Puntaje Total</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluations as $evaluation)
                                <tr class="odd gradeX">
                                    <td align="center">{{$evaluation->id}}</td>
                                    <td>{{$evaluation->project->name}}</td>
                                    <td>{{$evaluation->project->statusName}}</td>
                                    <td>{{$evaluation->user->name}}</td>
                                    <td align="center">{{$evaluation->totalScore}}</td>
                                    <td align="center">
                                        @permission(['see-evaluations', 'see-all-evaluations'])
                                            @if($evaluation->status)
                                                <a href="{{route('evaluation.show', $evaluation->id)}}" class="btn btn-xs btn-warning" title="Ver">
                                                    <span class="fa fa-eye"></span>
                                                </a>
                                            @endif
                                        @endpermission
                                        @permission('evaluate-projects')
                                            @if(!$evaluation->status && \Illuminate\Support\Facades\Auth::id()==$evaluation->user->id)
                                                <a href="{{route('evaluation.edit', $evaluation->id)}}" class="btn btn-xs btn-success" title="Evaluar">
                                                    <span class="fa fa-check-circle"></span>
                                                </a>
                                            @endif
                                        @endpermission
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection