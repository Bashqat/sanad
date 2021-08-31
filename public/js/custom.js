$( document ).ready(function() {


    $(document).on("click",".update_setting",function() {
       //

       var form_id=$(this).closest('form').attr('id');
    //    console.log(form_id);
    var form_arry_data=$('#'+form_id).serializeArray();
    var form_submit='yes';
    //console.log(form_data);
    $(form_arry_data).each(function(i, field){
        console.log(field.name);
        if(field.value=="")
        {
            $('#'+field.name+"_error").html('This field is required');
            form_submit='no';
        }
        else{
            $('#'+field.name+"_error").html('');
        }
      });
      if(form_submit=='no')
      {
          return false;
      }

       var form_data=$('#'+form_id).serialize();
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
                    $('.msg_response').show();
              }
              else{
                    $('.msg_response').addClass('alert-danger');
                    $('.msg_response').html('<strong>Error!</strong>'+data.msg);
                    $('.msg_response').show();

              }
           }
        });
        return false;
        });
        $(document).on("click",".update_superadmin_setting",function() {
            //
            var form_id=$(this).closest('form').attr('id');

            var form_data=$('#'+form_id).serialize();
            var form_array_data=$('#'+form_id).serializeArray();
            var form_submit='yes';
            $(form_array_data).each(function(i, field){
                console.log(field.name);
                if(field.value=="")
                {
                    $('#'+field.name+"_error").html('This field is required');
                    form_submit='no';
                }
                else{
                    $('#'+field.name+"_error").html('');
                }
            });
            if(form_submit=='no')
            {
                return false;
            }


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

        $(document).on("click",".role",function() {
          var role=$(this).attr('role_attr');
          var setRole='';
          if(role=="employee")
          {
            setRole='4';
            $('.role-select-employee').css('display','block');
            $('.role-select-manager').css('display','none');;
          }else if(role=="manager")
          {
            $('.role-select-employee').css('display','none');;
            $('.role-select-manager').css('display','block');
            setRole='3';
          }
          $('#role').val(setRole);
        });
        var organisation_info=$('#organisation').DataTable();

    });
