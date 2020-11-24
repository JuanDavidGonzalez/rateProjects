@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($seedbed)
                <h1 class="page-header">Semilleros <small>Editar Semillero</small></h1>
            @else
                <h1 class="page-header">Semilleros <small>Crear Nuevo Semillero</small></h1>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    @if($seedbed)
                        Formulario Edición  Semillero
                    @else
                        Formulario Registro Nuevo Semillero
                    @endif
                </div>
                <div class="panel-body">
                    @if($seedbed)
                        {!! Form::model($seedbed,['route'=>['seedbed.update', $seedbed->id], 'method'=>'put', 'class'=>'form']) !!}
                    @else
                        {!! Form::open(['route'=>'seedbed.store', 'method'=>'post', 'class'=>'form']) !!}
                    @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nombre <span class="">*</span></label>
                                        {!! Form::text('name', null,['class'=>'form-control', 'placeholder'=>'Nombre Semillero']) !!}
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group {{ $errors->has('initials') ? ' has-error' : '' }}">
                                    <label>Siglas<span class="">*</span></label>
                                    {!! Form::text('initials', null,['class'=>'form-control', 'placeholder'=>'Siglas o iniciales']) !!}
                                    @if ($errors->has('initials'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('initials') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('line') ? ' has-error' : '' }}">
                                    <label>Área de Conocimiento<span class="">*</span></label>
                                    {!! Form::text('line', null,['class'=>'form-control', 'placeholder'=>'Área de interés']) !!}
                                    @if ($errors->has('line'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('line') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('group_id') ? ' has-error' : '' }}">
                                    <label>Grupo<span class="">*</span></label>
                                    {!! Form::select('group_id', $groups, null,['class'=>'form-control',]) !!}
                                    @if ($errors->has('group_id'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('group_id') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row" align="center">
                            <button  type="submit" class="btn btn-success">Guardar</button>
                            <a  href="{{route('seedbed.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @if($seedbed)
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Participantes del Semillero
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>['participant.store', $seedbed->id], 'method'=>'post', 'class'=>'form']) !!}
                            {{Form::hidden('seedbed_id', $seedbed->id)}}
                            {{Form::hidden('class', 'seedbed')}}
                            <div class="well">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group {{ $errors->has('nameP') ? ' has-error' : '' }}">
                                            <label>Nombre <span class="">*</span></label>
                                            {!! Form::text('nameP', null,['class'=>'form-control', 'placeholder'=>'Nombre']) !!}
                                            @if ($errors->has('nameP'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('nameP') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                            <label>Tipo<span class="">*</span></label>
                                            {!! Form::select('type', ['groupMember'=>'Participante', 'leader'=>'Lider', 'tutor'=>'Tutor'], null,['class'=>'form-control',]) !!}
                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                     </div>
                                    <div class="col-lg-3">
                                        <br>
                                        <button  type="submit" class="btn btn-info">Agregar</button>
                                     </div>
                                </div>
                            </div>
                        {!! Form::close() !!}

                        <div class="row">
                            <div class="col-lg-12">
                            <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Nombre</th>
                                        <th style="text-align: center">Tipo</th>
                                        <th style="text-align: center">Fecha Creación</th>
                                        <th style="text-align: center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($seedbed->participants as $participant)
                                    <tr class="odd gradeX">
                                        <td>{{$participant->name}}</td>
                                        <td>{{$participant->type}}</td>
                                        <td>{{$participant->created_at}}</td>
                                        <td class="text-center">
                                            {!! Form::open(['route'=>['participant.destroy', $participant->id], 'method'=>'DELETE', 'class'=>'form']) !!}
                                            <button  class="btn btn-xs btn-danger" title="Eliminar Participante">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" align="center">
            <a  href="{{route('seedbed.index')}}" class="btn btn-danger">Regresar</a>
        </div>
        <br>
    @endif


@endsection