@extends('layouts.app')
@section('content')
    <h1>Evidované modely telefonů</h1>
    @if (count($models) >= 1)
        @foreach ($models as $model)
            <div class="well">
                <h3><a href="/models/{{$model->model_id}}">{{$model->brand->brand_name}} – {{$model->model_name}}</a></h3>
                <ul class="list-group">
                    <li class="list-group-item">Model: {{$model->model_name}}</li>
                    <li class="list-group-item">IMEI: {{$model->imei}}</li>
                    <li class="list-group-item">Značka: {{$model->brand->brand_name}}</li>
                </ul>    
                <small>Založeno dne {{$model->created_at}}</small>
            </div>
            <hr>
        @endforeach
         {{$models->links()}} 
    @endif
@endsection