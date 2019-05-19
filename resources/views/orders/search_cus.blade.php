@if (isset($order))   
{{Form::text('cus_name', $order->customer->name.' '.$order->customer->surname.' '.$order->customer->email, ['id' => 'cus_name', 'class' => 'form-control', 'placeholder' => 'Vyhledat..'])}} 
@else
{{Form::text('cus_name', '', ['id' => 'cus_name', 'class' => 'form-control', 'placeholder' => 'Vyhledat..'])}} 
@endif
        <div id="cusList" class="list-group">
        </div>

       
       {{ csrf_field() }}
       <script>
            $(document).ready(function(){
            
             $('#cus_name').keyup(function(){ 
                    var query = $(this).val();
                    if(query != '')
                    {
                     var _token = $('input[name="_token"]').val();
                     $.ajax({
                      url:"{{ route('orders.fetch') }}",
                      method:"POST",
                      data:{query:query, _token:_token},
                      success:function(data){
                       $('#cusList').fadeIn();  
                                $('#cusList').html(data);
                      }
                     });
                    }
                });
            
                $(document).on('click', '.cus_offer', function(){  
                    $('#cus_name').val($(this).text());  
                    $('#cusList').fadeOut();  
                });  
            
            });
            </script>