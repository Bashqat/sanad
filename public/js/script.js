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

    var check =  confirm('Are you sure you want to delete this item?');

    if (check == false) { return false; }

    let idArr = [];

    $('.row-select').each(function(){
        if($(this).prop('checked')){
            idArr.push($(this).attr('data-id'));
        }
    });

    $.ajax({
        type:"GET",
        url:"/bulk-destroy",
        data:{idArr:idArr},
        success: function(response){
            if (response.success == 1){
                window.location.href = "/users-management";
            }else{
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
