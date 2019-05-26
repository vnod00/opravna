@extends('layouts.app')
@section('content')
    <h1>Přehled oprav</h1>
    @if (count($repairs) >= 1)  
    <div class="container mt-3">         
                @foreach ($repairs as $repair)
                    <h3>{{$repair->name}}</h3>
                    <table class="table">
                            <tbody>
                              <tr>
                                <th scope="row">Cena</th>
                                <td>{!!$repair->price!!} Kč</td>
                              </tr>
                              <tr>
                                <th scope="row">Popis opravy</th>
                                <td>{!!$repair->descp!!}</td>
                              </tr>
                            </tbody>
                          </table>
                          @auth
                          @if( Auth::user()->hasRole('admin'))
                          {!! Form::open(['action' => ['RepairController@destroy', $repair->rep_id], 'method' => 'POST', 'class' => 'float-right delete']) !!}
                          {{Form::hidden('_method', 'DELETE')}}
                          {{Form::submit('Delete', ['class' => 'btn btn-danger '])}}
                          {!! Form::close() !!}   
                          @endif
                      @endauth
                      @auth
                      @if( Auth::user()->hasAnyRole(['admin', 'opravar']))
                      <a href="/repairs/{{{$repair->rep_id}}}/edit" class="btn btn-secondary mb-3" role="button" aria-pressed="true">Upravit</a>  
                      @endif
                  @endauth
                                   
                @endforeach                                
        {{$repairs->links()}}
    </div>
    @endif
    <script>
            $(".delete").on("submit", function(){
                return confirm("Opravdu chcete tuto opravu odstranit??");
            });
        </script>
@endsection