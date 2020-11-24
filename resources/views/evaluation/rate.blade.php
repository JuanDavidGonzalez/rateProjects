@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Retro-Alimentación <small>Asesorar Proyecto: {{$evaluation->project->name}}</small></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Criterios  Asesoría
                </div>
                <div class="panel-body">
                    {!! Form::open(['route'=>'evaluation.store', 'method'=>'post', 'class'=>'form']) !!}
                    {!! Form::hidden('evaluation_id', $evaluation->id) !!}
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px">
                        <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">Criterio</th>
                                <th style="text-align: center">Ponderación</th>
                                <th style="text-align: center">Componetes</th>
                                <th style="text-align: center;; width: 80px">Puntaje</th>
                                <th style="text-align: center; width: 300px">Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($criteria as $criterion)
                                <tr class="odd gradeX {{ $errors->has('score.'.$criterion->id) ? 'danger' : '' }}">
                                    <td align="center">{{$criterion->id}}</td>
                                    <td>{{$criterion->name}}</td>
                                    <td align="center">
                                        {{$criterion->weighing}} %
                                    </td>
                                    <td>{{$criterion->description}}</td>
                                    <td >
                                        {!! Form::number('score['.$criterion->id.']', null,['class'=>'form-control', 'step'=>0.1, 'min'=>1.0, 'max'=>5]) !!}
                                    </td>
                                    <td >
                                        {!! Form::text('observation['.$criterion->id.']', null,['class'=>'form-control', 'placeholder'=>'Observación']) !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <div class="row" align="center">
                            <button  type="submit" class="btn btn-success">Guardar</button>
                            <a  href="{{route('evaluation.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // tooltip demo
        $('.tooltip-demo').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
        // popover demo
        $("[data-toggle=popover]")
            .popover()
    </script>
@endsection