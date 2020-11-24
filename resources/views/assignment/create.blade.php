@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($assignment)
                <h1 class="page-header">Asignación <small>Editar Asignación</small></h1>
            @else
                <h1 class="page-header">Asignación <small>Crear Nuevo Asignación</small></h1>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($assignment)
                        Formulario Edición  Asignación
                    @else
                        Formulario Registro Nueva Asignación
                    @endif
                </div>
                <div class="panel-body">
                    @if($assignment)
                        {!! Form::model($assignment,['route'=>['assignment.update', $assignment->id], 'method'=>'put', 'class'=>'form']) !!}
                    @else
                        {!! Form::open(['route'=>'assignment.store', 'method'=>'post', 'class'=>'form']) !!}
                    @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('project_id') ? ' has-error' : '' }}">
                                    <label>Proyecto</label>
                                    {!! Form::select('project_id', $projects, null,['class'=>'form-control']) !!}
                                    @if ($errors->has('project_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('project_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('users.1') ? ' has-error' : '' }}">
                                    <label>Asesor 1 <span class="">*</span></label>
                                    {!! Form::select('users[1]', $evaluators, ($assignment)?$assignment->users->first()->id:null, ['class'=>'form-control']) !!}
                                    @if ($errors->has('users.1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('users.1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('users.2') ? ' has-error' : '' }}">
                                    <label>Asesor 2 <span class="">*</span></label>
                                    {!! Form::select('users[2]', $evaluators, ($assignment)?$assignment->users->last()->id:null,['class'=>'form-control']) !!}
                                    @if ($errors->has('users.2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('users.2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('classroom') ? ' has-error' : '' }}">
                                    <label>Salon<span class="">*</span></label>
                                    {!! Form::select('classroom', $classrooms, null,['class'=>'form-control']) !!}
                                    @if ($errors->has('classroom'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('classroom') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('day') ? ' has-error' : '' }}">
                                    <label>Día<span class="">*</span></label>
                                    {!! Form::select('day', $days, null,['class'=>'form-control']) !!}
                                    @if ($errors->has('day'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('day') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('hour') ? ' has-error' : '' }}">
                                    <label>Hora<span class="">*</span></label>
                                    {!! Form::select('hour', $hours, null,['class'=>'form-control']) !!}
                                    @if ($errors->has('hour'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('hour') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" align="center">
                            <button  type="submit" class="btn btn-success">Guardar</button>
                            <a  href="{{route('assignment.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection