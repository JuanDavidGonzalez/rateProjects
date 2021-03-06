@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Grupos <small>Gestión de Grupos</small></h1>
        </div>
    </div>
    {!! Form::open(['route'=>'group.index', 'method'=>'get', 'class'=>'form']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group custom-search-form">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o iniciales">
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
            @permission('create-groups')
                <a href="{{route('group.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear</a>
                <br><br>
            @endpermission
            <div class="panel panel-default">
                <div class="panel-heading">
                    Grupos del sistema
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Siglas</th>
                                <th style="text-align: center">Institución</th>
                                <th style="text-align: center">Área Interés</th>
                                <th style="text-align: center">Colciencias</th>
                                <th style="text-align: center">Fecha Creación</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                                <tr class="odd gradeX" data-name="{{$group->name}}" data-id="{{$group->id}}">
                                    <td>{{$group->name}}</td>
                                    <td>{{$group->initials}}</td>
                                    <td>{{($group->college)?$group->college->name:'--'}}</td>
                                    <td>{{$group->interest_area}}</td>
                                    <td>{{$group->colcienciasName}}</td>
                                    <td>{{$group->created_at}}</td>
                                    <td>{{$group->statusName}}</td>
                                    <td>
                                        @permission('create-groups')
                                            <a href="{{route('group.edit', $group->id)}}" class="btn btn-xs btn-info" title="Editar Grupo">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        @endpermission
                                        @permission('change-status-groups')
                                            <a class="btn btn-xs btn-{{($group->status)?'danger':'success'}} changeStatus" title="{{($group->status)?'Desactivar':'Activar'}} Grupo">
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
                var group = $(this).closest('tr').data('name');
                var id = $(this).closest('tr').data('id');
                bootbox.confirm({
                    message: "¿Está Seguro que desea cambiar el estado del grupo : <b>"+group+"</b>?",
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
                            $.post('group/changeStatus/' + id, function(data, status){
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