@extends('layouts.app2')

@section('content')
    <div  class = "text-center">
    <h1>{{$title}}</h1>
    <form class="form-signin">
        <img class="mb-4" src="https://www.freeiconspng.com/uploads/call-phone-smart-icon--icon-search-engine-29.png" alt="phone" width="72" height="72">      
        @if((isset($user)))
            <a href="/orders" class="btn btn-primary btn-block" type="submit">Na hlavní stránku</a>
        @else
            <a href="/login" class="btn btn-primary btn-block" type="submit">Přihlásit se</a>
        @endif

        <a type="submit" class="btn btn-primary mb-2 mt-5" href="/about">O aplikaci</a>
      </form>
    </div>
@endsection
       

