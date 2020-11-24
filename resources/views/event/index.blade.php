@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Eventos <small>Gestión de Eventos</small></h1>
        </div>
    </div>
    {!! Form::open(['route'=>'event.index', 'method'=>'get', 'class'=>'form']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group custom-search-form">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre de evento">
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
            @permission('create-events')
                <a href="{{route('event.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear</a>
                <br><br>
            @endpermission
            <div class="panel panel-default">
                <div class="panel-heading">
                    Eventos del sistema
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Fecha Inicio</th>
                                <th style="text-align: center">Fecha Fin</th>
                                <th style="text-align: center">Sede</th>
                                <th style="text-align: center">Ciudad</th>
                                <th style="text-align: center">Fecha Creación</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr class="odd gradeX" data-name="{{$event->name}}" data-id="{{$event->id}}">
                                    <td>{{$event->name}}</td>
                                    <td>{{$event->start_date}}</td>
                                    <td>{{$event->end_date}}</td>
                                    <td>{{$event->headquarters}}</td>
                                    <td>{{$event->city}}</td>
                                    <td>{{$event->created_at}}</td>
                                    <td align="center">{{$event->statusName}}</td>
                                    <td>
                                        @permission('create-events')
                                            <a href="{{route('event.edit', $event->id)}}" class="btn btn-xs btn-info" title="Editar Evento">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        @endpermission
                                        @permission('change-status-events')
                                            <a class="btn btn-xs btn-{{($event->status)?'danger':'success'}} changeStatus" title="{{($event->status)?'Desactivar':'Activar'}} Evento">
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
                var event = $(this).closest('tr').data('name');
                var id = $(this).closest('tr').data('id');
                bootbox.confirm({
                    message: "¿Está Seguro que desea cambiar el estado del evento : <b>"+event+"</b>?",
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
                            $.post('event/changeStatus/' + id, function(data, status){
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