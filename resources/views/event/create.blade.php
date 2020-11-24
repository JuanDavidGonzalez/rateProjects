@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($event)
                <h1 class="page-header">Eventos <small>Editar Evento</small></h1>
            @else
                <h1 class="page-header">Eventos <small>Crear Nuevo Evento</small></h1>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($event)
                        Formulario Edición  Evento
                    @else
                        Formulario Registro Nuevo Evento
                    @endif
                </div>
                <div class="panel-body">
                    @if($event)
                        {!! Form::model($event,['route'=>['event.update', $event->id], 'method'=>'put', 'class'=>'form']) !!}
                    @else
                        {!! Form::open(['route'=>'event.store', 'method'=>'post', 'class'=>'form']) !!}
                    @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nombre <span class="">*</span></label>
                                        {!! Form::text('name', null,['class'=>'form-control', 'placeholder'=>'Nombre evento']) !!}
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                    <label>Fecha Inicio<span class="">*</span></label>
                                    {!! Form::date('start_date', null,['class'=>'form-control', 'placeholder'=>'Fecha inicio']) !!}
                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('end_date') ? ' has-error' : '' }}">
                                    <label>Fecha Finalización<span class="">*</span></label>
                                    {!! Form::date('end_date', null,['class'=>'form-control', 'placeholder'=>'Fecha Finalización']) !!}
                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                    <label>Ciudad<span class="">*</span></label>
                                    {!! Form::text('city', null,['class'=>'form-control', 'placeholder'=>'Ciudad sede']) !!}
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('headquarters') ? ' has-error' : '' }}">
                                    <label>Sede<span class="">*</span></label>
                                    {!! Form::text('headquarters', null,['class'=>'form-control', 'placeholder'=>'Sede']) !!}
                                    @if ($errors->has('headquarters'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('headquarters') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" align="center">
                            <button  type="submit" class="btn btn-success">Guardar</button>
                            <a  href="{{route('event.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection