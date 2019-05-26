@extends('layouts.app')
@section('content')
    <h1>Zaměstnanci</h1>
    @if (count($users) >= 1)
    <ul class="list-group">
        @foreach ($users as $user)
            <li class="list-group-item">
                <b>{{$user->first_name}} {{$user->last_name}}</b> – {{$user->email}}, <b>{{$user->role->name}}</b>
                @auth
                @if( Auth::user()->hasRole('admin'))
                
                {!! Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST', 'class' => 'float-right delete']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger '])}}
                {!! Form::close() !!}   
                <a href="/users/{{$user->id}}/edit" class="btn btn-primary float-right mr-2" role="button" aria-pressed="true">Upravit</a>
                @endif
                 @endauth 
                
            </li>
                                             
        @endforeach
    </ul>
        {{$users->links()}}
    @endif
    <script>
            $(".delete").on("submit", function(){
                return confirm("Opravdu chcete tohoto uživatele odstranit??");
            });
        </script>
@endsection