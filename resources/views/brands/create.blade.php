@extends('layouts.app')

@section('content')
    <h1>Zaeviduj nového výrobce</h1>
    {!! Form::open(['action' => 'DeviceBrandController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('brand', 'Název')}}
            {{Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        {{Form::submit('Ulož', ['class'=>'btn btn-primary btn-lg active', 'role'=>'button', 'aria-pressed'=>'true'])}}
    {!! Form::close() !!}
@endsection