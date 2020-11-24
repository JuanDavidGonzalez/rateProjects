@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Asignaciones <small>Gestión de Asignaciones</small></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @permission('create-assigments')
                <a href="{{route('assignment.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear</a>
                <br><br>
            @endpermission
            <div class="panel panel-default">
                <div class="panel-heading">
                    Asignaciones del sistema
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align: center">Id</th>
                                <th style="text-align: center">Proyecto</th>
                                <th style="text-align: center">Salon</th>
                                <th style="text-align: center">Día</th>
                                <th style="text-align: center">Hora</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $assignment)
                                <tr class="odd gradeX">
                                    <td align="center">{{$assignment->id}}</td>
                                    <td>{{$assignment->project->name}} [{{$assignment->project->statusName}} ]</td>
                                    <td>Salon {{$assignment->classroom}}</td>
                                    <td>{{$assignment->dayEs}}</td>
                                    <td>{{$assignment->hour}}</td>
                                    <td>
                                        @permission('create-assigments')
                                            <a href="{{route('assignment.edit', $assignment->id)}}" class="btn btn-xs btn-info" title="Editar Asignación">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
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