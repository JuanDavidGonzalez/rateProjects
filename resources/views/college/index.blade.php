@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Instituciones <small>Gestión de Instituciones</small></h1>
        </div>
    </div>
    {!! Form::open(['route'=>'college.index', 'method'=>'get', 'class'=>'form']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group custom-search-form">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre de institución">
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
            @permission('create-college')
                <a href="{{route('college.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear</a>
                <br><br>
            @endpermission
            <div class="panel panel-default">
                <div class="panel-heading">
                    Instituciones del sistema
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Siglas</th>
                                <th style="text-align: center">Ciudad</th>
                                <th style="text-align: center">Fecha Creación</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($colleges as $college)
                                <tr class="odd gradeX">
                                    <td>{{$college->name}}</td>
                                    <td>{{$college->initials}}</td>
                                    <td>{{$college->city}}</td>
                                    <td>{{$college->created_at}}</td>
                                    <td>
                                        @permission('create-college')
                                            <a href="{{route('college.edit', $college->id)}}" class="btn btn-xs btn-info" title="Editar Institución">
                                                <span class="glyphicon glyphicon-edit"></span>
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