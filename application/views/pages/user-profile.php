<div class="container_space padding-mobile user-profile">

  <div id="band" class="container ">
    <div class="row">
      <div class="col-md-12 head-area">
        <h3 class="mainHeading">My Profile <span class="sub-heading"><img class="profile-img " src="<?php echo base_url('assets/images/verified.png');?>"></span></h3>
      </div>
    </div>
    <section class="contentSection mainFilter marg edit-box-basic card cstm cardMob padAll-15 user-first">
      <div class="row">
        <div class="col-md-6 col-xs-6 mrg-B10">
          <h3 class="SubHeading mrg-T10">Basic Details</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">Full Name</span> <span id="fullName" class="inp-txt"><?php if(isset($user_detail['name'])){echo $user_detail['name'];}?></span> </div>
        <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">Mobile No.</span> <span id="mobileNumber" class="inp-txt"><?php if(isset($user_detail['mobile_number'])){echo $user_detail['mobile_number'];}?></span> </div>
        <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">Email ID</span> <span id="emailId" class="inp-txt"><?php if(isset($user_detail['email'])){echo $user_detail['email'];}?></span> </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">Date of Birth</span> <span id="dob" class="inp-txt"><?php if(isset($user_detail['dob'])){echo $user_detail['dob'];}?></span> </div>
        <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">PAN No.</span> <span id="panNumber" class="inp-txt"><?php if(isset($user_detail['pan_number'])){echo $user_detail['pan_number'];}?></span> </div>
        <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">Aadhar No.</span> <span id="aadhar" class="inp-txt"><?php if(isset($user_detail['aadhar_number'])){echo $user_detail['aadhar_number'];}?></span> </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">City</span> <span id="cityName" class="inp-txt"><?php if(isset($user_detail['city'])){echo $user_detail['city'];}?></span> </div>
        <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">Status</span> <span id="user_status" class="inp-txt"><?php if($user_detail['verification_status']==1){echo 'Active';}?></span> </div>
      </div>
      <div class="clearfix"></div>
    </section>
    <section class="contentSection mainFilter edit-box-bank bankSection card cstm cardMob padAll-15 user-second">
      <div class="row ">
        <div class="col-md-4 col-xs-12  mrg-B10">
          <h3 class="SubHeading">Bank Details</h3>
        </div>
      </div>
      <div class="row bank-box">
        <div class="col-md-4 form-group "> <span class="lab-txt">Beneficiary Name</span> <span id="benificiaryNameText" class="inp-txt"><?php if(isset($user_detail['benificiary_name'])){echo $user_detail['benificiary_name'];}?></span> </div>
        <div class="col-md-4 form-group "> <span class="lab-txt">Account No.</span> <span id="accountNumberText" class="inp-txt"><?php if(isset($user_detail['account_number']) && $user_detail['account_number']!=0){echo $user_detail['account_number'];}?></span> </div>
        <div class="col-md-4 form-group "> <span class="lab-txt">IFSC Code</span> <span id="ifscCodeText" class="inp-txt"><?php if(isset($user_detail['ifsc_code'])){echo $user_detail['ifsc_code'];}?></span> </div>
      </div>
      <div class="clearfix"></div>
    </section>
    <section class="contentSection mainFilter documentSection card cstm cardMob padAll-15 user-third">
      <form >
        <div class="row ">
          <div class="col-md-6 mrg-B10">
            <h3 class="SubHeading  mg-cm">Uploaded Documents</h3>
          </div>
        </div>
        <input type="hidden" name="document_type" value="">
        <div class="error-msg pos-rel documentErrorMsg" style="position:relative;"></div>
        <ul class="add-file add-new-file">
          <li class="flt">
            <input class="img-upl userFile" style="float:right;" type="file" name="user_pan_file">
            <button class="btn"></button>
            <div class="userFileThumbnail verified "> <img class="upl-img userPanFileThumbnail" src="<?php if(isset($user_detail['pan_file'])){echo base_url().$user_detail['pan_file'];}else{echo base_url('assets/images/image-not-available.png');}?>"> </div>
            <span class="img-txt">PAN</span>
            <div class="file-preloader"></div>
          </li>
          <li class="flt">
            <input class="img-upl userFile" style="float:right;" type="file" name="user_aadhar_file">
            <button class="btn"></button>
            <div class="userFileThumbnail verified " > <img class="upl-img userAadharFileThumbnail" src="<?php if(isset($user_detail['aadhar_file'])){echo base_url().$user_detail['aadhar_file'];}else{echo base_url('assets/images/image-not-available.png');}?>" > </div>
            <span class="img-txt">Aadhar</span>
            <div class="file-preloader"></div>
          </li>
          <!--Adhar Back Start-->
          <!-- <li class="flt">
            <input class="img-upl userFile" style="float:right;" type="file" name="user_aadhar_back_file">
            <button class="btn"></button>
            <div class="userFileThumbnail  " data-toggle="modal" data-target="#verify" data-tab="3" data-type="aadhar_back" data-document_id="" data-document_status="" style="display:none"> <img class="upl-img userAadharBackFileThumbnail" src="" file-path=""> </div>
            <span class="img-txt">Aadhar Back</span>
            <div class="file-preloader"></div>
          </li> -->
          <!--Adhar Back END-->
          <li class="flt">
            <input class="img-upl userFile" style="float:right;" type="file" name="user_certificate_file">
            <button class="btn"></button>
            <div class="userFileThumbnail verified "> <img class="upl-img userCertificateFileThumbnail" src="<?php if(isset($user_detail['certificate_file'])){echo base_url().$user_detail['certificate_file'];}else{echo base_url('assets/images/image-not-available.png');}?>"> </div>
            <span class="img-txt">10th Certificate</span>
            <div class="file-preloader"></div>
          </li>
          <li class="flt">
            <input class="img-upl userFile" style="float:right;" type="file" name="user_photo_file">
            <button class="btn"></button>
            <div class="userFileThumbnail verified "> <img class="upl-img userPhotoFileThumbnail" src="<?php if(isset($user_detail['photo_file'])){echo base_url().$user_detail['photo_file'];}else{echo base_url('assets/images/image-not-available.png');}?>" > </div>
            <span class="img-txt">Photo</span>
            <div class="file-preloader"></div>
          </li>
          <li class="flt">
            <input class="img-upl userFile" style="float:right;" type="file" name="user_cheque_file">
            <button class="btn"></button>
            <div class="userFileThumbnail verified "> <img class="upl-img userChequeFileThumbnail" src="<?php if(isset($user_detail['cheque_file'])){echo base_url().$user_detail['cheque_file'];}else{echo base_url('assets/images/image-not-available.png');}?>"> </div>
            <span class="img-txt">Cancel Cheque</span>
            <div class="file-preloader"></div>
          </li>
        </ul>
      </form>
      <div class="clearfix"></div>
    </section>
  </div>

</div>
<div class="clearfix"></div>
