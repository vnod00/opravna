@extends('layouts.app')
@section('content')
    <h1>{{$model->id_model}}</h1>
    <p>{{$model->model_name}}</p></br>
    <p>{{$model->imei}}</p>
    <hr>
    <small>Založeno dne {{$model->created_at}}</small>
    <a href="/models" class="btn btn-default">Zpět</a>
    <hr>
    <a href="/models/{{{$model->model_id}}}/edit" class="btn btn-default">Upravit</a>
@endsection