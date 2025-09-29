/*BG JS Code Start*/
$(function() {
/*Success Message JS*/
setTimeout(function() {
    $('.alert-success, .alert-danger').fadeOut('slow');
}, 5000); // <-- time in milliseconds
/*Success Message JS End*/
});

//Registeration date > Mfg. Date Validation
//$("#MFGdate, #REGdate").datepicker({format: "dd M yyyy"});

var year = (new Date).getFullYear();
/*alert(new Date(year-19, 0, 1));
alert(new Date(year, 11, 31));*/
$("#MFGdate, #REGdate").datepicker({
  todayHighlight: true,
  autoclose: true,
  endDate: new Date(year, 11, 31),
  startDate: new Date(year-19, 0, 1)
	/*endDate: "+252d",
	//autoclose: true,
	startDate: '-7052d'*/
});
$("#MFGdate").change(function () {
    //var regYear = document.getElementById("RegYear").value;
    var mfgDate = document.getElementById("MFGdate").value;
    var regDate = document.getElementById("REGdate").value;
    if((Date.parse(mfgDate) >= Date.parse(regDate))) {
      $('.datevalidation').html('Mfg. date should be less than Registration date').css("color", "red");
      //setTimeout(function() {$('.datevalidation').fadeOut('slow');}, 5000);
      document.getElementById("MFGdate").value = "";
    }
    else if(Date.parse(regDate) >= Date.parse(mfgDate)){
      $('.datevalidation').html('Mfg. date is valid').css("color", "green");
    }
});

$(document).ready(function() {
  //Vehicle on company checkbox validation JQuery
  $("#is_company_vehicle").change(function() {
    if(this.checked) {
      $(".companyFields").show();
      $("input[name='company_name']").attr("required", "true");
      $(".nonCompanyFields").hide();
      $("input[name='first_name']").removeAttr("required");
    } else {
      $(".companyFields").hide();
      $("input[name='company_name']").removeAttr("required");
      $(".nonCompanyFields").show();
      $("input[name='first_name']").attr("required", "true");
    }
  });
  //correspondence add same as regis. add checkbox validation JQuery
  $("#is_corr_address_same").change(function() {
    if(this.checked) {
      //alert(1);
      $(".correspondence_add").hide();
      $("textarea[name='corrs_address_line1'], input[name='corr_pin_code'], select[name='corr_state'], select[name='corr_city']").removeAttr("required");
    } else {
      //alert(2);
      $(".correspondence_add").show();
      $("textarea[name='corrs_address_line1'], input[name='corr_pin_code'], select[name='corr_state'], select[name='corr_city']").attr("required", "true");
    }
  });
  //Vehicle presently on loan checkbox validation JQuery
  $("#is_car_on_loan").change(function() {
    if(this.checked) {
      $("#financial_detail").show();
      $("input[name='financial_company_name']").attr("required", "true");
    } else {
      $("#financial_detail").hide();
      $("input[name='financial_company_name']").removeAttr("required");
    }
  });

});

// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop propertychange paste", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  };
}($));

// Input fields Validation. // removed the  input[name='address'],
$("input[name='first_name'], input[name='last_name'], input[name='company_name'], input[name='nominee_name']").inputFilter(function(value) {
  return /^[a-z\s]*$/i.test(value);
});

$("input[name='primary_pin_code'], input[name='corr_pin_code'], input[name='nominee_age']").inputFilter(function(value) {
  return /^\d*$/.test(value);
});

//Textarea special character validation
/*$("textarea[name='primary_address_line1']").inputFilter(function(value) {
  return /^[a-zA-Z0-9\s]*$/.test(value);
});*/

//Email Validation
$("input[name='email']").on('propertychange keyup input paste', function(){
  //var em_name = $(this).attr("name");
  var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
  if(valid){
    $("input[name='email']").css("border-color", "green");
    $('.validation').html('valid email').css("color", "green");
  }
  else{
    $("input[name='email']").css("border-color", "red");
    $('.validation').html('Enter a valid email id').css("color", "red").css("font-size", "13px");
  }
});

//Phone Validation
$("input[name='phone_no']").keypress(function (event) {
  var keycode = event.which;
  if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
    //alert(1);
    event.preventDefault();
  }
});

/*Declaration checkbox validation JQuery Start*/
$("#is_declare").change(function() {
  if(this.checked){
    $('.req').html('');
    $('.custom-check1.mrg-mb-t1').css({'border':'2px solid green'}).css({'padding':'4px'});
    return true;
  } else{
    $('.custom-check1.mrg-mb-t1').css({'border':'2px solid red'}).css({'padding':'4px'});
    $('.req').html('Please check declaration box!').css("color", "red").css("font-weight", "600");
    return false;
  }
});
$("#madePayment").click(function() {
  var chkDeclare = document.getElementById("is_declare");
  //alert(chkDeclare.checked);
  if(chkDeclare.checked != true){
    $('.custom-check1.mrg-mb-t1').css({'border':'2px solid red'}).css({'padding':'4px'});
    $('.req').html('Please check declaration box!').css("color", "red").css("font-weight", "600");
    return false;
  }
});
/*Declaration checkbox validation JQuery End*/

/*//Function to check letters and numbers
$("input[name='vehicle_regis_no']").keypress(function() {
  var letterNumber = /^[0-9a-zA-Z]+$/;
  if(this.value.match(letterNumber)){
    return true;
    //alert('Success');
  }else{ 
   //alert('Please input alphanumeric characters only'); 
   return false; 
  }
});*/

//Get City List Based on State Code Start
$(document).ready(function(){
  //Get Primary City List
  $('#primary_state').change(function(){
    var state_name = $('#primary_state').val();
    var fun_url = $(this).attr("data-url");
    /*alert(state_name);
    alert(fun_url);*/
    if(state_name != '')
    {
     $.ajax({
      url:fun_url,
      method:"POST",
      //dataType: 'html',
      data:{state_name:state_name},
      success:function(data){
        //alert(data);
        //return false;
        $('#city').html(data);
      }
     });
    }
    else{
     $('#city').html('<option value="">Select City</option>');
    }
  });

  //Get Correspondence City List
  $('#corr_state').change(function(){
    var Cstate_name = $('#corr_state').val();
    var fun_url = $(this).attr("data-url");
    if(Cstate_name != '')
    {
     $.ajax({
      url:fun_url,
      method:"POST",
      //dataType: 'html',
      data:{state_name:Cstate_name},
      success:function(data){
        $('#corr_city').html(data);
      }
     });
    }
    else{
     $('#corr_city').html('<option value="">Select City</option>');
    }
  });

  //Get Variants List based on Model Selection in CAR/BIKE
  /*$('#make_model').change(function(){
    var makeModel = $('#make_model').val();
    var fun_url = $(this).attr("data-url");
    var vehicleType = $(this).attr("data-vehicle-type");
    //alert(makeModel+'--'+vehicleType);
    //alert(fun_url);
    if(makeModel != '')
    {
     $.ajax({
      url:fun_url,
      method:"POST",
      data:{model_name:makeModel, vehicle_type:vehicleType},
      success:function(data){
        $('#variant').html(data);
      }
     });
    }
    else{
     $('#variant').html('<option value="">Select Variant</option>');
    }
  });*/
  
  //Get Cube Capacity & Amount option based on Variant Selection in CAR/BIKE
  $('#variant').change(function(){
    var vehicleVariant = $('#variant').val();
    var variant_id = $(this).find(':selected').attr("data-variant-id");
    var fun_url = $(this).attr("data-url");
    var vehicleType = $(this).attr("data-vehicle-type");
    //alert(vehicleVariant+'---'+variant_id+'--'+fun_url+'--'+vehicleType);
    if(vehicleVariant != '')
    {
     $.ajax({
      url:fun_url,
      method:"POST",
      data:{vid:variant_id, vehicle_type:vehicleType},
      success:function(data){
        $('#cubeCapacity').html(data);
      }
     });
    }
    else{
     $('#cubeCapacity').html('<option value="">Select Engine CC</option>');
    }
  });

});
//Get City List Based on State Code End

/*Address Textarea Length Validation*/
$('textarea').on("propertychange keyup input paste", function () {
  var limit = $(this).data("limit");
  var remainingChars = limit - $(this).val().length;
  if (remainingChars <= 0) {
    $(this).val($(this).val().substring(0, limit));
  }
  $(this).next('span').text(remainingChars<=0?0:+remainingChars + ' characters left');
});
/*Address Textarea Length Validation End*/

/*BG JS Code End*/

/*Santosh JS Code*/
$('.input-group.date').datepicker({
  format: "dd-mm-yyyy",
  todayHighlight: true,
  autoclose: true,
});

$(document).ready(function(){

       $('.userFile').on('change', function (e) {

           $('.error-msg').html('');           

           var isValidFile = validateFile($(this).val());

           if(isValidFile){

               var name = $(this).attr('name');

               showFileThumbnail(name);

           }else{

               $(this).val(''); 

               $('.documentErrorMsg').html('Please upload document in jpeg or png format');

           }

       }); 

       

       $('.cancel').on('click', function (e) { 

           e.preventDefault();

           $(this).siblings('.userFile').val('');

           $(this).siblings('.userFileThumbnail').css('display','none');

           return false;

       });

       

       $('.upl-img').hover(function(){

           $(this).parents('.userFileThumbnail').siblings('.cancel').show();

           //$(this).next('.cancel').show();

       });

   

       $('.flt').mouseleave(function(){

           $(this).find('.cancel').hide();

       });



       

   });

   function validateFile(fileName){

       var extension = fileName.replace(/^.*\./, '');

       if(extension == fileName) {

           extension = '';

       }else {

           extension = extension.toLowerCase();

       }

       if(extension === 'png' || extension === 'jpg' || extension === 'jpeg'){

           return true;

       }

       return false;

   }

   

   function showFileThumbnail(name){

       var reader = new FileReader();

       reader.onload = function (e) {

           $('input[name="'+name+'"]').siblings('.userFileThumbnail').find('img')

               .attr('src', e.target.result)

               .width(140)

               .height(140);

           $('input[name="'+name+'"]').siblings('.userFileThumbnail').find('img').css("background-color","#f1f3f6");

              

       };

      

       reader.readAsDataURL($('input[name="'+name+'"]')[0].files[0]);

       $('input[name="'+name+'"]').siblings('.userFileThumbnail').css('display','block');

   }

/*Santosh JS Code End*/