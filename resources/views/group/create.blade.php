@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($group)
                <h1 class="page-header">Grupos <small>Editar Grupo</small></h1>
            @else
                <h1 class="page-header">Grupos <small>Crear Nuevo Grupo</small></h1>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($group)
                        Formulario Edición  Grupo
                    @else
                        Formulario Registro Nuevo Grupo
                    @endif
                </div>
                <div class="panel-body">
                    @if($group)
                        {!! Form::model($group,['route'=>['group.update', $group->id], 'method'=>'put', 'class'=>'form']) !!}
                    @else
                        {!! Form::open(['route'=>'group.store', 'method'=>'post', 'class'=>'form']) !!}
                    @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nombre <span class="">*</span></label>
                                        {!! Form::text('name', null,['class'=>'form-control', 'placeholder'=>'Nombre Grupo']) !!}
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
                                <div class="form-group {{ $errors->has('interest_area') ? ' has-error' : '' }}">
                                    <label>Área Interés<span class="">*</span></label>
                                    {!! Form::text('interest_area', null,['class'=>'form-control', 'placeholder'=>'Área de interés']) !!}
                                    @if ($errors->has('interest_area'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('interest_area') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('colciencias') ? ' has-error' : '' }}">
                                    <label>Colciencias<span class="">*</span></label>
                                    {!! Form::select('colciencias', [-1=>'Seleccionar',0=>'No', 1=>'Si'], null,['class'=>'form-control',]) !!}
                                    @if ($errors->has('colciencias'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('colciencias') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('college_id') ? ' has-error' : '' }}">
                                    <label>Institución<span class="">*</span></label>
                                    {!! Form::select('college_id', $colleges, null,['class'=>'form-control',]) !!}
                                    @if ($errors->has('college_id'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('college_id') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row" align="center">
                            <button  type="submit" class="btn btn-success">Guardar</button>
                            <a  href="{{route('group.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection