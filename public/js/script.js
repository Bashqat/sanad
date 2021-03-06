$('#userProfile').each(function() {
    if($(this).attr('value') != ''){
        var fileName = $(this).attr('value').split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    }
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-thumb').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    readURL(this);
});

$('#removeProfile').click(function(){
    $('.profile-user-img').attr('src','images/profile/user-avatar.png');
    $('#userProfile').attr('value','');
    $('.custom-file-label').html('');
    $('#input-removeProfile').attr('value',true);
    $('#image-thumb').attr('src','');
});

// $(document).on('click','.select-all',function(){
//     var id = $(this).data('id');
//     $(`${id} .row-select`).not(this).prop('checked', this.checked);
// });

$(document).on('click','.select-all',function(){
    $('.row-select').not(this).prop('checked',this.checked);
});
$(document).on('click','#delete_all',function(){

    let idArr = [];
    $('.row-select').each(function(){
        if($(this).prop('checked')){
            idArr.push($(this).attr('data-id'));
        }
    });
    if(idArr.length === 0) {
      toastr.error('Please select atleast one');
      return false;
    }

    var check =  confirm('Are you sure you want to delete this item?');
    if (check == false) { return false; }


    var org_status=$('#org_select_status').val();
    var org_id=$('#org_id').val();



    $.ajax({
        type:"GET",
        url:"/bulk-destroy",
        data:{idArr:idArr,org_status:org_status,org_id:org_id},
        success: function(response){

            if (response.success == 1){
                window.location.href = "/users-management";
            }
            else if(response.success == 2){
                window.location.href = "/organisation/"+org_id+"/user-management";
            }
            else{
                alert("something went wrong");
            }
        }
    });
});

$(document).on('click','#contact-check-all',function(){
    $('.contact-checkbox').not(this).prop('checked', this.checked);
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
