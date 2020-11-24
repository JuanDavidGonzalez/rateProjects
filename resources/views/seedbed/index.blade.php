@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Semilleros <small>Gestión de Semilleros</small></h1>
        </div>
    </div>
    {!! Form::open(['route'=>'seedbed.index', 'method'=>'get', 'class'=>'form']) !!}
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
            @permission('create-seedbeds')
                <a href="{{route('seedbed.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear</a>
                <br><br>
            @endpermission
            <div class="panel panel-default">
                <div class="panel-heading">
                    Semilleros del sistema
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Siglas</th>
                                <th style="text-align: center">Àrea de Conocimiento</th>
                                <th style="text-align: center">Participantes</th>
                                <th style="text-align: center">Fecha Creación</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seedbeds as $seedbed)
                                <tr class="odd gradeX" data-name="{{$seedbed->name}}" data-id="{{$seedbed->id}}">
                                    <td>{{$seedbed->name}}</td>
                                    <td>{{$seedbed->initials}}</td>
                                    <td>{{$seedbed->line}}</td>
                                    <td align="center">{{$seedbed->participants->count()}}</td>
                                    <td>{{$seedbed->created_at}}</td>
                                    <td align="center">{{$seedbed->statusName}}</td>
                                    <td>
                                        @permission('create-seedbeds')
                                            <a href="{{route('seedbed.edit', $seedbed->id)}}" class="btn btn-xs btn-info" title="Editar Semillero">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        @endpermission
                                        {{--<a href="" class="btn btn-xs btn-warning" title="Ver Detalles">--}}
                                            {{--<span class="glyphicon glyphicon-eye-close"></span>--}}
                                        {{--</a>--}}
                                        @permission('change-status-seedbed')
                                            <a class="btn btn-xs btn-{{($seedbed->status)?'danger':'success'}} changeStatus" title="{{($seedbed->status)?'Desactivar':'Activar'}} Semillero">
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
                var seedbed = $(this).closest('tr').data('name');
                var id = $(this).closest('tr').data('id');
                bootbox.confirm({
                    message: "¿Está Seguro que desea cambiar el estado del Semillero : <b>"+seedbed+"</b>?",
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
                            $.post('seedbed/changeStatus/' + id, function(data){
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
