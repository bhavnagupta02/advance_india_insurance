<div class="pcoded-content">
  <div class="pcoded-inner-content"> 
    <!-- Main-body start -->
    <div class="main-body">
      <div class="page-wrapper"> 
        <!-- Page-header start -->
        <div class="page-header">
          <div class="row align-items-end"> <?php echo $this->session->flashdata('msg'); ?>
            <div class="col-lg-8">
              <div class="page-header-title">
                <div class="d-inline">
                  <h4>Export Car/Two Wheeler Insurance Policies</h4>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                  <li class="breadcrumb-item"> <a href="<?php echo base_url('admin/dashboard');?>"> <i class="feather icon-home"></i> </a> </li>
                  <li class="breadcrumb-item">Export Insurance Policies </li>
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
                                <form class="wizard-form1" id="example-advanced-form" action="" name="edit_profile" method="POST" enctype="multipart/form-data">
                                  <fieldset>
                                    <div class="form-group row">
                                      <div class="col-md-4 col-lg-2">
                                        <label for="vehicleType" class="block">Vehicle Type *</label>
                                      </div>
                                      <div class="col-md-8 col-lg-10">
                                        <select name="vehicle_type" class="form-control form-control-inverse" id="vehicleType" required>
                                          <option selected="selected" disabled="disabled">Select Vehicle Type</option>
                                          <option value="car">Car</option>
                                          <option value="bike">Two Wheeler</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-md-4 col-lg-2">
                                        <label for="startDate" class="block">Start Date *</label>
                                      </div>
                                      <div class="col-md-8 col-lg-10 date" data-date-format="dd-mm-yyyy">
                                        <input id="startDate" name="start_date" type="text" autocomplete="off" class="form-control" value="" required>
                                        <span class="input-group-addon"> <span class=""><img src="<?php echo base_url('assets/admin/images/fltr-calendar.svg');?>"></span> </span>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-md-4 col-lg-2">
                                        <label for="endDate" class="block">End Date *</label>
                                      </div>
                                      <div class="col-md-8 col-lg-10 date" data-date-format="dd-mm-yyyy">
                                        <input id="endDate" name="end_date" type="text" autocomplete="off" class="form-control" value="" required>
                                        <span class="input-group-addon"> <span class=""><img src="<?php echo base_url('assets/admin/images/fltr-calendar.svg');?>"></span> </span>
                                        <span class="datevalidation"></span> </div>
                                    </div>
                                    
                                  </fieldset>
                                  <button class="update_profile_btn btn btn-primary m-r-10 m-b-5">Export Data</button>
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
<script type="text/javascript">
    
/*$(document).ready(function () {

        $("#startDate").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            onSelect: function (date) {
                var dt2 = $('#dt2');
                var startDate = $(this).datepicker('getDate');
                var minDate = $(this).datepicker('getDate');
                dt2.datepicker('setDate', minDate);
                startDate.setDate(startDate.getDate() + 30);
                //sets dt2 maxDate to the last day of 30 days window
                //dt2.datepicker('option', 'maxDate', startDate);
                //dt2.datepicker('option', 'minDate', minDate);
                $(this).datepicker('option', 'minDate', minDate);
            }
        });
        $('#endDate').datepicker({
            dateFormat: "dd-mm-yy"
        });
    });*/
</script>