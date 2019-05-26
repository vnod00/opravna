@extends('layouts.app')
@section('head')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/cs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> 

@endsection
@section('content')
    <h1>Uprav zakázku</h1>
    @auth
    @if( Auth::user()->hasAnyRole(['admin','opravar']))
    {{Form::label('name_rep', 'Provedené opravy')}}
         <table class="table">
                <tbody>
                @foreach ($order->repair as $done)
                  <tr>
                    <th scope="row">Oprava</th>
                    <td>{{$done->name}}
                            {!! Form::open(['action' => ['OrderController@destroyRepair',  $order->ord_id, $done->rep_id], 'method' => 'POST']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger float-right'])}}
                         {!! Form::close() !!} 
                    </td>
                  </tr>
                @endforeach
                </tbody>
            </table>      
    @endif
@endauth

            
    
    {!! Form::open(['action' => ['OrderController@update', $order->ord_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Název')}}
        {{Form::text('name', $order->name, ['class' => 'form-control', 'placeholder' => 'Povinné'])}} 
    </div>
    <div class="form-group">
        {{Form::label('cus_email', 'Zákazník (Hledej dle e-mail)')}}
        
        @include('orders.search_cus')
    </div>   
    <div class="form-group">
        {{Form::label('model_imei', 'IMEI telefonu')}}
        @include('orders.search_mod')
    </div>
    <div class="container">
    <div class="row">
        <div class="form-group col pl-0">
            {{Form::label('acc_date', 'Datum přijetí')}}
            {{Form::text('acc_date', $order->date_acceptance, ['class' => 'form-control date', 'id'=>'datepicker']) }}
        </div>
        <div class="form-group col pr-0" id="hand_date" style="display: none">
            {{Form::label('hand_date', 'Datum vyhotovení')}}
            {{Form::text('hand_date', $order->date_handover, ['class' => 'form-control date', 'id'=>'datepicker2']) }}
        </div>
    </div>
</div>       
    <div class="form-group">
            {{Form::label('descp_ord', 'Popis vady')}}
            {{Form::textarea('descp', $order->desc, [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
    </div>
    @auth
    @if( Auth::user()->hasAnyRole(['admin','opravar']))
    <div class="form-group" id="repair_div">
            {{Form::label('rep_sel', 'Zadej provedenou opravu')}}
            <div class="input-group mb-3" id="repair">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Nepovinné</label>
                </div>
                <select name="rep_sel" class="form-control">
                  <option  selected></option>
                  @foreach ($repairs as $repair)               
                        <option>{{$repair->name}}</option>                                
                  @endforeach 
                </select> 
                
            </div>   
        </div>     
    @endif
@endauth
  
    <div class="form-group">
        {{Form::label('task_sel', 'Zadej změnu na zakázce')}}
        <div class="input-group mb-3">          
            <div class="input-group-prepend">
             <label class="input-group-text" for="inputGroupSelect01">Nepovinné</label>
            </div>
            <select name="task_sel" class="form-control" id="task_sel">
             <option selected >{{$task_name}}</option>
                @foreach ($tasks as $task) 
                    <option value ="{{{$task->desc}}}">{{$task->desc}}</option>               
                 @endforeach 
            </select>
        </div>
   </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Ulož', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    <script>
            $(".delete").on("submit", function(){
                return confirm("Opravdu chcete tuto opravu odstranit??");
            });
    </script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
                CKEDITOR.replace( 'article-ckeditor' );
    </script>
    <script type="text/javascript">
                 $('.date').datetimepicker({
                    locale: 'cs',
                    format: 'YYYY-MM-DD',
                });  
                
    </script> 
    <script type="text/javascript">
        $(function () {
            $("#task_sel").change(function() {
            var val = $(this).val();
            if(val === "Zakázka vyhotovena") {
                 $("#hand_date").show();
            }
            else  {
                $("#hand_date").hide();
            }
        });
    });
    </script>

@endsection