  <div class="sec_tab sectionHeader2 carInfo new-section">
    <div class="container">
      <div class="subHeading"> <a href="<?php echo base_url('user-dashboard');?>" class="active"><img src="<?php echo base_url('assets/images/ic_car.svg');?>" class="imgIc">Private  Car</a> <a href="<?php echo base_url('bike-info');?>"><img src="<?php echo base_url('assets/images/ic_bike.svg');?>" class="imgIc">Two Wheeler Insurance</a>
      <!-- <a href="#" class=""><img src="<?php //echo base_url('assets/images/ic_pcv.svg')?>" class="imgIc">PCV</a><a href="#"><img src="<?php //echo base_url('assets/images/gcv.svg');?>" class="imgIc">GCV</a> --> </div>
    </div>
  </div>
  <!-- Tab Section -->
  <div class="container_space_2 section-insurance">
  <div id="" class="container ">
    <div class="row">
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="col-md-12">
        <h3 class="mainHeading mainHeading_2" style="display:inline-block;margin-bottom:21px;">Multiple Car Insurance</h3>
      </div>
    </div>
    <section class="contentSection mainFilter bikeBox" id="bikeBox">
      <div class="tabSec">
        <div class="row">
          <div class="col-md-12 tabbable-line">
            <!--<ul class="nav nav-tabs" role="tablist" id="myTab">
              <li class="active"><a href="#expPolicy" class="carInfoTab" role="tab" data-toggle="tab">Third Party Policy</a></li>
            </ul>-->
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="expPolicy">
                <form role="form" method="post">
                  <div class="row">
                    <input type="hidden" name="ins_type" value="car">
                    <!--<div class="col-md-12 mrg-B0  mrg-T10">
                       <h3 class="SubHeading"><span id="staticMessage"><span id="reg_condition">Or</span> Provide details below to proceed</span></h3>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="col-md-6 mobSumo">
                      <div class="form-group">
                        <label for="" class="liteLabel">Registration Year</label>
                          <select class="search-box " id="RegYear" name="registration_year" required placeholder="Search Registration Year....">
                            <option value="" selected="selected" disabled="disabled">Select Registration Year</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                          </select>
                          
                      </div>
                    </div>
                    <div class="col-md-6 mobSumo">
                      <div class="form-group">
                        <label for="" class="liteLabel">Make / Model</label>
                          <select class="search-box" name="make_model" id="make_model" tabindex="-1" required data-url="<?php echo base_url('home/fetch_varints_basedon_model');?>" data-vehicle-type="car" placeholder="Search Make / Models....">
                            <option value="" selected="selected" disabled="disabled">Select Make/Model</option>
                            <?php foreach($car_models_data as $val){?>
                            <option value="<?php if(isset($val['model_name'])){echo $val['model_name'];} ?>" data-myparam="<?php if(isset($val['model_name'])){echo $val['model_name'];} ?>"><?php if(isset($val['model_name'])){echo ucwords($val['model_name']);} ?></option>
                            <?php }?>
                          </select>
                          
                      </div>
                    </div>
                    <div class="col-md-6 mobSumo">
                      <div class="form-group">
                        <label for="" class="liteLabel">Fuel Type</label>
                          <select class="search-box" name="fuel_type" required>
                            <option value="" selected="selected" disabled="disabled">Select Fuel Type</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electric">Electric</option>
                            <option value="ExternalCNG">CNG/LPG Externally Fitted</option>
                          </select>
                          
                      </div>
                    </div>
                    <div class="col-md-6 mobSumo">
                      <div class="form-group">
                        <label for="" class="liteLabel">Variant</label>
                          <select class="search-box " name="variant" id="variant" required data-url="<?php echo base_url('home/fetch_cc_basedon_varints');?>" data-vehicle-type="car">
                            <option value="" selected="selected" disabled="disabled">Select Variant</option>
                            <!-- <?php foreach($car_variants_data as $val){?>
                            <option value="<?php if(isset($val['variant_name'])){echo $val['variant_name'];} ?>"><?php if(isset($val['variant_name'])){echo ucwords($val['variant_name']);} ?></option>
                            <?php }?> -->
                          </select>
                          
                      </div>
                    </div>
                    <div class="col-md-6 mobSumo">
                      <div class="form-group">
                        <label for="" class="liteLabel">RTO/City</label>
                          <select class="search-box" name="rto_city" id="rtoCity" placeholder="Search RTO City..." required>
                            <option value="" selected="selected" disabled="disabled">Select RTO City</option>
                            <?php foreach($rto_cities_data as $val){?>
                            <option value="<?php if(isset($val['rto_city_number']) && isset($val['rto_city_name'])){echo $val['rto_city_name']."-".$val['rto_city_number'];} ?>"><?php if(isset($val['rto_city_number']) && isset($val['rto_city_name'])){echo $val['rto_city_name']."-".$val['rto_city_number'];} ?></option>
                            <?php }?>
                            <!-- <option value="RJ47"> Dudu, Jaipur-RJ47</option>
                            <option value="PB15">Abohar-PB15</option>
                            <option value="HR53">Adampur-HR53</option>
                            <option value="TS01">Adilabad-TS01</option>
                            <option value="KL26">Adoor-KL26</option>
                            <option value="MP70">Agar Malwa-MP70</option> -->
                          </select>
                          
                        </div>
                    </div>
                    <div class="col-md-6 mobSumo">
                      <div class="form-group">
                        <label for="" class="liteLabel">Cube Capacity</label>
                          <select class="search-box" id="cubeCapacity" name="fuel_capacity_price" required>
                            <option value="" selected="selected" disabled="disabled">Select Engine CC</option>
                            <!-- <option value="1000cc-2444">1000cc</option>
                            <option value="1001cc to 1500cc-3800">1001cc to 1500cc</option>
                            <option value="Above 1501cc-9310">Above 1501cc</option> -->
                          </select>
                          
                        </div>
                    </div>

                    <div class="col-md-6 mobSumo">
                      <div class="form-group">
                      <label for="" class="liteLabel">Registration Date<span class="required">*</span></label>
                      <div class="input-group date1" data-date-format="dd/mm/yyyy">
                        <input type="text" id="REGdate" class="form-control filterInput" name="reg_date" autocomplete="off" required>
                        <span class="input-group-addon"> <span class=""><img src="<?php echo base_url('assets/images/fltr-calendar.svg');?>"></span> </span> </div>
                      </div>
                    </div>

                    <div class="col-md-6 mobSumo">
                      <div class="form-group">
                      <label for="" class="liteLabel">Mfg. Date<span class="required">*</span></label>
                      <div class="input-group date1" data-date-format="dd/mm/yyyy">
                        <input type="text" id="MFGdate" class="form-control filterInput" name="mfg_date" autocomplete="off" required >
                        <span class="input-group-addon"> <span class=""><img src="<?php echo base_url('assets/images/fltr-calendar.svg');?>"></span> </span> </div>
                        <span class="datevalidation"></span>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                      <button type="submit" class="btn filterBtn getQuotes" id="getQuotes" tabindex="11">GET QUOTES</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</div>
<div class="clearfix"></div>
