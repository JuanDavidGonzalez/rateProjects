@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($college)
                <h1 class="page-header">Instituciones <small>Editar Institución</small></h1>
            @else
                <h1 class="page-header">Instituciones <small>Crear Nueva Institución</small></h1>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($college)
                        Formulario Edición  Institución
                    @else
                        Formulario Registro Nueva Institución
                    @endif
                </div>
                <div class="panel-body">
                    @if($college)
                        {!! Form::model($college,['route'=>['college.update', $college->id], 'method'=>'put', 'class'=>'form']) !!}
                    @else
                        {!! Form::open(['route'=>'college.store', 'method'=>'post', 'class'=>'form']) !!}
                    @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nombre <span class="">*</span></label>
                                        {!! Form::text('name', null,['class'=>'form-control', 'placeholder'=>'Nombre institución']) !!}
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
                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                    <label>Ciudad</label>
                                    {!! Form::text('city', null,['class'=>'form-control', 'placeholder'=>'Ciudad sede']) !!}
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" align="center">
                            <button  type="submit" class="btn btn-success">Guardar</button>
                            <a  href="{{route('college.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection