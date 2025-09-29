<?php
if(!empty($success_msg)){
    if(isset($exp_policy_data['insurance_pdf_file'])){
    	$pdf_path = base_url().$exp_policy_data['insurance_pdf_file'];
    	$file=explode('/', $exp_policy_data['insurance_pdf_file']);
    }
    
    if(!empty($exp_policy_data['first_name']) || !empty($exp_policy_data['last_name'])){
        $fullname = strtoupper($exp_policy_data['first_name']." ".$exp_policy_data['last_name']);
	}
	if(!empty($exp_policy_data['company_name'])){
		$fullname = strtoupper($exp_policy_data['company_name']);
	}

    //echo $success_msg;
?>
<div class="Thanku-page">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">
<div class="card-body text-center">
    <div class="logo"><a href="<?php if(isset($this->user_data)){ echo base_url('user-dashboard'); } else{echo base_url();}?>"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="" class="log-pos" /></a></div> 
    <div class="like-logo"><img src="<?php echo base_url('assets/images/thanku-new.png'); ?>" alt="" class="log-pos" /></div> 
<h3 class="text-white" style="text-align: center;"><?php // echo $exp_policy_data['ins_type']; ?> Congratulations!</h3>
<p>Hi <?php echo $fullname; ?>, <br /><br />
Thank you for trusting Advanceinsurance and insuring your vichle with us. Download the policy for your <?php echo $exp_policy_data['make_model']." ".$exp_policy_data['variant']; ?> bearing Registration Number <?php echo $exp_policy_data['vehicle_registration_no']; ?>. Your Policy Number is <?php echo $exp_policy_data['policy_no'].'/00'; ?>. We have send attachment your registered mail I'd. You can download your policy form your Partner Account.</p>

<div class="Manage"><a class="btn btn-warning" download="<?php echo $file['2'];?>" href="<?php echo $pdf_path;?>" title="Download your policy"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Manage Policy</a></div>

<div class="parivhn-txt">Your new policy details will reflect on the Parivahan website within 30 days of policy issuance.</div>

</div>
</div>
</div>
</div>
</div>
<?php }?>