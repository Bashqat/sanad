// $(document).on('click', '.org_submit', function () {
//   var form_id=$(this).closest('form').attr('id');
//   //alert(form_id);
//   $( "#"+form_id ).submit();
//
// })
//$("#org_new").validate();
$("#org_new").validate({
    errorClass: "error-class",
    // submitHandler: function() { $(".loader").show(); $('#org_new').submit();}


});
