@extends('layouts.app2')

@section('content')
    <h1>{{$title}}</h1>
    <form class="form-signin">
        <img class="mb-4" src="https://www.freeiconspng.com/uploads/call-phone-smart-icon--icon-search-engine-29.png" alt="phone" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Přihlašte se prosím</h1>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Heslo</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Heslo" required>
        <div class="checkbox mb-3">
          
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Přihlásit</button>
        <p class="mt-5 mb-3 text-muted">&copy; Daniel Vnouček 2019</p>
      </form>

@endsection
       

