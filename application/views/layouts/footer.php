<!-- Footer --> 
</div>
<div class="clearfix"></div>
<?php $is_home = $this->router->fetch_method() === 'index' ? true : false;?>
<footer class="text-left <?php if($is_home==1){echo 'foot-pd  footerCustom';}?>"  style="display: block; height: 81px;">
  <div class="row">
    <div class="col-md-5 ftr-left-sec">
      <p class="copyright"><span class="ftr-cotyright-txt"> Copyright © 2020 Advance India Insurance Broker Services Ltd.<br>
        </span> All rights reserved. </p>
    </div>
    <div class="col-md-7 pull-right ftr-right-sec">
      <ul class="foot-policy clearfix">
        <!-- <li><a href="<?php echo base_url('#'); ?>">Privacy Policy</a></li>
        <li><a href="<?php echo base_url('#'); ?>">Shipping Policy</a></li>
        <li><a href="<?php echo base_url('#'); ?>">Grievance Redressal Policy</a></li>
        <li><a href="<?php echo base_url('#'); ?>">Refund and Cancellation</a></li> -->
        <li><a href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li>
      </ul>
    </div>
  </div>
</footer>
<!--JS files-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/standalone/selectize.js'); ?>" type="text/javascript"></script>
<!-- Make Model & RTO City Search Functionality Start -->
<script type="text/javascript">
var jq14 = jQuery.noConflict(true); 
(function ($) {
  $(document).ready(function () {
    $("#make_model, #rtoCity, #RegYear").selectize({
        //placeholder: "Search...",
        //allowClear: true
    });
    
    //Get Variants List based on Model Selection in CAR/BIKE
    $('#make_model').change(function(){
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
            $('#cubeCapacity').html('<option value="">Select Engine CC</option>');
          }
         });
        }
        else{
         $('#variant').html('<option value="">Select Variant</option>');
        }
    });
    
  });
}(jq14));
</script>
<!-- Make Model & RTO City Search Functionality End -->

<script src="<?php echo base_url('assets/js/common_custom.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/common_compress_script.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/script.js'); ?>" type="text/javascript"></script>

<script src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js'></script>
<script>$('table#DataTable').DataTable();</script>

<!-- BG Razorpay Payment Gateway Integration Script will load only on Payment Summary Page Start Here-->
<?php if($this->uri->segment(1) == 'payment-summary'){?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- <script src="https://checkout.razorpay.com/v1/razorpay.js"></script> -->
<script>
var SITEURL = "<?php echo base_url() ?>";
var LogoImg = "<?php echo base_url('assets/images/acko.png') ?>";
var InsType = "<?php echo $this->uri->segment(2) ?>";
var InsId = "<?php echo $this->uri->segment(3) ?>";
//alert(SITEURL + 'thankyou/'+InsType+'/'+InsId);

$('body').on('click', '.buy_now', function(e){
  var totalAmount = $("input[name=total_amount]").val();
  var PayBy = $("input[name=pay_by]").val();
  /*var totalAmount = $(this).attr("data-amount");
  var product_id =  $(this).attr("data-id");*/
  
  var InsPId = $("input[name=insplc_id]").val();
  var email = $("input[name=ph_email]").val();
  var mobile_number = $("input[name=ph_phone_no]").val();
  
  var LoadingText = 'Plesae wait while getting response from your bank..';
  var options = {
  //"key": "rzp_live_ILgsfZCZoFIKMb", // This API Key is belong to tutsmake site
  //"key": "rzp_test_fWceCQJLQxjWo8",
  "key": "rzp_live_ALUUAGqWx2etji",
  "amount": (totalAmount*100), // 2000 paise = INR 20
  "currency": "INR",
  "name": "Acko",
  "description": "Instant policy post payment!",
  "image": LogoImg,
  /*"prefill": {
  // "name": "<?php if(isset($this->user_data['name'])){ echo $this->user_data['name']; }?>",
  "email": "<?php if(isset($this->user_data['email'])){ echo $this->user_data['email']; }?>",
  "contact": <?php if(isset($this->user_data['mobile_number'])){ echo '91'.$this->user_data['mobile_number']; }?>,
  },
  "prefill": {
  "email": email,
  "contact": mobile_number,
  },*/
  
  "prefill": {
  "email": "support@posadvanceinsurance.com",
  "contact": "919999999999",
  },
  "readonly": {
    "email": 1,
    "contact": 1
  },
  
  "handler": function (response){
    //alert(JSON.stringify(response)); //return false;
    //Image loader start
      $('body').append('<div id="resultLoading" style="display:block"><div><img src="<?php echo base_url('assets/images/ajax-loader.gif') ?>"><div>'+LoadingText+'</div></div><div class="bg"></div></div>');
      $('#resultLoading').css({'display':'block'});
      $('#resultLoading').css({'width':'100%','height':'100%','position':'fixed','z-index':'10000000','top':'0','left':'0','right':'0','bottom':'0','margin':'auto'});
      $('#resultLoading .bg').css({'background':'#000000','opacity':'0.7','width':'100%','height':'100%','position':'absolute','top':'0'});
      $('#resultLoading>div:first').css({'width': '250px','height':'75px','text-align': 'center','position': 'fixed','top':'0','left':'0','right':'0','bottom':'0','margin':'auto','font-size':'16px','z-index':'10','color':'#ffffff'});
    //Image loader end
      $.ajax({
        url: SITEURL + 'success/'+InsType+'/'+InsId,
        type: 'post',
        dataType: 'json',
        data: {
          razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,pay_by : PayBy ,InsType : InsType ,InsId : InsPId,
        },
        /*data: {
          razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
        },
        success: function (msg) {
          //window.location.href = SITEURL + 'home/RazorThankYou';
        }*/
        success: function (FunResponse) {
          //alert(FunResponse);
          if(FunResponse){
            window.location.href = SITEURL + 'thankyou/'+InsType+'/'+InsId;
          }
          else{
            window.location.href = SITEURL + 'payment-summary/'+InsType+'/'+InsId;
          }
        },
        error: function() {
          alert('Something is wrong, Please try again!');
          $('#resultLoading').css({'display':'none'});
        }
    });
  },
  "theme": {
      "color": "#7c64c2",
      "hide_topbar": true
  }
};

var rzp1 = new Razorpay(options);
rzp1.open();
e.preventDefault();
});

</script>
<?php }?>
<!-- BG Razorpay Payment Gateway Integration Script will load only on Payment Summary Page End Here-->

</body>
</html>