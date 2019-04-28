@extends('layouts.app')
@section('content')
    <h1>Evidované modely telefonů</h1>
    @if (count($models) >= 1)
        @foreach ($models as $model)
            <div class="well">
                <h3><a href="/models/{{$model->model_id}}">{{$model->model_id}}</a></h3>
                <p>Model: {{$model->model_name}}</p></br>
                <p>IMEI: {{$model->imei}}</p>
                <p>Značka: {{$model->brand_name}}</p>
                <small>Založeno dne {{$model->created_at}}</small>
            </div>
        @endforeach
         {{$models->links()}} 
    @endif
@endsection