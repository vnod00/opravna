@if (isset($order))   
{{Form::text('model_name', $order->model->imei.' '.$order->model->brand->brand_name.' '.$order->model->model_name, ['id' => 'model_name', 'class' => 'form-control', 'placeholder' => 'Vyhledat..'])}} 
@else
{{Form::text('model_name', '', ['id' => 'model_name', 'class' => 'form-control', 'placeholder' => 'Vyhledat..'])}} 
@endif
        <div id="modList" class="list-group">
        </div>

       
       {{ csrf_field() }}
       <script>
            $(document).ready(function(){
            
             $('#model_name').keyup(function(){ 
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
                    $('#model_name').val($(this).text());  
                    $('#modList').fadeOut();  
                });  
            
            });
            </script>