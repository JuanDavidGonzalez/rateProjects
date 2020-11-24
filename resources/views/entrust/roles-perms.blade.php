@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Configuración <small>Gestión de Roles y permisos</small></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#roles" data-toggle="tab"> Roles </a>
                        </li>
                        @role('root')
                        <li>
                            <a href="#permissions" data-toggle="tab"> Permisos </a>
                        </li>
                        @endrole
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="roles">
                            <br>
                            <a href="{{route('roles.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear Rol</a>
                            <br><br>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Roles del Sistema
                                </div>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr class="odd gradeX">
                                                <th style="text-align: center"> # </th>
                                                <th style="text-align: center"> Nombre Rol </th>
                                                <th style="text-align: center"> Descripción </th>
                                                <th style="text-align: center"> Usuarios </th>
                                                <th style="text-align: center"> Permisos </th>
                                                <th style="text-align: center"> Editar </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $role)
                                                <tr>
                                                    <td> {{ ++$nroRol }} </td>
                                                    <td> {{ $role->display_name }} </td>
                                                    <td> {{ $role->description }} </td>
                                                    <td align="center"> {{ count($role->users) }} </td>
                                                    <td align="center"> {{ count($role->perms) }} </td>
                                                    <td align="center">
                                                        <a href="{{route('roles.edit', $role->id)}}" class="btn btn-xs btn-info" title="Editar Rol">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @role('root')
                            <div class="tab-pane" id="permissions">
                                <br>
                                <a href="{{route('perms.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crear Permiso</a>
                                <br><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Permisos del Sistema
                                    </div>
                                    <div class="panel-body">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr class="odd gradeX">
                                                    <th style="text-align: center"> # </th>
                                                    <th style="text-align: center"> Permiso </th>
                                                    <th style="text-align: center"> Descripción </th>
                                                    {{--<th style="text-align: center"> Usuarios </th>--}}
                                                    <th style="text-align: center"> Roles </th>
                                                    <th style="text-align: center"> Editar </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($perms as $perm)
                                                    <tr>
                                                        <td> {{ ++$nroPerm }} </td>
                                                        <td> {{ $perm->display_name }} </td>
                                                        <td> {{ $perm->description }} </td>
{{--                                                        <td align="center"> {{ $perm->users->count() }} </td>--}}
                                                        <td align="center"> {{ $perm->roles->count() }} </td>
                                                        <td align="center">
                                                            <a href="{{route('perms.edit', $perm->id)}}" class="btn btn-xs btn-info" title="Editar Permiso">
                                                                <span class="glyphicon glyphicon-edit"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection