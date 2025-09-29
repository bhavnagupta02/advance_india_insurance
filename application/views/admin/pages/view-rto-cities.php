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
                                    <h4>View All Vehicle RTO/City</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('admin/dashboard');?>"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item">View RTO/City
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
                                                        <th>RTO/City Name</th>
                                                        <th>RTO/City Number</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1; foreach($rto_cities_data as $val){?>
                                                        <tr id="<?php echo $val['id']; ?>">
                                                            <td class="sr_no"><?php echo $i; ?></td>
                                                            <td><?php if(isset($val['rto_city_name'])){echo ucwords($val['rto_city_name']);} ?></td>
                                                            <td><?php if(isset($val['rto_city_number'])){echo $val['rto_city_number'];} ?></td>
                                                            <td><a href="<?php echo base_url(); ?>admin/edit-vehicle-rto-city/<?php echo $val['id'];?>" title="Edit This RTO/City" class="edit_models edit_data"><p class="fa fa-edit"></p></a>
                                                             | <a href="javascript:void(0);" class="remove deleteModel" id="delete-<?php echo $val['id'];?>" data-value="RTO/City" data-url="delete_vehicle_rto_city" title="Delete This RTO/City"><p class="fa fa-trash"></p></a></td>
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
<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>