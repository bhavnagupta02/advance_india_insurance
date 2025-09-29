$(function() {
/*Success Message JS*/
setTimeout(function() {
    $('.alert-success, .alert-danger').fadeOut('slow');
}, 5000); // <-- time in milliseconds
/*Success Message JS End*/
});

//Export Excel Sheet Start & End Date Validation Start
//$("#startDate, #endDate").datepicker({format: "dd-mm-yyyy"});
$("#startDate, #endDate").datepicker();
$("#endDate").change(function () {
    //var regYear = document.getElementById("RegYear").value;
    var startDate = document.getElementById("startDate").value;
    var endDate = document.getElementById("endDate").value;
    if((Date.parse(endDate) <= Date.parse(startDate))) {
      $('.datevalidation').html('End date should be greater than Start date').css("color", "red");
      document.getElementById("endDate").value = "";
    }
    else if(Date.parse(startDate) <= Date.parse(endDate)){
      $('.datevalidation').html('End date is valid').css("color", "green");
    }
});


//Get Models List in Variants Code Start
$(document).ready(function(){
  //Get Models List in Add Variants onChange Event
  $('#variantType').change(function(){
    var model_type = $('#variantType').val();
    var fun_url = $(this).attr("data-url");
    /*alert(model_type);
    alert(fun_url);*/
    if(model_type != '')
    {
     $.ajax({
      url:fun_url,
      method:"POST",
      data:{model_type:model_type},
      success:function(data){
        //alert(data);
        //return false;
        $('#MmodelType').html(data);
      }
     });
    }
    else{
     $('#MmodelType').html('<option value="">Select Make/Model</option>');
    }
  });

  //Get Models List in Edit Variant onLoad Event
  $('#EvariantType').change(function(){
    var model_type = $('#EvariantType').val();
    var fun_url = $(this).attr("data-url");
    var variant_id = $(this).attr("data-vid");
    /*alert(model_type+'--'+variant_id);
    alert(fun_url);*/
    if(model_type != '')
    {
     $.ajax({
      url:fun_url,
      method:"POST",
      data:{model_type: model_type , variant_id: variant_id},
      success:function(data){
        //alert(data);
        //return false;
        $('#EMmodelType').html(data);
      }
     });
    }
    else{
     $('#EMmodelType').html('<option value="">Select Make/Model</option>');
    }
  }).trigger('change') // extra call;

});


/*$(document).ready(function() {
    $('#example').DataTable({
      "info": false,
      "lengthChange": false,
      "ordering": false,
    language: {
    search: "_INPUT_",
        searchPlaceholder: "Search"
    }
    });
});*/


/*Contact US Ajax Start*/
/*$(document).ready(function(){
  $("form#contactform").submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    var url = 'home/contact_us_form/'; 
    $.ajax({
      type: "POST",
      url: url,
      data: formData,
      success: function(response) {
        $("#contactform")[0].reset();
        //alert(response);
        var myJSON = JSON.parse(response); 
        if(myJSON['status'] == 1 ){
            //alert(myJSON['msg']);
            $('#cntc-msg').html(myJSON['msg']).css("color", "#fff");
            $('#cntc-msg').html(myJSON['msg']).css("background", "green");
        }else if(myJSON['status'] == 0 ){
            //alert(myJSON['msg']);
            $('#cntc-msg').html(myJSON['msg']).css("color", "#fff");
            $('#cntc-msg').html(myJSON['msg']).css("background", "red");
        }
      },
      error: function(errorThrown) {
        alert('Something is wrong!');
      }
    });
  });

});*/
/*Contact US Ajax End*/
