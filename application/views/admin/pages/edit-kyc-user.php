<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <?php echo $this->session->flashdata('msg'); ?>
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>View <?php //print_r($user_detail); 
                                    if(isset($user_detail['name'])){ echo $user_detail['name']; }?> Details</h4>
                                    <?php if($user_detail['verification_status']==0){?>
                                    <span class="pending_verifctn">Verificalition Pending</span>
                                    <?php } else{?>
                                    <span class="kyc_verified">KYC Verified</span>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('admin/dashboard');?>"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/view-users');?>"> View Users </a>
                                    </li>
                                    <li class="breadcrumb-item">View Details
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content">
                                <!-- tab panel personal start -->
                                <div class="tab-pane active" id="personal" role="tabpanel">
                                    <!-- personal card start -->
                                    <div class="card">
                                        <!-- <div class="card-header">
                                            <h5 class="card-header-text">About Me</h5>
                                        </div> -->
                                        <div class="card-block">
                                            <div class="view-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div id="wizard">
                                                            <section>
                                                            <form class="wizard-form" id="example-advanced-form" action="" name="edit_profile" method="POST" enctype="multipart/form-data">
                                                                <h5>Basic Details</h5><br/>
                                                                <fieldset>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName" class="block">Name *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="userName" name="name" type="text" class="form-control" value="<?php if(isset($user_detail['name'])){ echo $user_detail['name']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="email" class="block">Email *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="email" name="email" type="email" class="form-control" value="<?php if(isset($user_detail['email'])){ echo $user_detail['email']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="phoneNumber" class="block">Mobile No. *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="phoneNumber" name="mobile_number" type="text" class="required form-control" value="<?php if(isset($user_detail['mobile_number'])){ echo $user_detail['mobile_number']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="skype" class="block">Date of Birth</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="skype" name="dob" type="text" class=" form-control" value="<?php if(isset($user_detail['dob'])){ echo $user_detail['dob']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="twitter" class="block">Pan No.</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="twitter" name="pan_number" type="card-header-text" class="form-control" value="<?php if(isset($user_detail['pan_number'])){ echo $user_detail['pan_number']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="website" class="block">Aadhar No.</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="website" name="aadhar_number" type="text" class="form-control" value="<?php if(isset($user_detail['aadhar_number'])){ echo $user_detail['aadhar_number']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="website" class="block">City</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="city" name="city" type="text" class="form-control" value="<?php if(isset($user_detail['city'])){ echo $user_detail['city']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="form-group profl-pc">
                                                                      <div>
                                                                        <label for="exampleInputFile">Upload Profile Pic</label>
                                                                      </div>
                                                                      <div class="profile_pic_cnt">
                                                                          <img class="profile-user-img img-responsive img-circle blah_profile" src="<?php if(isset($this->user_detail['profile_pic']) && trim($this->user_detail['profile_pic'])!=""){ echo base_url().$this->user_detail['profile_pic'];}else{echo $this->config->item('base_url')."assets/images/avatar-4.jpg";} ?>" alt="User profile picture">
                                                                          <input type="file" name="img" class="profile_img" >
                                                                        </div>
                                                                    </div> -->
                                                                </fieldset>

                                                                <h5>Bank Details</h5><br/>
                                                                <fieldset>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="userName" class="block">Beneficiary Name</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="userName" name="benificiary_name" type="text" class="form-control" value="<?php if(isset($user_detail['benificiary_name'])){ echo $user_detail['benificiary_name']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="email" class="block">Account No.</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="email" name="account_number" type="email" class="form-control" value="<?php if(isset($user_detail['account_number']) & $user_detail['account_number']!=0){ echo $user_detail['account_number']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="IFSCCode" class="block">IFSC Code</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="IFSCCode" name="ifsc_code" type="text" class="required form-control" value="<?php if(isset($user_detail['ifsc_code'])){ echo $user_detail['ifsc_code']; }?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <h5>Uploaded Documents</h5><br/>
                                                                <fieldset class="user-details">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="" class="block">Pan Card</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <?php if(isset($user_detail['pan_file'])){?>
                                                                            <a href="<?php echo base_url()."".$user_detail['pan_file'];?>" target="_blank"><img class="doc_files" src="<?php echo base_url()."".$user_detail['pan_file']; ?>"></a>
                                                                            <?php }else{?>
                                                                            <img class="doc_files" src="<?php echo base_url('assets/admin/images/image-not-available.png'); ?>">
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="" class="block">Aadhar Card</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <?php if(isset($user_detail['aadhar_file'])){?>
                                                                            <a href="<?php echo base_url()."".$user_detail['aadhar_file'];?>" target="_blank"><img class="doc_files" src="<?php echo base_url()."".$user_detail['aadhar_file']; ?>"></a>
                                                                            <?php }else{?>
                                                                            <img class="doc_files" src="<?php echo base_url('assets/admin/images/image-not-available.png'); ?>">
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="" class="block">10th Certificate</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <?php if(isset($user_detail['certificate_file'])){?>
                                                                            <a href="<?php echo base_url()."".$user_detail['certificate_file'];?>" target="_blank"><img class="doc_files" src="<?php echo base_url()."".$user_detail['certificate_file']; ?>"></a>
                                                                            <?php }else{?>
                                                                            <img class="doc_files" src="<?php echo base_url('assets/admin/images/image-not-available.png'); ?>">
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="" class="block">Photograph</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <?php if(isset($user_detail['photo_file'])){?>
                                                                            <a href="<?php echo base_url()."".$user_detail['photo_file'];?>" target="_blank"><img class="doc_files" src="<?php echo base_url()."".$user_detail['photo_file']; ?>"></a>
                                                                            <?php }else{?>
                                                                            <img class="doc_files" src="<?php echo base_url('assets/admin/images/image-not-available.png'); ?>">
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="" class="block">Cancelled Cheque</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <?php if(isset($user_detail['cheque_file'])){?>
                                                                            <a href="<?php echo base_url()."".$user_detail['cheque_file'];?>" target="_blank"><img class="doc_files" src="<?php echo base_url()."".$user_detail['cheque_file']; ?>"></a>
                                                                            <?php }else{?>
                                                                            <img class="doc_files" src="<?php echo base_url('assets/admin/images/image-not-available.png'); ?>">
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <?php if($user_detail['verification_status']==0){?>
                                                                <a href="<?php echo base_url(); ?>admin/admin/kyc_verification/<?php if(isset($user_detail['id'])){ echo $user_detail['id']; }?>" class="update_profile_btn btn btn-primary m-r-10 m-b-5">Verify KYC</a>
                                                                <?php }?>
                                                            </form>
                                                        </section>
                                                    </div>
                                                    <!-- end of general info -->
                                                </div>
                                                <!-- end of col-lg-12 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of view-info -->                                  
                                    </div>
                                    <!-- end of card-block -->
                                </div>                                    
                            </div>                  
                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
        </div>
    </div>
    </div>
</div>