@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($user)
                <h1 class="page-header">Usuarios <small>Editar Usuario</small></h1>
            @else
                <h1 class="page-header">Usuarios <small>Crear Nuevo Usuario</small></h1>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($user)
                        Formulario Edición  Usuario
                    @else
                        Formulario Registro Nuevo Usuario
                    @endif
                </div>
                <div class="panel-body">
                    @if($user)
                        {!! Form::model($user,['route'=>['user.update', $user->id], 'method'=>'put', 'class'=>'form']) !!}
                    @else
                        {!! Form::open(['route'=>'user.store', 'method'=>'post', 'class'=>'form']) !!}
                    @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nombre <span class="">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        {!! Form::text('name', null,['class'=>'form-control', 'placeholder'=>'Nombre de Usuario']) !!}
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                        {!! Form::text('phone', null,['class'=>'form-control', 'placeholder'=>'Número telefónico']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Celular</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        {!! Form::text('cell_phone', null,['class'=>'form-control', 'placeholder'=>'Número celular']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Cargo</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                                        {!! Form::text('position', null,['class'=>'form-control', 'placeholder'=>'Cargo']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Institución</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-university"></i></span>
                                        {!! Form::select('college_id', $colleges,null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email <span class="">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        {!! Form::email('email', null,['class'=>'form-control ', ($user)?'readonly':'', 'placeholder'=>'Correo Electrónico']) !!}
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>Contraseña <span class="">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        {!! Form::password('password',['class'=>'form-control', 'placeholder'=>'Contraseña']) !!}
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label>Confirmar Contraseña <span class="">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        {!! Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=>'Repita la contraseña']) !!}
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="row" align="center">
                            <button  type="submit" class="btn btn-success">Guardar</button>
                            <a  href="{{route('user.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection