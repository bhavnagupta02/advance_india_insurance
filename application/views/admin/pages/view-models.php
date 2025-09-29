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
                                    <h4>View All Car/Two Wheeler Models</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('admin/dashboard');?>"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item">View Models
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
                                                        <th>Model Name</th>
                                                        <th>Model Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                       <!--  <?php $i=1;
                                                        foreach($users_data as $val){?>
                                                        <tr>
                                                            <td class="sr_no"><?php echo $i; ?></td>
                                                            <td><div class="contact_dtls"><span><?php if(isset($val['name'])){echo "<strong>Name:</strong>"." ".$val['name'];}?></span>
                                                                <span><?php if(isset($val['email'])){echo "<strong>Email:</strong>"." ".$val['email'];} ?></span>
                                                                <span><?php if(isset($val['mobile_number'])){echo "<strong>Mobile:</strong>"." ".$val['mobile_number'];} ?></span>
                                                            </div></td>
                                                            <td><?php if(isset($val['dob'])){echo date("j M, Y", strtotime($val['dob']));} ?></td>
                                                            <td><div class="id_proofs"><span><?php if(isset($val['pan_number'])){echo "<strong>Pan:</strong>"." ".$val['pan_number'];} ?></span>
                                                                <span><?php if(isset($val['aadhar_number'])){echo "<strong>Aadhar:</strong>"." ".$val['aadhar_number'];} ?></span>
                                                            </div></td>
                                                            <td><?php if(isset($val['city'])){echo $val['city'];} ?></td>
                                                            <td><?php if($val['verification_status']==0){echo "<span class='pending'>Pending</span>";}
                                                            else{echo "<span class='verified'>Verified</span>";}?>
                                                            </td>
                                                            <td><a href="<?php echo base_url(); ?>admin/edit-user/<?php echo $val['id'];?>" title="<?php if($val['verification_status'] == 0){ echo 'View & Verify User KYC';}else{ echo 'View User Data';} ?>" class="pending_usr"><p class="fa fa-edit"></p></a>
                                                             | <a href="javascript:void(0);" class="remove" data-url="delete_kyc_user" title="Delete This User"><p class="fa fa-trash"></p></a></td>
                                                        </tr>
                                                        <?php $i++;}?> -->

                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                        </tr>
                                                    </tbody>
                                                    <!-- <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                    </tfoot> -->
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