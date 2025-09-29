  <div class="Contact-section ">
    <div class="container mrg-T45">
    	<?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
              <div class="col-md-12">
                <h2 class="mrg-L20 ownerHeadMob">Get In Touch</h2>
              </div>
            </div>

      <div class="row">
      	<span id="cntc-msg"></span>
        <div class="col-md-12 col-lg-12 col-sm-12">
          <form method="post" id="contactform1">
          <div class="input-group">
          <input type="text" name="fullname" value="<?php if(!empty($this->user_data['name'])){ echo $this->user_data['name']; }?>" placeholder="Full Name" required>
          </div>
          <div class="input-group">
          <input type="email" name="email" value="<?php if(!empty($this->user_data['email'])){ echo $this->user_data['email']; }?>" placeholder="Email" required>
          <span class="validation"></span>
          </div>
          <div class="input-group">
          <input type="text" name="phone" value="<?php if(!empty($this->user_data['mobile_number'])){ echo $this->user_data['mobile_number']; }?>" placeholder="Phone No" minlength="10" maxlength="11" required>
          </div>
          <div class="input-group">
          <textarea name="message" data-limit=350 cols="10" rows="10" placeholder="Message" required></textarea>
          <span class="countdown"></span>
          </div>
          <div class="input-group submit">
          <!-- <input type="submit" name="submit" value="Submit"> -->
          <button type="submit" class="btn contact-us">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
</div>
<div class="clearfix"></div>
