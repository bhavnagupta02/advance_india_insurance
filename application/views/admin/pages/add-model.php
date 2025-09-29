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
                                    <h4>Add Car/Two Wheeler Model</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('admin/dashboard');?>"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item">Add Model
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
                                                            <form class="wizard-form1" id="example-advanced-form" action="" name="edit_profile" method="POST" enctype="multipart/form-data">
                                                                <fieldset>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="modelType" class="block">Model Type *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            
                                                                        <select name="model_type" class="form-control form-control-inverse" id="modelType" required>
                                                                            <option selected="selected" disabled="disabled">Select Model Type</option>
                                                                            <option value="car">Car</option>
                                                                            <option value="two_wheeler">Two Wheeler</option>
                                                                        </select>
                                                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="modelName" class="block">Model Name *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="modelName" name="model_name" type="text" class="form-control" value="" required>
                                                                        </div>
                                                                    </div>

                                                                    <!-- <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="phoneNumber" class="block">Mobile No. *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="phoneNumber" name="mobile_number" type="text" class="required form-control" value="" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="skype" class="block">Date of Birth</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="skype" name="dob" type="text" class=" form-control" value="" >
                                                                        </div>
                                                                    </div> -->
                                                                </fieldset>
                                                                <button class="update_profile_btn btn btn-primary m-r-10 m-b-5">Add Model</button>
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