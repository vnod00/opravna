@extends('layouts.app')
@section('content')
    <h1>Evidované modely telefonů</h1>
    @if (count($models) >= 1)
    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($models as $model)
           
            <div class="card m-3 " >
                <div class="card"  >
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{$model->brand->brand_name}} {{$model->model_name}}</h5>
                      <p class="card-text"><b>IMEI:</b> {{$model->imei}}</p>
                      <small>Založeno dne {{$model->created_at}}</small>
                      <a href="/models/{{{$model->model_id}}}/edit" class="btn btn-primary mr-2" role="button" aria-pressed="true">Upravit</a>
                      {!! Form::open(['action' => ['DeviceModelController@destroy', $model->model_id], 'method' => 'POST', 'class' => 'float-right delete']) !!}
                      {{Form::hidden('_method', 'DELETE')}}
                      {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
        @endforeach
    </div>
    @endif
    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete tento telefon odstranit??");
        });
    </script>
    
@endsection

    
