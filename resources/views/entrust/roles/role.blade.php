@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Configuración <small>Gestión de Roles y permisos</small></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$action}}
                </div>
                <div class="panel-body">
                    @if($role)
                        {!! Form::model($role,['route'=>['roles.edit',$role->id],'method'=>'PUT','class'=>'form-horizontal']) !!}
                    @else
                        {!! Form::open(['route'=>'roles.create','method'=>'POST','class'=>'form-horizontal']) !!}
                    @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        @include('entrust.roles.partials.fields')
                                    </div>
                                    <div class="row">
                                        <h3 class="form-section">Usuarios</h3>
                                        <div class="form-group">
                                            <label for="users" class="control-label col-lg-3">Usuarios:</label>
                                            <div class="col-lg-9">
                                                {!! Form::select('users[]',$users,($role)?$role->users->pluck('id')->all():[],['multiple'=>true,'class'=>'form-control','id'=>'multiSelectUsers']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="form-section">Permisos</h3>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Permisos:</label>
                                        <div class="col-lg-9">
                                            {!! Form::select('perms[]',$perms,($role)?$role->perms->pluck('id')->all():[],['multiple'=>true,'class'=>'form-control','id'=>'multiSelectRoles', 'style'=>'height: 265pt']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row text-center">
                                <button type="submit" class="btn btn-success">{{($role)?'Editar':'Crear'}}</button>
                                <a href="{{route('profile.index')}}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection