<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>View All Car Insurance Policies</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('admin/dashboard');?>"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item">View Insurance Policies
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
                            <?php echo $this->session->flashdata('msg'); ?>
                            <div class="tab-content">
                                <!-- tab panel personal start -->
                                <div class="tab-pane active" id="personal" role="tabpanel">
                                    <!-- personal card start -->
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="dt-responsive table-responsive">
                                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th class="sr_no">Sr. No.</th>
                                                        <th>Policy No.</th>
                                                        <th>Vehicle Details</th>
                                                        <th>Policy Holder</th>
                                                        <th>Nominee Details</th>
                                                        <th>Paid</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1;
                                                        foreach($car_policies_data as $val){?>
                                                        <tr id="<?php echo $val['id']; ?>" class="ins_details">
                                                            <td class="sr_no"><?php echo $i; ?></td>
                                                            <td><?php if(isset($val['policy_no']) && !empty($val['policy_no'])){ echo $val['policy_no'].'/00';} ?></td>
                                                            <td>
                                                              <div class="policy_holderdtls">
                                                                <span><?php if(!empty($val['make_model'])){ echo "<strong>Model:</strong>"." ".ucwords($val['make_model']);}?></span>
                                                                <span><?php if(!empty($val['variant'])){ echo "<strong>Variant:</strong>"." ".ucwords($val['variant']);}?></span>
                                                                <span><?php if(!empty($val['vehicle_registration_no'])){ echo "<strong>Registration No:</strong>"." ".$val['vehicle_registration_no'];}?></span>
                                                              </div>
                                                            </td>
                                                            <td>
                                                              <div class="policy_holderdtls"><span><?php if((isset($val['first_name']) && !empty($val['first_name'])) || (isset($val['last_name']) && !empty($val['last_name']))){ echo "<strong>Name:</strong>"." ".ucwords($val['first_name']." ".$val['last_name']);}?></span>
                                                                <span><?php if(isset($val['company_name']) && !empty($val['company_name'])){echo "<strong>Company Name:</strong>"." ".$val['company_name'];} ?></span>
                                                                <span><?php if(isset($val['company_gstin']) && !empty($val['company_gstin'])){echo "<strong>GSTIN:</strong>"." ".$val['company_gstin'];} ?></span>
                                                                <span><?php if(!empty($val['email'])){echo "<strong>Email:</strong>"." ".$val['email'];} ?></span>
                                                                <span><?php if(!empty($val['phone_no'])){echo "<strong>Mobile:</strong>"." ".$val['phone_no'];} ?></span>
                                                              </div>
                                                            </td>
                                                            <td><div class="policy_holderdtls"><span><?php if(!empty($val['nominee_name'])){ echo "<strong>Name:</strong>"." ".ucwords($val['nominee_name']);}?></span>
                                                                <span><?php if(!empty($val['nominee_relation'])){echo "<strong>Relation:</strong>"." ".$val['nominee_relation'];} ?></span>
                                                                <span><?php if(!empty($val['nominee_age']) && $val['nominee_age']!=0){echo "<strong>Age:</strong>"." ".$val['nominee_age'];} ?></span>
                                                              </div>
                                                            </td>
                                                            <td class="payimg"><?php if($val['payment_status']==1){ echo "<img src='".base_url('assets/admin/images/paid.png')."'>";} else{ echo "<img src='".base_url('assets/admin/images/cancel.png')."'>";}?></td>
                                                            <td class="view_icn"><?php if($val['payment_status']==1){?>
                                                                <a href="<?php if(!empty($val['insurance_pdf_file'])){ echo base_url($val['insurance_pdf_file']);} ?>" target="_blank" title="View Policy Details"><img src="<?php echo base_url('assets/admin/images/view-image.png')?>"><!-- <i class="feather icon-eye"></i> --></a>
                                                            <?php }?></td>
                                                        </tr>
                                                        <?php $i++;}?>
                                                    </tbody>
                                                </table>
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