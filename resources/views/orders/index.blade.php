@extends('layouts.app')
@section('content')
    <h1>Zakázky</h1>
    @if (count($orders) >= 1) 
            <div class="container mt-3">
                  <h3>Zakázky vytvořené</h3>
                   <table class="table p-3">
                      <thead class="thead bg-danger">
                        <tr>
                          <th scope="col" class=" p-3">ID</th>
                          <th scope="col" class=" p-3">Název</th>   
                          <th scope="col" class=" p-3">Zákazník</th> 
                          <th scope="col" class=" p-3">Naposledy upravil</th>                     
                        </tr>
                      </thead>
                      <tbody>
                   @foreach ($orders as $order)
                      @foreach ($order->task as $order_task)
                      
                          @if ($order_task->task_id == 1)
                          <tr>
                              <th class=" p-3">ID-{{$order->ord_id}}</th>
                              <th class=" p-3">{{$order->name}}</th>
                              <th class=" p-3">{{$order->customer->name}} {{$order->customer->surname}}</th>
                              @foreach ($order->task_user as $user)
                              <th class=" p-3">{{$user->first_name}} {{$user->last_name}}
                              <a href="/orders/{{{$order->ord_id}}}" class="btn btn-secondary float-right" role="button" aria-pressed="true">Detail</a>  
                              </th>
                              @endforeach                        
                            </tr> 
                          @endif
                          @endforeach
                   @endforeach
                        </tbody>
                      </table>    
                   <hr>
                   <h3>Zakázky v opravě</h3>
                   <table class="table p-3">
                      <thead class="thead bg-warning">
                        <tr>
                          <th scope="col" class=" p-3">ID</th>
                          <th scope="col" class=" p-3">Název</th>   
                          <th scope="col" class=" p-3">Zákazník</th> 
                          <th scope="col" class=" p-3">Naposledy upravil</th>                     
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($orders as $order)
                          @foreach ($order->task as $order_task)
                   @if ($order_task->task_id == 2)
                   <tr>
                   <th class=" p-3">ID-{{$order->ord_id}}</th>
                   <th class=" p-3">{{$order->name}}</th>
                   <th class=" p-3">{{$order->customer->name}} {{$order->customer->surname}}</th>
                   @foreach ($order->task_user as $user)
                              <th class=" p-3">{{$user->first_name}} {{$user->last_name}}
                              <a href="/orders/{{{$order->ord_id}}}" class="btn btn-secondary float-right" role="button" aria-pressed="true">Detail</a>  
                              </th>
                    @endforeach                           
                 </tr>   
                   @endif
                   @endforeach
                   @endforeach
                  </tbody>
                      </table>    
                   <hr>    
                   <h3>Zakázky opravené</h3>  
                   <table class="table p-3">
                      <thead class="thead bg-primary">
                        <tr>
                          <th scope="col" class=" p-3">ID</th>
                          <th scope="col" class=" p-3">Název</th>   
                          <th scope="col" class=" p-3">Zákazník</th> 
                          <th scope="col" class=" p-3">Naposledy upravil</th>                     
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($orders as $order)
                          @foreach ($order->task as $order_task)
                   @if ($order_task->task_id == 3)
                   <th class=" p-3">ID-{{$order->ord_id}}</th>
                   <th class=" p-3">{{$order->name}}</th>
                   <th class=" p-3">{{$order->customer->name}} {{$order->customer->surname}}</th>
                   @foreach ($order->task_user as $user)
                              <th class=" p-3">{{$user->first_name}} {{$user->last_name}}
                              <a href="/orders/{{{$order->ord_id}}}" class="btn btn-secondary float-right" role="button" aria-pressed="true">Detail</a>  
                              </th>
                              @endforeach                            
                 </tr>   
                   @endif
                   @endforeach
                   @endforeach
                  </tbody>
                      </table>    
                   <hr>  
                   <h3>Zakázky vyhotovené</h3>                
                   <table class="table p-3">
                      <thead class="thead bg-success">
                        <tr>
                          <th scope="col" class=" p-3">ID</th>
                          <th scope="col" class=" p-3">Název</th>   
                          <th scope="col" class=" p-3">Zákazník</th> 
                          <th scope="col" class=" p-3">Naposledy upravil</th>                     
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($orders as $order)
                          @foreach ($order->task as $order_task)
                   @if ($order_task->task_id == 4)
                   <th class=" p-3">ID-{{$order->ord_id}}</th>
                   <th class=" p-3">{{$order->name}}</th>
                   <th class=" p-3">{{$order->customer->name}} {{$order->customer->surname}}</th>
                   @foreach ($order->task_user as $user)
                              <th class=" p-3">{{$user->first_name}} {{$user->last_name}}
                              <a href="/orders/{{{$order->ord_id}}}" class="btn btn-secondary float-right" role="button" aria-pressed="true">Detail</a>  
                              </th>
                              @endforeach                           
                 </tr>   
                   @endif
                   @endforeach
                   @endforeach
                  </tbody>
                      </table>    
                   <hr>
                 
                  </div>              
                 






    @endif
    {{$orders->links()}}
@endsection
