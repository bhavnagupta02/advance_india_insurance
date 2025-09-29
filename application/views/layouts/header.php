<!DOCTYPE html>
<html class="no-js" lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<title><?php if(isset($title)){ echo $title; } ?></title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/common_compress_style.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/style_new.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/style-main.css'); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.css'>

<style type="text/css">
  .datepicker td.today.day {
    background: #2491eb !important;
    color: #fff;
  }
</style>
<!--JS files-->
<?php if($this->uri->segment(1) == 'payment-summary'){?>
<!-- This script for Razorpay load only on Payment Summary Page-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<?php }?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" type="text/javascript"></script> -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js' type="text/javascript"></script> -->
</head>
<?php $is_home = $this->router->fetch_method() === 'index' ? true : false;?>
<body class="<?php if($is_home==1){echo 'bgwall';}?>">
<div class="bg">
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid" id="pos_main_tp_nv">
      <div class="navbar-header">
         
          <a class="navbar-brand" href="<?php if(isset($this->user_data)){ echo base_url('user-dashboard'); } else{echo base_url();}?>"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="" class="log-pos" /></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      </div>
      <div class="collapse navbar-collapse mobileNo" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <?php if(isset($this->user_data)){ ?>
          <li class="<?php if($this->uri->segment(1)=='user-dashboard'){echo 'active';}?>"><a href="<?php echo base_url('user-dashboard'); ?>">Home</a></li>
          <li class="<?php if($this->uri->segment(1)=='transactions'){echo 'active';}?>"><a href="<?php echo base_url('transactions'); ?>">Transactions</a></li>
          <li class="dropdown lastli_border mobileNo"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i><?php if(isset($this->user_data['name'])){ echo $this->user_data['name']; }?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('my-profile');?>">My Profile</a></li>
              <li><a href="<?php echo base_url('home/logout/'); ?>">Logout</a></li>
            </ul>
          </li>
          <?php } else{?>
          <li class="become_pos_nav_li"><a href="<?php echo base_url('become-pos'); ?>">Become POS</a></li>
          <?php }?>
        </ul>
      </div>
    </div>
  </nav>
  
  <!--Header Ends-->