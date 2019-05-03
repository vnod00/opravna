@extends('layouts.app')
@section('content')
    <h1>Evidované modely telefonů</h1>
    @if (count($models) >= 1)
        @foreach ($models as $model)
            <div class="well">
                <h3><a href="/models/{{$model->model_id}}">{{$model->brand->brand_name}} – {{$model->model_name}}</a></h3>
                <p>Model: {{$model->model_name}}</p>
                <p>IMEI: {{$model->imei}}</p>
                <p>Značka: {{$model->brand->brand_name}}</p>
                <small>Založeno dne {{$model->created_at}}</small>
            </div>
            <hr>
        @endforeach
         {{$models->links()}} 
    @endif
@endsection