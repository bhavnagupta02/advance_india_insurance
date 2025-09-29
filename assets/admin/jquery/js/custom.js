$(function() 
{
  // Edit Profile Form Validations //
   jQuery.validator.addMethod("phonenu", function (value, element) 
   {
        //if(/^\d{3}-?\d{3}-?\d{6}$/g.test(value)) 
        if(value.length<10 || value.length>15) 
        {
            return false;
        } 
        else 
        {
            return true;
        };
    }, "Invalid phone number");
   jQuery.validator.addMethod("websiteurl", function (value, element) 
   {
        var myVariable = value;
        if(myVariable!="")
        {
          if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(myVariable)) 
          {
            return true;
          }
          else 
          {
              return false;
          }   
        } 
        else 
        {
          return true;
        }   
    }, "Invalid website url");
   $("form[name='edit_profile']").validate({
    rules: 
    {
      userName: "required",
      email: {
        required: true,
        email: true
      },
      phoneNumber: {
                phonenu: true,
                required: true
            },
      website: {
                websiteurl: true,
            }
    },

    // Specify validation error messages
    messages: 
    {
      userName: "Please enter your name",
      email: "Please enter a valid email address",
      phoneNumber: "Please enter phone number",
      website: "Please enter a valid url",
    },
    submitHandler: function(form) 
    {
      form.submit();
    }
  });

  /*Success Message JS*/
  setTimeout(function() {
      $('.alert-success, .alert-danger').fadeOut('slow');
  }, 5000); // <-- time in milliseconds
  /*Success Message JS End*/

});
// VALIDATION SCRIPT FOR NUMBERS //
function isNumber(evt) 
{
  var iKeyCode = (evt.which) ? evt.which : evt.keyCode
  if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
      return false;
  return true;
}  
$(document).ready(function() {
  $('#example').DataTable();
} );