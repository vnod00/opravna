@extends('layouts.app')
@section('content')
    <h1>Přehled oprav</h1>
    @if (count($repairs) >= 1)           
                @foreach ($repairs as $repair)
                    <h2>{{$repair->name}}</h2>
                    <ul class="list-group">
                        <li class="list-group-item">{!!$repair->descp!!}</li>  
                    </ul>
                @endforeach                      
            </ul>
        {{$repairs->links()}}
    @endif
@endsection