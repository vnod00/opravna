@extends('layouts.app')
@section('content')
    <h1>{{$cust->name}} {{$cust->surname}}</h1>
    <ul class="list-group">
        @if ($cust->ico != null)
            <li class="list-group-item"><b>IČO:</b> {!!$cust->ico!!}</li> 
        @endif      
        <li class="list-group-item"><b>Adresa:</b> {!!$cust->street!!} {!!$cust->house_num!!}, {!!$cust->city!!} {!!$cust->post_code!!}</li>
        <li class="list-group-item"><b>Telefon:</b> {!!$cust->phone_num!!}</li>
        <li class="list-group-item"><b>Email:</b> {!!$cust->email!!}</li>
    </ul>
    
    <small>Založen dne {{$cust->created_at}}</small>
    <hr>
    @auth
    @if( Auth::user()->hasAnyRole(['admin','prodavac']))
    <a href="/customers/{{$cust->cus_id}}/edit" class="btn btn-secondary ml-2" role="button" aria-pressed="true">Upravit</a>
    @endif
     @endauth   
    <a href="/customers" class="btn btn-primary">Zpět</a>
    @auth
    @if( Auth::user()->hasAnyRole(['admin','prodavac']))
    {!! Form::open(['action' => ['CustomerController@destroy', $cust->cus_id], 'method' => 'POST', 'class' => 'float-right delete']) !!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger '])}}
    {!! Form::close() !!} 
    @endif
     @endauth

     <script>
            $(".delete").on("submit", function(){
                return confirm("Opravdu chcete tohoto zákazníka odstranit??");
            });
</script>
@endsection