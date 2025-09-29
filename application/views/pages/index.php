  <style>
    footer{background-color: transparent;}
    ul.foot-policy a{ color: #fff;}
    ul.foot-policy li{ border-right: 1px solid #fff;opacity: 0.54}
    ul.foot-policy a:hover{ color: #e86335;}
    .copyright{color: #fff; opacity: 0.54}
  </style>
  <div class=" girnarlogin inner login_cstm">
  <div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 left-login">
          <img src="<?php echo base_url('assets/images/Used-cars.png');?>"> 
      </div>
        <div class="col-lg-6 col-md-6 right-login">
      <div class="heading-wrap">
        <?php echo $this->session->flashdata('msg'); ?>
        <h1><span class="fnt-wt500">Login</span> <span class="fnt-wt300">to Your Partner Account</span></h1>
        <!--<p>Some dummy content required here like</p>--> 
      </div>
      <div class="login clearfix">
        <form method="post">
          <div class="col-md-12">
            <div class="form-group">
                <i class="fa fa-user"></i>
              <input class="login-field login-field-username" name="email_mobile" type="text" placeholder="Email/Mobile" required>
            </div>
          </div>
		      <div class="col-md-12 otp_container">
               <div class="form-group">
               <i class="fa fa-lock"></i>
               <input class="login-field login-field-password" name="password" id="otp" type="password" placeholder="Password" autocomplete="on" required>                            
               </div>
           </div>
          <div class="col-md-12 send_otp_btn_container">
            <div class="form-group mrg-bt0">
              <button class="btn login_btn send_otp_btn" type="submit">LOGIN</button>
            </div>
          </div>
        </form>
      </div>
      </div>
      
    </div>
  </div>
  </div>
  
  