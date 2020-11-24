@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Usuarios <small>Gestión de Usuarios</small></h1>
            </div>
        </div>

        {!! Form::open(['route'=>'user.index', 'method'=>'get', 'class'=>'form']) !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group custom-search-form">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o correo">
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
                <a href="{{route('user.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear</a>
                <br><br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Usuarios del sistema
                    </div>
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Fecha Creación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="odd gradeX" data-name="{{$user->name}}" data-id="{{$user->id}}">
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->statusName}}</td>
                                    <td class="center">
                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-xs btn-info" title="Editar Usuario">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        @permission('change-status-user')
                                            <a class="btn btn-xs btn-{{($user->status)?'danger':'success'}} changeStatus" title="{{($user->status)?'Desactivar':'Activar'}} Usuario">
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
                var user = $(this).closest('tr').data('name');
                var id = $(this).closest('tr').data('id');
                bootbox.confirm({
                    message: "¿Está Seguro que desea cambiar el estado del usuario : <b>"+user+"</b>?",
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
                            $.post('user/changeStatus/' + id, function(data, status){
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