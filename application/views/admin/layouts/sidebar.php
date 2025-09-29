<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel"></div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="">
                    <a href="<?php echo base_url('admin/dashboard'); ?>">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">KYC Users</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="<?php echo base_url('admin/view-users'); ?>">
                                <span class="pcoded-mtext">View KYC Users</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                        <span class="pcoded-mtext">Car/Two Wheeler Models</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="<?php echo base_url('admin/add-model'); ?>">
                                <span class="pcoded-mtext">Add Models</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo base_url('admin/view-twowheeler-models'); ?>">
                                <span class="pcoded-mtext">View Two Wheeler Models</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo base_url('admin/view-car-models'); ?>">
                                <span class="pcoded-mtext">View Car Models</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-command"></i></span>
                        <span class="pcoded-mtext">Car/Two Wheeler Variants</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="<?php echo base_url('admin/add-variant'); ?>">
                                <span class="pcoded-mtext">Add Variants</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo base_url('admin/view-twowheeler-variants'); ?>">
                                <span class="pcoded-mtext">View Two Wheeler Variants</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo base_url('admin/view-car-variants'); ?>">
                                <span class="pcoded-mtext">View Car Variants</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-globe"></i></span>
                        <span class="pcoded-mtext">Car/Two Wheeler RTO/City</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="<?php echo base_url('admin/add-rto-city');?>">
                                <span class="pcoded-mtext">Add Vehicle RTO/City</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo base_url('admin/view-rto-cities');?>">
                                <span class="pcoded-mtext">View Vehicle RTO/City</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-list"></i></span>
                        <span class="pcoded-mtext">Car/Two Wheeler Insurance</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="<?php echo base_url('admin/view-car-insurance'); ?>">
                                <span class="pcoded-mtext">View Car Insurance Policies</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo base_url('admin/view-twowheeler-insurance'); ?>">
                                <span class="pcoded-mtext">View Bike Insurance Policies</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo base_url('admin/export-insurance-policies'); ?>">
                                <span class="pcoded-mtext">Export Insurance Policies</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>                               
</nav>