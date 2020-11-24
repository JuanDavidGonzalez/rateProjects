@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Proyectos <small>Gestión de Proyectos</small></h1>
        </div>
    </div>
    {!! Form::open(['route'=>'project.index', 'method'=>'get', 'class'=>'form']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group custom-search-form">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o estado">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    <hr>
    <div class="row">
        <div class="col-lg-12">
            @permission('create-projects')
                <a href="{{route('project.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear</a>
                <br><br>
            @endpermission
            <div class="panel panel-default">
                <div class="panel-heading">
                    Proyectos del sistema
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Proyecto de</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Fecha Creación</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr class="odd gradeX" data-name="{{$project->name}}" data-id="{{$project->id}}">
                                    <td>{{$project->name}}</td>
                                    <td>{{$project->from}}</td>
                                    <td>{{$project->statusName}}</td>
                                    <td>{{$project->created_at}}</td>
                                    <td>
                                        @permission('create-projects')
                                            <a href="{{route('project.edit', $project->id)}}" class="btn btn-xs btn-info" title="Editar Proyecto">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        @endpermission
                                        @if(!is_null($project->file))
                                            <a target="_blank" href="{{route('project.showFile', $project->file)}}" class="btn btn-xs btn-default" title="Ver Documento">
                                                <span class="glyphicon glyphicon-file"></span>
                                            </a>
                                        @endif
                                        @permission('change-status-project')
                                            <a class="btn btn-xs btn-{{($project->enable)?'danger':'success'}} changeStatus" title="{{($project->enable)?'Deshabilitar':'Habilitar'}} Proyecto">
                                                <span class="fa fa-power-off"></span>
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

@section('js')
    <script>
        $(document).ready(function () {
            $('.changeStatus').click(function () {
                var project = $(this).closest('tr').data('name');
                var id = $(this).closest('tr').data('id');
                bootbox.confirm({
                    message: "¿Está Seguro que desea cambiar el estado del proyecto : <b>"+project+"</b>?",
                    buttons: {
                        confirm: {
                            label: 'Cambiar',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'Cancelar',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        if(result) {
                            $.post('project/changeStatus/'+id, function(data, status){
                                alert(data);
                                window.location.reload()
                            })
                            .fail(function(error) {
                                alert(error.responseJSON);
                            })
                        }
                    }
                });
            });

        });
    </script>
@endsection