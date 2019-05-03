
{{Form::text('role_name', '', ['id' => 'role_name', 'class' => 'form-control', 'placeholder' => 'Vyhledat...'])}}

        
        <div id="nameList" class="list-group">
        </div>

       
       {{ csrf_field() }}
       <script>
            $(document).ready(function(){
            
             $('#role_name').keyup(function(){ 
                    var query = $(this).val();
                    if(query != '')
                    {
                     var _token = $('input[name="_token"]').val();
                     $.ajax({
                      url:"{{ route('auth.fetch') }}",
                      method:"POST",
                      data:{query:query, _token:_token},
                      success:function(data){
                       $('#nameList').fadeIn();  
                                $('#nameList').html(data);
                      }
                     });
                    }
                });
            
                $(document).on('click', 'li', function(){  
                    $('#role_name').val($(this).text());  
                    $('#nameList').fadeOut();  
                });  
            
            });
            </script>