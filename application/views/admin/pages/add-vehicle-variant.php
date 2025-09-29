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
                                    <h4>Add Car/Two Wheeler Variants</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('admin/dashboard');?>"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item">Add Variant
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
                                                                            <label for="variantType" class="block">Variant Type *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                        <select name="variant_type" class="form-control form-control-inverse" id="variantType" required data-url="<?php echo base_url('admin/admin/fetch_models_for_variants');?>">
                                                                            <option selected="selected" disabled="disabled">Select Variant Type</option>
                                                                            <option value="car">Car</option>
                                                                            <option value="two_wheeler">Two Wheeler</option>
                                                                        </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="MmodelType" class="block">Make / Models *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                        <select name="make_model" class="form-control form-control-inverse" id="MmodelType" required>
                                                                            <option selected="selected" disabled="disabled">Select Make/Models</option>
                                                                            
                                                                        </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="variantName" class="block">Variant Name *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="variantName" name="variant_name" type="text" class="form-control" value="" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="cubeCapacity" class="block">Cube Capacity *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="cubeCapacity" name="cube_capacity" type="text" class="form-control" value="" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="insAmount" class="block">Insurance Amount *</label>
                                                                            <span style="font-size: 12px;font-weight: 600;">(Enter amount Inc. GST)</span>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="insAmount" name="amount" type="text" class="form-control" value="" required>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                                <button class="update_profile_btn btn btn-primary m-r-10 m-b-5">Add Variant</button>
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