$(function() {
/*Success Message JS*/
setTimeout(function() {
    $('.alert-success, .alert-danger').fadeOut('slow');
}, 5000); // <-- time in milliseconds
/*Success Message JS End*/
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
  $("input[name='name'], input[name='first_name'], input[name='city'], input[name='benificiary_name'], input[name='fullname']").inputFilter(function(value) {
    return /^[a-z\s]*$/i.test(value); });
  /*$("input[name='zip'], input[name='unit_suite']").inputFilter(function(value) {
    return /^\d*$/.test(value); });*/

/*Email Validation*/
$("input[name='email']").on('propertychange keyup input paste', function(){
  //var em_name = $(this).attr("name");
  var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
  if(valid){
    $("input[name='email']").css("border-color", "green");
    //$('.validation').html('<i class="fa fa-check" aria-hidden="true"></i>').css("color", "green");
    $('.validation').html('valid email').css("color", "green");
  }
  else{
    $("input[name='email']").css("border-color", "red");
    //$('.validation').html('<i class="fa fa-times" aria-hidden="true"></i>').css("color", "red");
    $('.validation').html('Enter a valid email id').css("color", "red").css("font-size", "13px");
  }
});
/*Validation End*/

// Mobile Number Validation.
$("input[name='mobile_number'], input[name='aadhar_number'], input[name='account_number'], input[name='phone']").keypress(function (event) {
  var keycode = event.which;
  if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
    //alert(1);
    event.preventDefault();
  }
});

/*Textarea Length Validation*/
$('textarea').on("propertychange keyup input paste", function () {
  var limit = $(this).data("limit");
  var remainingChars = limit - $(this).val().length;
  if (remainingChars <= 0) {
    $(this).val($(this).val().substring(0, limit));
  }
  $(this).next('span').text(remainingChars<=0?0:+remainingChars + ' characters left');
});
/*Textarea Length Validation End*/

/*$(function () {
    $("#txtFromDate").datepicker({
        format: "dd/mm/yyyy",
        numberOfMonths: 2,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#txtToDate").datepicker("option", "minDate", dt);
        }
    });
    $("#txtToDate").datepicker({
        format: "dd/mm/yyyy",
        numberOfMonths: 2,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#txtFromDate").datepicker("option", "maxDate", dt);
        }
    });
});*/


/*Update Profile Image JS Start*/
/*function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      var htmlPreview =
        // '<img width="200" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
    //alert(reader.readAsDataURL(input.files[0]));
  }
}

function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});

<!--Profile IMG-->
$('#profile_img').click(function() {
    $('.profile_img').trigger('click');
});

function readURLupload(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.profileImg').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$(".profile_img").change(function() {
  readURLupload(this);
});*/
/*Update Profile Image JS End*/

/*Contact US Ajax Start*/
$(document).ready(function(){
  $("form#contactform").submit(function(event) {
    //alert(1);
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

});
/*Contact US Ajax End*/

/*$(function(){
	$('.navbar-light .navbar-nav .nav-link').click(function() {
		//alert($(this).attr('href'));
		$($(this).attr('href')).css("color","red");
		$($(this).attr('href')).addClass('active');
		$('.navbar-light .navbar-nav a[href*="/#our-tutors/"]').addClass('bawmrp_gallery');
	  $($(this).attr('href')).addClass('active').siblings().removeClass('active');
	});
});

function addactive(id){

	if(id ==1){
		$(".active_1").addClass('active');
		$(".active_2").removeClass('active');
		$(".active_3").removeClass('active');
		$(".active_4").removeClass('active');
		$(".active_5").removeClass('active');	
	}if(id ==2){
		$(".active_1").removeClass('active');
		$(".active_2").addClass('active');
		$(".active_3").removeClass('active');
		$(".active_4").removeClass('active');
		$(".active_5").removeClass('active');
	}if(id ==3){
		$(".active_1").removeClass('active');
		$(".active_2").removeClass('active');
		$(".active_3").addClass('active');
		$(".active_4").removeClass('active');
		$(".active_5").removeClass('active');
	}if(id ==4){
		$(".active_1").removeClass('active');
		$(".active_2").removeClass('active');
		$(".active_3").removeClass('active');
		$(".active_4").addClass('active');
		$(".active_5").removeClass('active');
	}if(id ==5){
		$(".active_1").removeClass('active');
		$(".active_2").removeClass('active');
		$(".active_3").removeClass('active');
		$(".active_4").removeClass('active');
		$(".active_5").addClass('active');
	}
	//$($(this).attr('href')).addClass('active').siblings().removeClass('active');
	//$($(this).attr('href')).addClass('active').siblings().removeClass('active');
}


$(document).ready(function () {
    $("#remianing_content").hide();
    $("#read_more_less").on("click", function () {
		
		$("#remianing_content").toggle();
       
    });
});


$(document).ready(function () {
    //$("#remianing_content").hide();
    $("#read_less").on("click", function () {
		
		$("#remianing_content").hide();
       
    });
});*/