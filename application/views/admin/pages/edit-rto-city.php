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
                                    <h4>Edit <?php if(isset($rto_city_data['rto_city_name'])){ echo $rto_city_data['rto_city_name'];}?> variant</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('admin/dashboard');?>"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('admin/view-rto-cities');?>"> View RTO/City </a>
                                    </li>
                                    <li class="breadcrumb-item">Edit RTO/City</li>
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
                                        <div class="card-block">
                                            <div class="view-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div id="wizard">
                                                            <section>
                                                            <form class="wizard-form1" id="example-advanced-form" action="" method="POST" enctype="multipart/form-data">
                                                                <fieldset>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="RTOcityName" class="block">RTO/City Name *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="RTOcityName" name="rto_city_name" type="text" class="form-control" value="<?php if(isset($rto_city_data['rto_city_name'])){ echo $rto_city_data['rto_city_name'];}?>" required>
                                                                        </div>
                                                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="RTOcityNumber" class="block">RTO/City Number *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="RTOcityNumber" name="rto_city_number" type="text" class="form-control" value="<?php if(isset($rto_city_data['rto_city_number'])){ echo $rto_city_data['rto_city_number'];}?>" required>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <button class="update_profile_btn btn btn-primary m-r-10 m-b-5">Update RTO/City Data</button>
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