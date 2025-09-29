 <?php $this->load->view('layouts/sidebar');?>
  <!--Start side breadcrumb-->
  <!-- <div class="breadcum-Strip">
    <div class="col-sm-2 sidenav leftSideNav" id="sideBreadCrubmFields">
      <ul id="sideBreadcrumbList">
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('quotes');?>"><span class="img-type"></span> Quotes</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('owner-details');?>"><span class="img-type"></span> Owner Details</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('personal-details');?>" ><span class="img-type"></span>Personal Details</a></li>
        <li class="side_nav sidenav_icon-active"><a href="<?php echo base_url('vehicle-details');?>" class="currentPage"><span class="img-type"></span> Vehicle Details</a></li>
        <li class="side_nav sidenav_icon-inactive"><a href="<?php echo base_url('documents');?>"><span class="img-type"></span> Documents</a></li>
        <li class="side_nav sidenav_icon-inactive"><a href="<?php echo base_url('Payment');?>"><span class="img-type"></span> Payment</a></li>
      </ul>
    </div>
  </div> -->
  <div class="col-sm-10 col-sm-push-2  quote-section">
    <?php echo $this->session->flashdata('msg'); ?>
    <div id="band" class="container-fluid">
      <div id="wizard" role="application" class="wizard clearfix">
        <div class="content clearfix">
          <section class="tabSec tabSecnew body current">
            <div class="row">
              <div class="col-md-12">
                <h2 class="mrg-L20 ownerHeadMob">Vehicle Details</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <section class="contentSection mainFilter sec_bankList">
                  <div class="card offlineCard">
                    <form name="form1" method="post">
                      <div class="row mrg-T20">
                        <div class="col-md-6 form-group">
                          <label for="" class="liteLabel">Registration Number <span class="text-danger">*</span></label>
                          <div>
                            <input style="width: 20%;display: inline-block;text-align: center;" type="text" class="form-control filterInput allowDisable" name="vehicle_rto_code" required="" value="<?php if(isset($exp_policy_data['rto_city'])){ $city = explode("-", $exp_policy_data['rto_city']);
                              echo $city['1']; }?>" readonly>
                            <input style="width: 75%;display: inline-block;float:right;" type="text" class="form-control filterInput allowDisable" placeholder="Registration Number"  name="vehicle_regis_no" required="" value="" minlength="5" maxlength="7">
                          </div>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="" class="liteLabel">Engine Number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control filterInput allowDisable" placeholder="Engine Number" name="engine_no" required="" value="" maxlength="20">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 form-group">
                          <label for="" class="liteLabel">Chassis Number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control filterInput allowDisable" placeholder="Chassis Number" name="chassis_no" required="" value="" maxlength="20">
                        </div>
                        <!-- <div class="col-md-6 mobSumo" style="display:block">
                          <div class="form-group">
                            <input type="hidden" id="selectedPreviousInsurer" name="selectedPreviousInsurer" value="26">
                            <label for="" class="liteLabel">Previous Insurer <span class="text-danger">*</span></label>
                              <select name="previous_insurer" class="search-box " >
                                <option value=""> --select previous insurer-- </option>
                                <option value="ACKO" selected="selected">ACKO</option>
                              </select>
                              
                              
                          </div>
                        </div> -->
                      </div>
                      <div class="row ">
                        <!-- <div class="col-md-6 form-group" style="display:block">
                          <label for="" class="liteLabel">Previous Policy Number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control filterInput" placeholder="Previous Policy Number" name="previous_policy_no" value="">
                        </div> -->
                        
                        
                        <!--AAI member details-->
                        
                        <div class="col-md-12 form-group">
                          <input type="checkbox" id="is_car_on_loan" class="trigger" name="is_car_on_loan" value="1">
                          <label for="is_car_on_loan"><span class="dt-yes"></span> Is your car presently on loan?</label>
                          </div>
                      </div>
                      <div class="row" id="financial_detail" style="display: none;">
                        <div class="col-md-6 mobSumo">
                          <div class="form-group">
                            <label class="liteLabel">Finance Company <span class="text-danger">*</span></label>
                            <input type="text" class="form-control filterInput1 gs_ta1" name="financial_company_name" placeholder="Financing Company">
                          </div>
                        </div>
                        
                      </div>
                      <div class="row ">
                        <div class="col-md-6">
                          <input type="submit" id="moredetail" class="filterBtn mrg-T10 getQuotes" value="Continue">
                        </div>
                        </div>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </section>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
