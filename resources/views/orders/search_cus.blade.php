{{Form::text('cus_name', '', ['class' => 'form-control', 'placeholder' => 'Povinné'])}} 

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
            
                $(document).on('click', 'li', function(){  
                    $('#cus_name').val($(this).text());  
                    $('#cusList').fadeOut();  
                });  
            
            });
            </script>