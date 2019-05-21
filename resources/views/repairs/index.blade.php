@extends('layouts.app')
@section('content')
    <h1>Přehled oprav</h1>
    @if (count($repairs) >= 1)           
                @foreach ($repairs as $repair)
                    <h3>{{$repair->name}}</h3>
                    <ul class="list-group">
                        <li class="list-group-item mb-2" >{!!$repair->descp!!}                             
                        {!! Form::open(['action' => ['RepairController@destroy', $repair->rep_id], 'method' => 'POST', 'class' => 'float-right delete']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!! Form::close() !!}
                        <a href="/repairs/{{{$repair->rep_id}}}/edit" class="btn btn-secondary float-right mr-2" role="button" aria-pressed="true">Upravit</a>
                    </li>
                    </ul>
                @endforeach                      
            </ul>
        {{$repairs->links()}}
    @endif
    <script>
            $(".delete").on("submit", function(){
                return confirm("Opravdu chcete tuto opravu odstranit??");
            });
        </script>
@endsection