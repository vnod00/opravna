@extends('layouts.app')
@section('content')
    <h1>Výrobci telefonů</h1>
    @if (count($brands) >= 1)
            <ul class="list-group">
                @foreach ($brands as $brand)
                    <li class="list-group-item">{{$brand->brand_name}}</li>  
                @endforeach                      
            </ul>
        {{$brands->links()}}
    @endif
@endsection