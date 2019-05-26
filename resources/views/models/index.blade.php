@extends('layouts.app')
@section('content')
    <h1>Evidované modely telefonů</h1>
    @if (count($models) >= 1)
    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($models as $model)
           
            <div class="card m-3 " >
                <div class="card"  >
                    <img style="max-width: 350px;" src="/storage/cover_images/{{$model->cover_image}}" class="card-img-top m-2" alt="model_img">
                    <div class="card-body">
                      <h5 class="card-title">{{$model->brand->brand_name}} {{$model->model_name}}</h5>
                      <p class="card-text"><b>IMEI:</b> {{$model->imei}}</p>
                      <small>Založeno dne {{$model->created_at}}</small>
                      @auth
                      @if( Auth::user()->hasAnyRole(['admin','prodavac']))
                      <a href="/models/{{{$model->id}}}/edit" class="btn btn-primary mr-2" role="button" aria-pressed="true">Upravit</a>
                      {!! Form::open(['action' => ['DeviceModelController@destroy', $model->id], 'method' => 'POST', 'class' => 'float-right delete']) !!}
                      {{Form::hidden('_method', 'DELETE')}}
                      {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                      {!! Form::close() !!}   
                      @endif
                  @endauth
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
    <script>
        function openModal() {
          document.getElementById("myModal").style.display = "block";
        }
    </script>
@endsection

    
