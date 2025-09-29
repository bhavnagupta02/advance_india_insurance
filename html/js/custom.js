$('.input-group.date').datepicker({format: "dd.mm.yyyy"});

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