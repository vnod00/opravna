@extends('layouts.app')
@section('content')
    <h1>Evidované modely telefonů</h1>
    @if (count($models) >= 1)
    <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            @foreach ($models as $model)
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="/storage/cover_images/{{$model->cover_image}}" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text"><b>{{$model->brand->brand_name}} {{$model->model_name}}</b></p>
                  <p class="card-text"><b>IMEI:</b> {{$model->imei}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                            @auth
                            @if( Auth::user()->hasAnyRole(['admin','prodavac']))
                            <a href="/models/{{{$model->id}}}/edit" class="btn btn-primary mr-2" role="button" aria-pressed="true">Upravit</a>
                            {!! Form::open(['action' => ['DeviceModelController@destroy', $model->id], 'method' => 'POST', 'class' => 'float-right delete']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger mr-2'])}}
                            {!! Form::close() !!}   
                            @endif
                        @endauth
                    </div>
                    <small class="text-muted">Založeno dne {{$model->created_at}}</small>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
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

    
