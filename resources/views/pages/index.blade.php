@extends('layouts.app2')

@section('content')
    <div  class = "text-center">
    <h1>{{$title}}</h1>
    <form class="form-signin">
        <img class="mb-4" src="https://www.freeiconspng.com/uploads/call-phone-smart-icon--icon-search-engine-29.png" alt="phone" width="72" height="72">
        <a href="/login" class="btn btn-lg btn-primary btn-block" type="submit">Přihlásit se</a>
        <p class="mt-5 mb-3 text-muted">&copy; Daniel Vnouček 2019</p>
      </form>
    </div>
@endsection
       

