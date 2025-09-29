  <?php $this->load->view('layouts/sidebar');?>  
  <!--Start side breadcrumb-->
  <!-- <div class="breadcum-Strip">
    <div class="col-sm-2 sidenav leftSideNav" id="sideBreadCrubmFields">
      <ul id="sideBreadcrumbList">
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('quotes');?>"><span class="img-type"></span> Quotes</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('owner-details');?>"><span class="img-type"></span> Owner Details</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('personal-details');?>" ><span class="img-type"></span>Personal Details</a></li>
        <li class="side_nav sidenav_icon-completed"><a href="<?php echo base_url('vehicle-details');?>" ><span class="img-type"></span> Vehicle Details</a></li>
        <li class="side_nav sidenav_icon-active"><a href="<?php echo base_url('documents');?>" class="currentPage"><span class="img-type"></span> Documents</a></li>
        <li class="side_nav sidenav_icon-inactive"><a href="<?php echo base_url('payment');?>" ><span class="img-type"></span> Payment</a></li>
      </ul>
    </div>
  </div> -->
  <div class="col-sm-10 col-sm-push-2">
    <div id="band" class="container-fluid container_space no_space">
      <div id="wizard" role="application" class="wizard clearfix">
        <div class="content clearfix">
          <section class="tabSec">
            <div class="row">
              <div class="col-md-12">
                <h2 id="policyDocsTitle" class="mrg-L20 ownerHeadMob">Documents</h2>
              </div>
            </div>
          </section>
          <section class="contentSection mainFilter sec_bankList list-doc mobDocPad">
            <div class="card offlineCard">
              <form >
                <div class="row">
                  <div class="col-md-12">
                  <ul class="add-file">
            <li class="flt">
               <input id="user_pan_file" class="img-upl userFile" style="float:right;" type="file" name="user_pan_file">
               <button class="btn"></button>
               <div class="userFileThumbnail" style="display:none;"><img src="" class="upl-img "></div>
               <div class="cancel"></div>
               <span class="img-txt">RC (Page 1)<span class="required">*</span></span>
            </li>
            <li class="flt">
               <input class="img-upl userFile" style="float:right;" type="file" name="user_aadhar_file">
               <button class="btn"></button>
               <div class="userFileThumbnail" style="display:none;"><img src="" class="upl-img "></div>
               <div class="cancel"></div>
               <span class="img-txt">RC (Page 2)<span class="required">*</span></span> 
            </li>
            <li class="flt">
               <input class="img-upl userFile" style="float:right;" type="file" name="user_certificate_file">
               <button class="btn"></button>
               <div class="userFileThumbnail" style="display:none;"><img src="" class="upl-img "></div>
               <div class="cancel"></div>
               <span class="img-txt">RC (Page 3)</span>
            </li>
            <li class="flt">
               <input class="img-upl userFile" style="float:right;" type="file" name="user_photo_file">
               <button class="btn"></button>
               <div class="userFileThumbnail" style="display:none;"><img src="" class="upl-img "></div>
               <div class="cancel"></div>
               <span class="img-txt">Previous Year Policy Page 1</span>                       
            </li>
            <li class="flt">
               <input class="img-upl userFile" style="float:right;" type="file" name="user_cheque_file">
               <button class="btn"></button>
               <div class="userFileThumbnail" style="display:none;"><img src="" class="upl-img "></div>
               <div class="cancel"></div>
               <span class="img-txt">Previous Year Policy Page 2</span>                       
            </li>
            <li class="flt">
               <input class="img-upl userFile" style="float:right;" type="file" name="user_cheque_file">
               <button class="btn"></button>
               <div class="userFileThumbnail" style="display:none;"><img src="" class="upl-img "></div>
               <div class="cancel"></div>
               <span class="img-txt">Previous Year Policy Page 3</span>                       
            </li>
         </ul>
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <input type="button" class="filterBtn mrg-T25 getQuotes" id="continue_documents_btn" value="Continue">
                  </div>
                </div>
                <div class="clearfix"></div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
