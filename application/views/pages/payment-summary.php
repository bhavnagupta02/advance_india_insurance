  <?php $this->load->view('layouts/sidebar');?>  
  <!--Start side breadcrumb-->
  <!-- <div class="breadcum-Strip">
    <div class="col-sm-2 sidenav leftSideNav" id="sideBreadCrubmFields">
      <ul id="sideBreadcrumbList">
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('quotes');?>"><span class="img-type"></span> Quotes</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('owner-details');?>"><span class="img-type"></span> Owner Details</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('personal-details');?>" ><span class="img-type"></span>Personal Details</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('vehicle-details');?>" ><span class="img-type"></span> Vehicle Details</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('documents');?>"><span class="img-type"></span> Documents</a></li>
        <li class="side_nav sidenav_icon-active"><a href="<?php echo base_url('payment');?>" class="currentPage"><span class="img-type"></span> Payment</a></li>
      </ul>
    </div>
  </div> -->
  <div class="col-sm-10 col-sm-push-2 Payment-Summary quote-section">
    <?php echo $this->session->flashdata('msg'); ?>
    <div id="band" class="container-fluid bandDetails">
      <div id="wizard" role="application" class="wizard clearfix">
        <div class="content clearfix">
          <section class="tabSec tabSecnew">
            <div class="row">
              <div class="col-md-12">
                <h2 id="policyDocsTitle" class="mrg-L20 ownerHeadMob">Payment Summary</h2>
              </div>
            </div>
          </section>
          <section class="contentSection mainFilter marg edit-box-basic Summary-section">
            <!-- <form method="post" id="myform"> -->
            <!--<div class="borderBottom offlineCard mob-MP0 policyD_spce proposalView_space">
              <div class="row p-sucess-row">
                <div class="col-md-12 payment-status-sucess transaction-msg tmsg_mob" style="border-radius: 0px;box-shadow: none !important;">
                  <ul>
                    <li class="p-s-li w-auto">
                      <div class="s-txt pp-msg-mob"> Important details to review before payment </div>
                    </li>
                    <li class="p-s-li li-btn-sum w-auto "> 
                    
                    <a href="javascript:void(0);" class="trans-btn" id="cancel_case_btn">CANCEL</a> 
                    
                    <a href="<?php //echo base_url();?>" class="trans-btn" target="_blank">Need Help?</a> </li>
                  </ul>
                </div>
              </div>
            </div>
            <hr>-->
            <div class="row">
              <div class="col-md-6 col-xs-12 mrg-B10">
                <h3 class="SubHeading hd_mobile">Policy Details</h3>
              </div>
              <!-- <div class="col-md-6 text-right"> <a href="#" class="edit">EDIT</a> </div> -->
            </div>
            <div class="row">
                <input type="hidden" name="insplc_id" value="<?php if(!empty($exp_policy_data['id'])){ echo $exp_policy_data['id'];}?>">
                <input type="hidden" name="ph_email" value="<?php if(!empty($exp_policy_data['email'])){ echo $exp_policy_data['email'];} ?>">
                <input type="hidden" name="ph_phone_no" value="<?php if(!empty($exp_policy_data['phone_no'])){ echo $exp_policy_data['phone_no'];} ?>">
                
              <div class="">
                <div class="col-md-12 col-xs-12">
                  <div class="">
                    <div class="borderBottom box-cis offlineCard mob-MP0 policyD_spce">
                      <div class="width-1" style="display:inline-block; float:left">
                        <div class="permium-box"> <img src="<?php if(!empty($exp_policy_data['ins_company'])){ echo base_url('assets/images/acko.png');}?>" alt="acko" style="max-width:100px;" title="Acko"> </div>
                      </div>
                      <div class="col-md-2 col-xs-4 form-group ">
                        <div class="permium-amount"> <small>Total Premium</small> <br>
                          <p><?php if(isset($exp_policy_data['total_amount'])){echo "₹ ".$exp_policy_data['total_amount'];}?></p>
                          <input type="hidden" name="total_amount" value="<?php if(isset($exp_policy_data['total_amount'])){echo $exp_policy_data['total_amount'];}?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-xs-4 form-group "> <span class="lab-txt">Basic Third Party</span> <span class="inp-txt"><?php if(isset($exp_policy_data['basic_amount'])){echo "₹ ".$exp_policy_data['basic_amount'];}?></span> </div>
                      <div class="col-md-3 col-xs-4 form-group f-group"> <span class="lab-txt">GST (18%)</span> <span class="inp-txt text-addons" ><?php if(isset($exp_policy_data['gst_amount'])){echo "₹ ".$exp_policy_data['gst_amount'];}?></span> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mrg-T10">
              <div class="col-md-12 col-xs-12">
                <div class="row">
                  <div class="card offlineCard mob-mrgAll15 mob-MP0 policyD_spce">
                    <div class="col-md-4 col-xs-12 form-group"> <span class="lab-txt">Vehicle</span> <span class="inp-txt"><?php if(isset($exp_policy_data['make_model']) && isset($exp_policy_data['variant'])){echo ucwords($exp_policy_data['make_model']." ".$exp_policy_data['variant']);}?></span> </div>

                    <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Manufacturing Date</span> <span class="inp-txt"><?php if(isset($exp_policy_data['mfg_date']) && !empty($exp_policy_data['mfg_date'])){echo date("j M, Y", strtotime($exp_policy_data['mfg_date']));}?></span> </div>

                    <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Registration Date</span> <span class="inp-txt"><?php if(isset($exp_policy_data['reg_date']) && !empty($exp_policy_data['reg_date'])){echo date("j M, Y", strtotime($exp_policy_data['reg_date']));}?></span> </div>

                    <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Cube Capacity </span> <span class="inp-txt"><?php if(isset($exp_policy_data['fuel_capacity_price'])){ $fuel = explode("-", $exp_policy_data['fuel_capacity_price']);
                    echo ucwords($fuel['0']);?>
                    <input type="hidden" name="engine_cc" value="<?php echo $fuel['0'];?>">
                    <?php }?></span> </div>

                    <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">RTO/City</span> <span class="inp-txt"><?php if(isset($exp_policy_data['rto_city'])){ $city = explode("-", $exp_policy_data['rto_city']);
                    echo $city['0']; }?></span> </div>

                    <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Policy Type</span> <span class="inp-txt"><?php if(!empty($exp_policy_data['ins_company'])){ echo "Third Party Policy";}?></span> </div>
                    
                    <!-- <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Previous No Claim Bonus (NCB)</span> <span class="inp-txt">0%</span> </div>
                    <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Claimed previous year</span> <span class="inp-txt">No</span> </div> -->
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xs-6 mrg-B10">
                <h3 class="SubHeading hd_mobile">Vehicle Details</h3>
              </div>
              <!-- <div class="col-xs-6 text-right hd_mobile"> <a href="#" class="edit">EDIT</a> </div> -->
            </div>
            <div class="row">
              <div class="card offlineCard mob-mrgAll15 mob-MP0 policyD_spce">
                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Registration Number</span> <span class="inp-txt"><?php if(isset($exp_policy_data['vehicle_registration_no'])){echo $exp_policy_data['vehicle_registration_no'];}?></span> </div>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Engine Number</span> <span class="inp-txt"><?php if(isset($exp_policy_data['engine_no'])){echo strtoupper($exp_policy_data['engine_no']);}?></span> </div>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Chassis Number</span> <span class="inp-txt"><?php if(isset($exp_policy_data['chassis_no'])){echo strtoupper($exp_policy_data['chassis_no']);}?></span> </div>

                <div style="display: block">
                  <?php if(isset($exp_policy_data['financial_company_name']) && !empty($exp_policy_data['financial_company_name'])){?>
                  <div class="col-md-4 col-xs-6 form-group"> <span class="lab-txt">Finance Company</span> <span class="inp-txt"><?php echo ucwords( $exp_policy_data['financial_company_name']);?></span> </div>
                  <?php }?>
                  <!-- <div class="col-md-4 col-xs-6 form-group ff-group"> <span class="lab-txt">Previous Policy No.</span> <span class="inp-txt">123456789097754321</span> </div>
                  <div class="col-md-4 col-xs-6 form-group ff-group" style="display:block"> <span class="lab-txt">Previous TP Expiry Date*</span> <span class="inp-txt">25 Mar, 22</span> </div>
                  <div class="col-md-4 col-xs-6 form-group ff-group"> <span class="lab-txt">Previous OD Expiry Date*</span> <span class="inp-txt">25 Mar, 20</span> </div> -->
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xs-6 mrg-B10">
                <h3 class="SubHeading hd_mobile">Owner Details</h3>
              </div>
              <!-- <div class="col-xs-6 text-right hd_mobile"> <a href="#" class="edit">EDIT</a> </div> -->
            </div>
            <div class="row">
              <div class="card offlineCard mob-mrgAll15 mob-MP0 policyD_spce ">
                <?php if(isset($exp_policy_data['company_name']) && !empty($exp_policy_data['company_name'])){?>
                  <div class="col-md-4 col-xs-6 form-group"> <span class="lab-txt">Company Name</span> <span class="inp-txt"><?php echo ucwords($exp_policy_data['company_name']);?></span> </div>
                <?php }?>

                <?php if(isset($exp_policy_data['company_gstin']) && !empty($exp_policy_data['company_gstin'])){?>
                  <div class="col-md-4 col-xs-6 form-group"> <span class="lab-txt">GSTIN</span> <span class="inp-txt"><?php echo strtoupper($exp_policy_data['company_gstin']);?></span> </div>
                <?php }?>

                <?php if((isset($exp_policy_data['first_name']) && !empty($exp_policy_data['first_name'])) || (isset($exp_policy_data['last_name']) && !empty($exp_policy_data['last_name']))){?>
                  <div class="col-md-4 col-xs-6 form-group"> <span class="lab-txt">Name</span> <span class="inp-txt"><?php echo ucwords($exp_policy_data['first_name']." ".$exp_policy_data['last_name']);?></span> </div>
                <?php }?>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Phone</span> <span class="inp-txt"><?php if(isset($exp_policy_data['phone_no'])){echo "+91".$exp_policy_data['phone_no'];}?></span> </div>
                <!-- <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">PAN</span> <span class="inp-txt">BGUPM5345S</span> </div>
                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Aadhaar Number</span> <span class="inp-txt">123456790098</span> </div> -->

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Email</span> <span class="inp-txt"><?php if(isset($exp_policy_data['email'])){echo $exp_policy_data['email'];}?></span> </div>

                <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">Address</span> <span class="inp-txt"><?php if(isset($exp_policy_data['primary_address_line1']) || isset($exp_policy_data['primary_address_line2']) && isset($exp_policy_data['primary_city']) && isset($exp_policy_data['primary_state']) && isset($exp_policy_data['primary_pin_code'])){echo ucwords($exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_address_line2']).", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state']." - ".$exp_policy_data['primary_pin_code'];}?></span> </div>

                <?php if(!empty($exp_policy_data['corrs_address_line1']) || !empty($exp_policy_data['corrs_address_line2']) && !empty($exp_policy_data['corr_city']) && !empty($exp_policy_data['corr_state']) && !empty($exp_policy_data['corr_pin_code'])){?>
                <div class="col-md-4 col-xs-12 form-group "> <span class="lab-txt">Correspondence Address</span> <span class="inp-txt"><?php echo ucwords($exp_policy_data['corrs_address_line1'].", ".$exp_policy_data['corrs_address_line2']).", ".$exp_policy_data['corr_city'].", ".$exp_policy_data['corr_state']." - ".$exp_policy_data['corr_pin_code'];?></span> </div>
                <?php }?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xs-6 mrg-B10">
                <h3 class="SubHeading hd_mobile">Personal Details</h3>
              </div>
              <!-- <div class="col-xs-6 text-right hd_mobile"> <a href="#" class="edit">EDIT</a> </div> -->
            </div>
            <div class="row">
              <div class="card offlineCard mob-mrgAll15 mob-MP0 policyD_spce ">
                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Gender</span> <span class="inp-txt"><?php if(isset($exp_policy_data['gender'])){echo ucwords($exp_policy_data['gender']);}?></span> </div>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Marital Status</span> <span class="inp-txt"><?php if(isset($exp_policy_data['marital_status'])){echo ucwords($exp_policy_data['marital_status']);}?></span> </div>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Date of Birth</span> <span class="inp-txt"><?php if(isset($exp_policy_data['dob'])){echo date("j M, Y", strtotime($exp_policy_data['dob'])); }?></span> </div>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Occupation</span> <span class="inp-txt"><?php if(isset($exp_policy_data['occupation'])){echo ucwords($exp_policy_data['occupation']);}?></span> </div>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Nominee Name</span> <span class="inp-txt"><?php if(isset($exp_policy_data['nominee_name'])){echo ucwords($exp_policy_data['nominee_name']);}?></span> </div>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Relation with insured</span> <span class="inp-txt"><?php if(isset($exp_policy_data['nominee_relation'])){echo ucwords($exp_policy_data['nominee_relation']);}?></span> </div>

                <div class="col-md-4 col-xs-6 form-group "> <span class="lab-txt">Nominee Age</span> <span class="inp-txt"><?php if(isset($exp_policy_data['nominee_age'])){echo $exp_policy_data['nominee_age']." Yr";}?></span> </div>
              </div>
            </div>
            <div class="clearfix">
              <div class="custom-check1 mrg-mb-t1">
                <!-- <input type="checkbox" name="declaration" id="review-declare1" value="1" class="trigger" required=""> -->
                <input type="checkbox" name="declaration" id="is_declare" value="1" class="trigger" required="true">
                <label for="is_declare"><span></span> </label>
                <span class="agree-declare1">I declare that the information provided above is true and accept that if it is found to be false, it may impact claims. I authorize Advance India Insurance to represent me at insurance companies for my insurance needs.</span> </div>
                <span class="req"></span>
            </div>
            <div class="row">
              <div class="col-md-4 mrg-b-t" style="margin-top:25px;">
                <input type="hidden" name="pay_by" value="razorpay">
                <!-- <button type="submit" id="madePayment" class="filterBtn btn-addUser-or buy_now"> MAKE PAYMENT (<?php if(isset($exp_policy_data['total_amount'])){echo "₹ ".$exp_policy_data['total_amount'];}?>)</button> -->
                <a href="javascript:void(0)" id="madePayment" data-amount="<?php if(isset($exp_policy_data['total_amount'])){echo $exp_policy_data['total_amount'];}?>" class="filterBtn btn-addUser-or buy_now"> MAKE PAYMENT (<?php if(isset($exp_policy_data['total_amount'])){echo "₹ ".$exp_policy_data['total_amount'];}?>)</a>
              </div>
            </div>
            <div class="clearfix"></div>
          <!-- </form> -->
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>

<!--sms payment link modal-->
<div class="modal fade in" id="smsPaymentLinkModal" tabindex="-1" role="dialog"  style="display: none;">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title text-center" id="gridSystemModalLabel">SMS Payment Link</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label class="control-label"><b>Mobile:</b></label>
            <input type="text" class="form-control" value="7696124776" required="">
          </div>
          <div class="form-group" id="smsPayLink_text_field" style="">
            <label class="control-label"><b>SMS:</b></label>
            <textarea class="form-control"  rows="4" placeholder="Please enter sms text" readonly="" required=""></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn login_btn" >SEND SMS</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- Raise new ticket popup -->
<div class="modal fade in" id="raiseTicketpopup" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding: 0px 10px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Raise New Ticket</h4>
      </div>
      <div class="modal-body">
        <div class=" clearfix">
          <form>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group  mobfiled">
                  <label for="" class="liteLabel">Support Category</label>
                  <select id="categoryId" class="form-control" name="category_id">
                    <option value="">Select Category</option>
                    <option value="1">Policy Document Issue</option>
                    <option value="2">Payment Link Issue</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group  mobfiled">
                  <label for="" class="liteLabel">Support Type</label>
                  <select id="supportTypeId" class="form-control" name="support_type_id">
                    <option value="">Select Support Type</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-default filterBtn contbtn support_contbtn">Continue</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!--JS files--> 
<!-- <script src="js/common_compress_script.min.js"></script>
<script src="<?php //echo base_url('assets/js/custom.js'); ?>"></script>  -->