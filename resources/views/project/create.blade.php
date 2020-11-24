@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($project)
                <h1 class="page-header">Proyectos <small>Editar Proyecto</small></h1>
            @else
                <h1 class="page-header">Proyectos <small>Crear Nuevo Proyecto</small></h1>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($project)
                        Formulario Edición  Proyecto
                    @else
                        Formulario Registro Nuevo Proyecto
                    @endif
                </div>
                <div class="panel-body">
                    @if($project)
                        {!! Form::model($project,['route'=>['project.update', $project->id], 'method'=>'put', 'class'=>'form', 'enctype'=>"multipart/form-data"]) !!}
                    @else
                        {!! Form::open(['route'=>'project.store', 'method'=>'post', 'class'=>'form', 'enctype'=>"multipart/form-data"]) !!}
                    @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nombre <span class="">*</span></label>
                                    {!! Form::text('name', null,['class'=>'form-control', 'placeholder'=>'Nombre proyecto']) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('educational_level') ? ' has-error' : '' }}">
                                    <label>Nivel de Formación<span class="">*</span></label>
                                    {!! Form::select('educational_level', [-1=>'Seleccionar','school'=>'Básica Media', 'technical'=>'Técnico', 'technological'=>'Tecnológico', 'professional'=>'Universitario'], null,['class'=>'form-control']) !!}
                                    @if ($errors->has('educational_level'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('educational_level') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label>Estado<span class="">*</span></label>
                                    {!! Form::select('status', [-1=>'Seleccionar','proposal'=>'Propuesta', 'inprogress'=>'En Curso', 'finished'=>'Finalizado'], null,['class'=>'form-control']) !!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('event_id') ? ' has-error' : '' }}">
                                    <label>Evento<span class="">*</span></label>
                                    {!! Form::select('event_id', $events, null,['class'=>'form-control']) !!}
                                    @if ($errors->has('event_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('event_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('thematic') ? ' has-error' : '' }}">
                                    <label>Mesa Temática<span class="">*</span></label>
                                    {!! Form::select('thematic',
                                     [-1=>'Seleccionar','Desarrollo Sostenible'=>'Desarrollo Sostenible', 'Desarrollo Productivo'=>'Desarrollo Productivo', 'Investigación y Calidad en la Educación'=>'Investigación y Calidad en la Educación'],
                                      null,['class'=>'form-control']) !!}
                                    @if ($errors->has('thematic'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('thematic') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('from') ? ' has-error' : '' }}">
                                    <label>Proyecto De<span class="">*</span></label>
                                    {!! Form::select('from', [-1=>'Seleccionar','seedbed'=>'Semillero', 'group'=>'Grupo'], null,['class'=>'form-control']) !!}
                                    @if ($errors->has('from'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('from') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('group_id') ? ' has-error' : '' }}">
                                    <label>Grupo</label>
                                    {!! Form::select('group_id', $groups, null,['class'=>'form-control']) !!}
                                    @if ($errors->has('group_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('group_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('seedbed_id') ? ' has-error' : '' }}">
                                    <label>Semillero</label>
                                    {!! Form::select('seedbed_id', $seedbeds, null,['class'=>'form-control']) !!}
                                    @if ($errors->has('seedbed_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('seedbed_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                                    <label>Documento [PDF]</label>
                                    <input type="file" name="file">
                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" align="center">
                            <button  type="submit" class="btn btn-success">Guardar</button>
                            <a  href="{{route('project.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @if($project)
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Ponentes
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>['participant.store', $project->id], 'method'=>'post', 'class'=>'form']) !!}
                            {{Form::hidden('class', 'project')}}
                            {{Form::hidden('project_id', $project->id)}}
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
                                        <div class="form-group {{ $errors->has('document_type') ? ' has-error' : '' }}">
                                            <label>Tipo de Documento<span class="">*</span></label>
                                            {!! Form::select('document_type', [-1=>'Seleccionar','TI'=>'Tarjeta de identidad', 'CC'=>'Cédula de ciudadania', 'CE'=>'Cédula de extranjería'], null,['class'=>'form-control',]) !!}
                                            @if ($errors->has('document_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('document_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label>Email <span class="">*</span></label>
                                            {!! Form::email('email', null,['class'=>'form-control', 'placeholder'=>'Corre electrónico']) !!}
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                            <label>Tipo<span class="">*</span></label>
                                            {!! Form::select('type', ['speaker'=>'Ponente'], null,['class'=>'form-control',]) !!}
                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('document_num') ? ' has-error' : '' }}">
                                            <label>No. De Documento <span class="">*</span></label>
                                            {!! Form::text('document_num', null,['class'=>'form-control', 'placeholder'=>'No. Documento']) !!}
                                            @if ($errors->has('document_num'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('document_num') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label>Teléfono <span class="">*</span></label>
                                            {!! Form::text('phone', null,['class'=>'form-control', 'placeholder'=>'Número de teléfono']) !!}
                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" align="center">
                                    <button  type="submit" class="btn btn-info">Agregar</button>
                                </div>
                            </div>
                        {!! Form::close() !!}

                        <div class="row">
                            <div class="col-lg-12">
                                <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">Nombre</th>
                                        <th style="text-align: center">Doc/No. Identificación</th>
                                        <th style="text-align: center">Email</th>
                                        <th style="text-align: center">Teléfono</th>
                                        <th style="text-align: center">Fecha Creación</th>
                                        <th style="text-align: center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($project->participants as $participant)
                                        <tr class="odd gradeX">
                                            <td>{{$participant->name}}</td>
                                            <td>{{$participant->document_type}}-{{$participant->document_num}}</td>
                                            <td>{{$participant->email}}</td>
                                            <td>{{$participant->phone}}</td>
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
            <a  href="{{route('project.index')}}" class="btn btn-danger">Regresar</a>
        </div>
        <br>
    @endif
@endsection