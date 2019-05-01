@extends('layouts.app')
@section('content')
    <h1>{{$model->model_id}}</h1>
    <p>{{$model->model_name}}</p></br>
    <p>{{$model->imei}}</p>
    <hr>
    <small>Založeno dne {{$model->created_at}}</small>
    <a  href="/models" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Zpět</a>
    <hr>
    <a href="/models/{{{$model->model_id}}}/edit" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Upravit</a>
    {!! Form::open(['action' => ['DeviceModelController@destroy', $model->model_id], 'method' => 'POST', 'class' => 'float-right delete']) !!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!! Form::close() !!}
@endsection