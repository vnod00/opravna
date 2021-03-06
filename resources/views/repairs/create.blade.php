@extends('layouts.app')
@section('head')

 
@endsection
@section('content')
    <h1>Zaeviduj novou opravu</h1>
    {!! Form::open(['action' => 'RepairController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Název')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Cena')}}
            {{Form::text('price', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
                {{Form::label('descp', 'Popis opravy')}}
                {{Form::textarea('descp', '', [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>   
        {{Form::submit('Ulož', ['class'=>'btn btn-primary btn-lg active', 'role'=>'button', 'aria-pressed'=>'true'])}}
    {!! Form::close() !!}
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>

@endsection
