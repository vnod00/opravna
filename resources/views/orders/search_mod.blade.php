@if (isset($order))   
{{Form::text('model_imei', $order->model->imei, ['id' => 'model_imei', 'class' => 'form-control', 'placeholder' => 'Vyhledat..'])}} 
@else
{{Form::text('model_imei', '', ['id' => 'model_imei', 'class' => 'form-control', 'placeholder' => 'Vyhledat..'])}} 
@endif
        <div id="modList" class="list-group">
        </div>

       
       {{ csrf_field() }}
       <script>
            $(document).ready(function(){
            
             $('#model_imei').keyup(function(){ 
                    var query = $(this).val();
                    if(query != '')
                    {
                     var _token = $('input[name="_token"]').val();
                     $.ajax({
                      url:"{{ route('orders.fetch_mod') }}",
                      method:"POST",
                      data:{query:query, _token:_token},
                      success:function(data){
                       $('#modList').fadeIn();  
                                $('#modList').html(data);
                      }
                     });
                    }
                });
            
                $(document).on('click', '.mod_offer', function(){  
                    $('#model_imei').val($(this).text());  
                    $('#modList').fadeOut();  
                });  
            
            });
            </script>