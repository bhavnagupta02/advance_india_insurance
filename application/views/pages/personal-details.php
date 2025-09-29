 <?php $this->load->view('layouts/sidebar');?>
  <!--Start side breadcrumb-->
  <!-- <div class="breadcum-Strip">
    <div class="col-sm-2 sidenav leftSideNav" id="sideBreadCrubmFields">
      <ul id="sideBreadcrumbList">
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('quotes');?>"><span class="img-type"></span> Quotes</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('owner-details');?>"><span class="img-type"></span> Owner Details</a></li>
        <li class="side_nav sidenav_icon-active"><a href="<?php echo base_url('personal-details');?>" class="currentPage"><span class="img-type"></span>Personal Details</a></li>
        <li class="side_nav sidenav_icon-inactive"><a href="<?php echo base_url('vehicle-details');?>"><span class="img-type"></span> Vehicle Details</a></li>
        <li class="side_nav sidenav_icon-inactive"><a href="<?php echo base_url('documents');?>"><span class="img-type"></span> Documents</a></li>
        <li class="side_nav sidenav_icon-inactive"><a href="<?php echo base_url('payment');?>"><span class="img-type"></span> Payment</a></li>
      </ul>
    </div>
  </div> -->
  <div class="col-sm-10 col-sm-push-2 quote-section">
    <?php echo $this->session->flashdata('msg'); ?>

    <div id="band" class="container-fluid">
      <div id="wizard" role="application" class="wizard clearfix">
        <div class="content clearfix">
          <section class="tabSec tabSecnew body current" >
          <div class="row">
            <div class="col-md-12">
              <h2 class="mrg-L20 ownerHeadMob">Personal Details</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <section class="contentSection mainFilter sec_bankList">
              <div class="card offlineCard">
              <form method="post">
                <div class="row mrg-T20">
                  <div class="col-md-6 form-group">
                    <label for="" class="liteLabel">Gender <span class="text-danger">*</span></label>
                    <select name="gender" id="gender" class="search-box" required="" >
                      <option value="" selected="selected" disabled="disabled">Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="" class="liteLabel">Marital Status <span class="text-danger">*</span></label>
                    <select name="marital_status" id="marital_status" class="search-box" required="" >
                      <option value="" selected="selected" disabled="disabled">Marital Status</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group ">
                    <label for="" class="liteLabel">Date of Birth <span class="text-danger">*</span></label>
                    <div class="input-group date" id="dobField">
                      <input type="text" class="form-control filterInput datepicker" placeholder="DOB" id="dob" autocomplete="off" name="dob" required="" value="" >
                      <span class="input-group-addon"> <span class=""><img src="<?php echo base_url('assets/images/fltr-calendar.svg');?>"></span> </span> </div>
                  </div>
                  <div class="col-md-6 mobSumo">
                    <div class="form-group">
                      <label for="" class="liteLabel">Occupation <span class="text-danger">*</span></label>
                        <select name="occupation"  class="search-box" required="" >
                          <option value="" selected="selected" disabled="disabled">Occupation</option>
                          <option value="Agri/Farmer/Landholding">Agri/Farmer/Landholding</option>
                          <option value="Chartered Accountant">Chartered Accountant</option>
                          <option value="Defense and Para Military Service">Defense and Para Military Service</option>
                          <option value="Doctor">Doctor</option>
                          <option value="Government Employee">Government Employee</option>
                          <option value="Homemaker">Homemaker</option>
                          <option value="Housewife">Housewife</option>
                          <option value="Labourer">Labourer</option>
                          <option value="Lawyer">Lawyer</option>
                          <option value="Retired">Retired</option>
                          <option value="Salaried">Salaried</option>
                          <option value="Self Employed">Self Employed</option>
                          <option value="Sports Professional">Sports Professional</option>
                          <option value="Student">Student</option>
                          <option value="Teacher">Teacher</option>
                          <option value="Unemployed/Not Working">Unemployed/Not Working</option>
                          <option value="Others">Others</option>
                        </select>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mrg-B20">
                    <h5 class="ownerHeadMob"><strong>Nominee Details</strong></h5>
                  </div>
                </div>
                <div class="row  mrg-T20">
                  <div class="col-md-6 form-group">
                    <label for="" class="liteLabel">Name <span class="text-danger">*</span></label>
                    <input class="form-control filterInput" type="text" placeholder="Nominee Name" name="nominee_name" id="nominee_name" value="" maxlength="50" required="" aria-required="true">
                  </div>
                  <div class="col-md-6 mobSumo">
                    <div class="form-group">
                      <label for="" class="liteLabel">Relation with Policy Holder <span class="text-danger">*</span></label>
                        <select name="nominee_relation" class="search-box" required="" >
                          <option value="" selected="selected" disabled="disabled">Relationship with nominee </option>
                          <option value="Brother">Brother</option>
                          <option value="Daughter">Daughter</option>
                          <option value="Father">Father</option>
                          <option value="Husband">Husband</option>
                          <option value="Mother">Mother</option>
                          <option value="Sister">Sister</option>
                          <option value="Son">Son</option>
                          <option value="Wife">Wife</option>
                        </select>
                        
                        
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="" class="liteLabel">Age <span class="text-danger">*</span></label>
                    <input class="form-control filterInput readonly onlyNumbers" type="text" placeholder=" Nominee's Age" name="nominee_age" required="" value="" aria-required="true" minlength="1" maxlength="3">
                  </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                  <input type="submit" id="personaldetail" class="filterBtn getQuotes mrg-T10" value="Continue">
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
