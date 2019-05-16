{{Form::text('user_name', '', ['class' => 'form-control', 'placeholder' => 'Povinné'])}} 

        <div id="userList" class="list-group">
        </div>

       
       {{ csrf_field() }}
       <script>
            $(document).ready(function(){
            
             $('#user_name').keyup(function(){ 
                    var query = $(this).val();
                    if(query != '')
                    {
                     var _token = $('input[name="_token"]').val();
                     $.ajax({
                      url:"{{ route('orders.fetch_staff') }}",
                      method:"POST",
                      data:{query:query, _token:_token},
                      success:function(data){
                       $('#userList').fadeIn();  
                                $('#userList').html(data);
                      }
                     });
                    }
                });
            
                $(document).on('click', 'li', function(){  
                    $('#user_name').val($(this).text());  
                    $('#userList').fadeOut();  
                });  
            
            });
            </script>