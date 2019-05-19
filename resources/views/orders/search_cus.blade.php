@if (isset($order))   
    {{Form::text('cus_email', $order->customer->email, ['id' => 'cus_email', 'class' => 'form-control', 'placeholder' => 'Vyhledat..'])}} 
@else

         {{Form::text('cus_email', '', ['id' => 'cus_email', 'class' => 'form-control', 'placeholder' => 'Vyhledat..'])}} 
    
@endif
    <div id="cusList" class="list-group">
    </div>

       
       {{ csrf_field() }}
       <script>
            $(document).ready(function(){
            
             $('#cus_email').keyup(function(){ 
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
                    $('#cus_email').val($(this).text()); 
                    $(this).appendTo('#cus_name');   
                    $('#cusList').fadeOut();  
                });  
            
            });
            </script>