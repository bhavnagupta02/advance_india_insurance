  <?php $this->load->view('layouts/sidebar');
  //echo $this->uri->segment(2)." ".$this->uri->segment(3); ?>
  
  <div class="col-sm-10 col-sm-push-2 quote-section"> 
    <?php echo $this->session->flashdata('msg'); ?>
    <!-- Container (The Band Section) -->
    <div id="band" class="container-fluid quote-area">
      <section class="tabSec">
        <div class="tabbable-panel">
          <div class="tabbable-line">
            <ul class="nav nav-tabs nav-tabs-pos" role="tablist" id="myTab">
              <li ><a href="#Comprehensive" class="carInfoTab" role="tab" data-toggle="tab">Comprehensive</a></li>
              <li  class="active"><a href="#ThirdParty" class="carInfoTab" role="tab" data-toggle="tab">Third Party</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="Comprehensive">
        <section class="contentSection mainFilter sec_bankList sec_comingsoon" id="quotes_multi_tenure" style="">
                  <div class="bankListing" id="qt_multi_tenure_list">
                      <h1>Coming Soon...</h1>
                      
                  </div>
                  </section>
               </div>
              
              <div class="tab-pane active" id="ThirdParty">
                <!--<section class="contentSection mainFilter pos-tab" id="quotes_filter_section">
                   <form role="form">
                    <div class="row">
                      <div class="col-md-12">
                        <ul class="popupFilter">
                          <li class="fltrSearch addicov" style="position:relative">
                            <label for="dateTo" class="liteLabel">Additional Covers</label>
                            <select class="search-box" name="rto_city">
                            <option value="">Additional Covers</option>
                            <option value="additional covers premium showing (887)rs">Additional Covers Premium(887) rs</option>
                            <option value="additional covers premium showing (1407)rs">Additional Covers Premium(1407) rs</option>
                            <option value="additional covers premium showing (2741)rs">Additional Covers Premium(2741) rs</option>
                          </select>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </form> 
                  <div class="clearfix"></div>
                </section>-->
                <section class="contentSection mainFilter sec_bankList" id="quotes_multi_tenure" style="">
                  <div class="bankListing" id="qt_multi_tenure_list">
                    <ul>
                      <li class="silgleList">
                        <form role="form" method="post">
                        <div class="row">
                          <div class="col-md-6">
                            <input type="hidden" name="ins_company" value="Acko">
                            <div class="profileImg"><img src="<?php echo base_url('assets/images/acko.png');?>" alt="HDFC ERGO" style="max-height:48px; max-width:90px;"></div>
                            <div class="clearfix"></div>
                            <!-- <div class="text-small mrg-T10 rightspace pull-left"><img src="<?php echo base_url('assets/images/ic_check_green.svg');?>" alt=""><span class="light">PA Cover</span></div>
                            <div class="clearfix"></div> -->
                          </div>
                          <div class="col-md-6">
                            <!-- <div class="breakuplist">
                              <div class="yearTxt disable-text">For 3 Year</div>
                              <div class="priceBox disable" style=""> NA</div>
                            </div>
                            <div class="breakuplist">
                              <div class="yearTxt disable-text">For 2 Year</div>
                              <div class="priceBox disable" style=""> NA</div>
                            </div> -->
                            <div class="breakuplist">
                              <?php if(isset($exp_policy_data['fuel_capacity_price'])){ 
                                  $fuel = explode("-", $exp_policy_data['fuel_capacity_price']);
                                  /*$x = 887 * 0.84745762711;
                                  $GST_Amount = round(887 - $x, 2);
                                  $Basic_Price = 887 - $GST_Amount;
                                  $Newbasic = round($Basic_Price, 2);
                                  print_r($GST_Amount."--".$Newbasic);die();*/

                                  //GST Calculation for GST Included in Amount
                                  $Original_Amount = $fuel['1'];
                                  $gstPercent = 0.84745762711;
                                  $GST_Amt_partialVal = $Original_Amount * $gstPercent;
                                  $GST_Amount = round($Original_Amount - $GST_Amt_partialVal, 2);
                                  $Basic_Amount = $Original_Amount - $GST_Amount;
                                  //print_r($Basic_Amount."--".$GST_Amount);
                                  ?>

                              <input type="hidden" name="total_amount" value="<?php echo $Original_Amount;?>">
                              <input type="hidden" name="basic_amount" value="<?php echo $Basic_Amount;?>">
                              <input type="hidden" name="gst_amount" value="<?php echo $GST_Amount;?>">

                              <div class="yearTxt">For 1 Year</div>
                              <!-- <div class="priceBox confirmBuyNowBtn"><button type="submit" class="priceBox1 confirmBuyNowBtn1"><?php echo '₹ '.$fuel['1'];?>
                              </div></button> -->
                              <div class="priceBox confirmBuyNowBtn" insurer_id="1" plan_id="4"> <?php echo '₹ '.$Original_Amount;?></div>
                              <div class="premiumTxt qt_premium_breakup" insurer_id="1" plan_id="4" policytenure="1"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Premium Breakup</button></div>
                              
                              <?php }?>
                            </div>
                          </div>
                          
                        </div>
                        <div class="row">
                        <div class="col-md-2">
                          <input type="submit" role="menuitem" class="filterBtn mrg-T25 getQuotes" id="contactdetail" value="Continue">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="modal fade premium_data" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Acko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <ul class="premiumbreakup_data">
                                <li><strong>Third Party <span><?php echo '₹ '.$Basic_Amount;?></span> </strong></li>
                                <li>Basic Third Party <span><?php echo '₹ '.$Basic_Amount;?></span> </li>
                                <li>GST (18%) <span><?php echo '₹ '.$GST_Amount;?></span> </li>
                                <li>Total Premium <span><?php echo '₹ '.$Original_Amount;?></span> </li>
                              </ul>
                              <div class="col-md-12">
                          <input type="submit" role="menuitem" class="filterBtn mrg-T25 getQuotes" id="contactdetail" value="Buy Now">
                        </div>
      </div>
      
    </div>
  </div>
</div>
                      </form>
                      </li>
                      
                    </ul>
                  </div>
                  <div class="clearfix"></div>
                </section>
              </div>
               
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<div class="clearfix"></div>
