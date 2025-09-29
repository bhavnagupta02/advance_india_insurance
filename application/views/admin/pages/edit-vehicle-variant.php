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
                                    <h4>Edit <?php if(isset($variant_data['variant_name'])){ echo $variant_data['variant_name'];}?> variant</h4>
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
                                        <?php if(isset($variant_data['variant_type']) && $variant_data['variant_type']=='car'){?>
                                            <a href="<?php echo base_url('admin/view-car-variants');?>"> View Car Variants </a>
                                        <?php }else{?>
                                            <a href="<?php echo base_url('admin/view-twowheeler-variants');?>"> View Two Wheeler Variants </a>
                                        <?php }?>
                                    </li>
                                    <li class="breadcrumb-item">Edit Variant</li>
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
                                                    <?php //print_r($variant_models_data);?>
                                                    <div class="col-lg-12">
                                                        <div id="wizard">
                                                            <section>
                                                            <form class="wizard-form1" id="example-advanced-form" action="" method="POST" enctype="multipart/form-data">
                                                                <fieldset>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="variantType" class="block">Variant Type *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                          <?php 
                                                                            $variant_list = array('car'=>"Car",  
                                                                                    'two_wheeler'=>"Two Wheeler");?>
                                                                        <select name="variant_type" class="form-control form-control-inverse" id="EvariantType" required data-url="<?php echo base_url('admin/admin/fetch_models_forEdit_variants');?>" data-vid="<?php echo $variant_data['id'];?>">
                                                                            <option selected="selected" disabled="disabled">Select Variant Type</option>
                                                                            <?php foreach($variant_list as $key=>$variantType) { ?>
                                                                               <option <?php if($key == $variant_data['variant_type']){echo 'selected="selected"';}?> value="<?php echo $key; ?>"><?php echo $variantType; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                        
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="EMmodelType" class="block">Make / Models  *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                          
                                                                        <select name="make_model" class="form-control form-control-inverse" id="EMmodelType" required>
                                                                            <option selected="selected" disabled="disabled">Select Make/Models </option>
                                                                            
                                                                            <!-- <option <?php if(!empty($variant_data['make_model'])){echo 'selected="selected"';}?> value="<?php if(!empty($variant_data['make_model'])){ echo $variant_data['make_model'];} ?>"><?php if(!empty($variant_data['make_model'])){ echo $variant_data['make_model'];} ?></option> -->
                                                                            
                                                                        </select>
                                                        
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="variantName" class="block">Variant Name *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="variantName" name="variant_name" type="text" class="form-control" value="<?php if(isset($variant_data['variant_name'])){ echo $variant_data['variant_name'];}?>" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="cubeCapacity" class="block">Cube Capacity *</label>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="cubeCapacity" name="cube_capacity" type="text" class="form-control" value="<?php if(isset($variant_data['cube_capacity'])){ echo $variant_data['cube_capacity'];}?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4 col-lg-2">
                                                                            <label for="insAmount" class="block">Insurance Amount *</label>
                                                                            <span style="font-size: 12px;font-weight: 600;">(Enter amount Inc. GST)</span>
                                                                        </div>
                                                                        <div class="col-md-8 col-lg-10">
                                                                            <input id="insAmount" name="amount" type="text" class="form-control" value="<?php if(isset($variant_data['amount'])){ echo $variant_data['amount'];}?>" required>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                                <button class="update_profile_btn btn btn-primary m-r-10 m-b-5">Update Variant</button>
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