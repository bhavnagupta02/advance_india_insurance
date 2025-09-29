<?php if($this->uri->segment(1) != 'payment-summary'){?>
<section class="contentSection bike_mainFilter all_details moreLess newOnlineContent onlineQTContentSection" id="tw_case_info_display">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 col-xs-6 car-width" id="tw_dis_mmv">
          <h3 class="subheading"><?php if(isset($exp_policy_data['ins_type'])){echo ucwords($exp_policy_data['ins_type']);}?></h3>
          <ul>
            <li id="tw_mmv"><?php if(isset($exp_policy_data['make_model'])){echo ucwords($exp_policy_data['make_model']);}?></li>
          </ul>
        </div>
        <div class="col-md-2 col-xs-6 city" id="tw_dis_rto">
          <h3 class="subheading">City</h3>
          <?php if(isset($exp_policy_data['rto_city'])){ $city = explode("-", $exp_policy_data['rto_city']);
          //print_r($city);?>
          <ul>
            <li id="tw_rto"><?php echo $city['1']." ".$city['0']; }?></li>
          </ul>
        </div>
        <!-- <div class="col-md-1 posAbs3 pull-right">
          <button type="button" class="btn btn-default editBtn pull-right" id="editCaseDetail">Edit</button>
        </div> -->
        <!-- <div class="col-md-1 posAbs2 pull-right"> <span style="cursor: pointer;" class="offq_moreTXT">More...</span> </div> -->
        <div class="moreDiv">
          <div class="col-md-2 col-xs-6 Variant" id="tw_dis_mfgdate">
            <h3 class="subheading">Variant</h3>
            <ul>
              <li id="tw_mfg"><?php if(isset($exp_policy_data['variant'])){echo ucwords($exp_policy_data['variant']);}?></li>
            </ul>
          </div>
          <div class="col-md-1 col-xs-6 fule" id="tw_dis_regdate">
            <h3 class="subheading">Fuel Type</h3>
            <ul>
              <li id="tw_regNo"><?php if(isset($exp_policy_data['fuel_type'])){echo ucwords($exp_policy_data['fuel_type']);}?></li>
            </ul>
          </div>
          <div class="col-md-2 col-xs-6 year" id="tw_dis_mfgdate">
            <h3 class="subheading">Mfg Year</h3>
            <ul>
              <li id="tw_mfg"><?php if(isset($exp_policy_data['mfg_date']) && !empty($exp_policy_data['mfg_date'])){echo date("j M, Y", strtotime($exp_policy_data['mfg_date']));}?></li>
            </ul>
          </div>
          <div class="col-md-1 col-xs-6 Registration" id="tw_dis_regdate">
            <h3 class="subheading">Registration Date</h3>
            <ul>
              <li id="tw_regNo"><?php if(isset($exp_policy_data['reg_date']) && !empty($exp_policy_data['reg_date'])){echo date("j M, Y", strtotime($exp_policy_data['reg_date']));}?></li>
            </ul>
          </div>
          <div class="col-md-1 col-xs-6 rdate-width Capacity" id="dis_policyExp_field">
            <h3 class="subheading">Cube Capacity</h3>
            <ul>
              <li id="tw_policyExp"><?php if(isset($exp_policy_data['fuel_capacity_price'])){ 
                $fuel = explode("-", $exp_policy_data['fuel_capacity_price']);
                echo ucwords($fuel['0']);}?>
              </li>
            </ul>
          </div>
          <!-- <div class="col-md-2 col-xs-6 rdate-width" id="dis_ncb_field">
            <h3 class="subheading">Prev. NCB</h3>
            <ul>
              <li id="tw_ncb">20</li>
              %
            </ul>
          </div> -->
          <div class="col-md-2 col-xs-6 rdate-width Claim" id="dis_claimtaken_field" style="display:none;">
            <h3 class="subheading">Claim Taken</h3>
            <ul>
              <li></li>
            </ul>
          </div>
          <div class="col-md-1 posAbs2 pull-right > <span style="cursor: pointer;" class="offq_lessTXT">Less...</span> </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </section>
  <!--./ End top case info--> 
  <?php }?>
  <!--Start side breadcrumb-->
  <div class="breadcum-Strip sidebar-section">
    <div class="col-sm-2 sidenav leftSideNav" id="sideBreadCrubmFields">
      <ul id="sideBreadcrumbList">
        <?php $pageName = $this->uri->segment(1);
          $insType = $this->uri->segment(2);
          $insId = $this->uri->segment(3);
          $current_pageurl = current_url();
          if($this->uri->segment(1) == $pageName && $this->uri->segment(2) == $insType && $this->uri->segment(3) == $insId){ $url = base_url(''.$pageName.'/'.$insType.'/'.$insId.'');}
        ?>
        <li class="side_nav <?php if($url == $current_pageurl && $this->uri->segment(1) == 'quotes'){ echo 'sidenav_icon-active';}else { echo 'sidenav_icon-completed';}?>"><a href="<?php if($url == $current_pageurl && $this->uri->segment(1) == 'quotes'){ echo $url;}else{ echo "#";}?>" class="currentPage1"><span class="img-type"></span> Quotes</a></li>

        <li class="side_nav <?php if($url == $current_pageurl && $this->uri->segment(1) == 'owner-details'){ echo 'sidenav_icon-active';}else if(!empty($exp_policy_data['email'])){ echo 'sidenav_icon-completed';}else{ echo 'sidenav_icon-inactive';}?>"><a href="<?php if($url == $current_pageurl && $this->uri->segment(1) == 'owner-details'){ echo $url;}else{ echo "#";}?>" ><span class="img-type"></span> Owner Details</a></li>

        <li class="side_nav <?php if($url == $current_pageurl && $this->uri->segment(1) == 'personal-details'){ echo 'sidenav_icon-active';}else if(!empty($exp_policy_data['gender'])){ echo 'sidenav_icon-completed';}else{ echo 'sidenav_icon-inactive';}?>"><a href="<?php if($url == $current_pageurl && $this->uri->segment(1) == 'personal-details'){ echo $url;}else{ echo "#";}?>"><span class="img-type"></span>Personal Details</a></li>

        <li class="side_nav <?php if($url == $current_pageurl && $this->uri->segment(1) == 'vehicle-details'){ echo 'sidenav_icon-active';}else if(!empty($exp_policy_data['vehicle_registration_no'])){ echo 'sidenav_icon-completed';}else{ echo 'sidenav_icon-inactive';}?>"><a href="<?php if($url == $current_pageurl && $this->uri->segment(1) == 'vehicle-details'){ echo $url;}else{ echo "#";}?>" ><span class="img-type"></span> Vehicle Details</a></li>

        <?php //if($this->uri->segment(2) != 'car'){?>
        <!-- <li class="side_nav sidenav_icon-inactive"><a href="<?php echo base_url('documents');?>" ><span class="img-type"></span> Documents</a></li> -->
        <?php //}?>
        <li class="side_nav <?php if($url == $current_pageurl && $this->uri->segment(1) == 'payment-summary'){ echo 'sidenav_icon-active';}else if(!empty($exp_policy_data['vehicle_registration_no'])){ echo 'sidenav_icon-completed';}else{ echo 'sidenav_icon-inactive';}?>"><a href="<?php if($url == $current_pageurl && $this->uri->segment(1) == 'payment-summary'){ echo $url;}else{ echo "#";}?>"><span class="img-type"></span> Payment</a></li>
    </ul>
    </div>
  </div>