@extends('layouts.app')
@section('content')
    <h1>Zaměstnanci</h1>
    @if (count($users) >= 1)
    <ul class="list-group">
        @foreach ($users as $user)
            <li class="list-group-item">
                <b>{{$user->first_name}} {{$user->last_name}}</b> – {{$user->email}}
                @auth
                @if( Auth::user()->hasRole('admin'))
                <a href="/users/{{$user->id}}/edit" class="btn btn-primary float-right" role="button" aria-pressed="true">Upravit</a> 
                @endif
                 @endauth 
                
            </li>
                                             
        @endforeach
    </ul>
        {{$users->links()}}
    @endif
@endsection