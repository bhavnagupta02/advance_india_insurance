<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if(isset($title)){ echo $title; } ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url('assets/admin/images/favicon.ico'); ?>" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
   <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/icon/feather/css/feather.css'); ?>">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/css/custom.css'); ?>">
</head>
<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded load-height">
        <section class="login-block with-header">
                <!-- Container-fluid starts -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo $this->session->flashdata('msg'); ?>
                            <!-- Authentication card start -->
                            <form class="md-float-material form-material m-t-40 m-b-40" action="" method="POST">
                                <div class="auth-box card">
                                    <div class="card-block">
                                        <div class="row m-b-20">
                                            <div class="col-md-12">
                                                <h3 class="text-center">Control Panel Login</h3>
                                            </div>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="email" name="email" class="form-control" required="" placeholder="Enter Your Email">
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="password" name="password" class="form-control" required="" placeholder="Enter Your Password">
                                            <span class="form-bar"></span>
                                        </div>
                                        
                                        <!-- <div class="row m-t-25 text-left">
                                            <div class="col-12">
                                                <div class="checkbox-fade fade-in-primary d-">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        <span class="text-inverse">Remember me</span>
                                                    </label>
                                                </div>
                                                <div class="forgot-phone text-right f-right">
                                                    <a href="<?php echo base_url(); ?>forgotpassword" class="text-right f-w-600"> Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row m-t-30">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="text-inverse text-left m-b-0">Advance India Insurance </p>
                                                <p class="text-inverse text-left m-b-0">Broker Services Ltd,</p>
                                                <p class="text-inverse text-left m-b-0">State, India</p>
                                            </div>
                                            <div class="col-md-6">
                                                <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" alt="small-logo" class="login-page-logo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Authentication card end -->
                        </div>
                        <!-- end of col-sm-12 -->
                    </div>
                    <!-- end of row -->
                </div>
                <!-- end of container-fluid -->
         </section>
    </div>
    <!-- <div class="footer bg-inverse">
        <p class="text-center">Copyright &copy; <?php echo date('Y'); ?> Advance India Insurance Broker Services Ltd, All rights reserved.</p>
    </div> -->