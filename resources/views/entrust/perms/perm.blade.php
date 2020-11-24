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
                    @if($perm)
                        {!! Form::model($perm,['route'=>['perms.edit',$perm->id],'method'=>'PUT','class'=>'form-horizontal']) !!}
                    @else
                        {!! Form::open(['route'=>'perms.create','method'=>'POST','class'=>'form-horizontal']) !!}
                    @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @include('entrust.perms.partials.fields')
                                </div>
                                <div class="col-md-6">
                                    <h3 class="form-section">Roles Disponibles</h3>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Roles:</label>
                                        <div class="col-md-9">
                                            {!! Form::select('roles[]',$roles,($perm)?$perm->roles->pluck('id')->all():[],['multiple'=>true,'class'=>'form-control','id'=>'multiSelectRoles', 'style'=>'height: 150pt']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row text-center">
                                <button type="submit" class="btn btn-success">{{($perm)?'Editar':'Crear'}}</button>
                                <a href="{{route('profile.index')}}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection