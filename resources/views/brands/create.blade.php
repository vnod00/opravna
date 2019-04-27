@extends('layouts.app')

@section('content')
    <h1>Zaeviduj nového výrobce</h1>
    {!! Form::open(['action' => 'DeviceBrandController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('brand', 'Název')}}
            {{Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Název'])}}
        </div>
        {{Form::submit('Ulož', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection