<div class="form-group">
        <input type="text" name="brand_name" id="brand_name" class="form-control input-lg" placeholder="Vyhledat..." />
        <div id="brandList" class="list-group">
        </div>

       </div>
       {{ csrf_field() }}
       <script>
            $(document).ready(function(){
            
             $('#brand_name').keyup(function(){ 
                    var query = $(this).val();
                    if(query != '')
                    {
                     var _token = $('input[name="_token"]').val();
                     $.ajax({
                      url:"{{ route('models.fetch') }}",
                      method:"POST",
                      data:{query:query, _token:_token},
                      success:function(data){
                       $('#brandList').fadeIn();  
                                $('#brandList').html(data);
                      }
                     });
                    }
                });
            
                $(document).on('click', 'li', function(){  
                    $('#brand_name').val($(this).text());  
                    $('#brandList').fadeOut();  
                });  
            
            });
            </script>