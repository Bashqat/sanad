$( document ).ready(function() {
    
    $(document).on("click",".update_setting",function() {
       // 
       var form_id=$(this).closest('form').attr('id');
       var form_data=$('#'+form_id).serialize();
       console.log(form_data);
       $.ajax({
           type:'POST',
           dataType: "json",
           url:'/master-setting-update',
           data:form_data,
           success:function(data) {
              if(data.status=="success")
              {
                    $('.msg_response').addClass('alert-success');
                    $('.msg_response').html('<strong>Success!</strong>'+data.msg);
              }
              else{
                    $('.msg_response').addClass('alert-danger');
                    $('.msg_response').html('<strong>Error!</strong>'+data.msg);
              
              }
           }
        });
        return false;
        });
        $(document).on("click",".update_superadmin_setting",function() {
            // 
            var form_id=$(this).closest('form').attr('id');
            
            var form_data=$('#'+form_id).serialize();
            
            
            $.ajax({
                type:'POST',
                dataType: "json",
                url:'/setting-update',
                data:form_data,
                success:function(data) {
                   if(data.status=="success")
                   {
                         $('.msg_response').addClass('alert-success');
                         $('.msg_response').html('<strong>Success!</strong>'+data.msg);
                   }
                   else{
                         $('.msg_response').addClass('alert-danger');
                         $('.msg_response').html('<strong>Error!</strong>'+data.msg);
                   
                   }
                }
             });
             return false;
        });  
    });