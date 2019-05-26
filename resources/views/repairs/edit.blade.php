@extends('layouts.app')
@section('head')

 
@endsection
@section('content')
    <h1>Uprav opravu</h1>
    {!! Form::open(['action' => ['RepairController@update', $repair->rep_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Název')}}
            {{Form::text('name', $repair->name, ['class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Cena')}}
            {{Form::text('price', $repair->price, [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
                {{Form::label('descp', 'Popis opravy')}}
                {{Form::textarea('descp', $repair->descp, [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        {{Form::hidden('_method', 'PUT')}}  
        {{Form::submit('Ulož', ['class'=>'btn btn-primary btn-lg active', 'role'=>'button', 'aria-pressed'=>'true'])}}
    {!! Form::close() !!}
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection
