<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'email', 'form_validation', 'upload' ));
		$this->load->helper(array('url', 'file'));
		$this->load->model(array('Home_model', 'admin/Admin_model'));
		
		$this->userid = $this->session->userdata('id');
		$this->user_data = $this->Home_model->users_details($this->userid);
		date_default_timezone_set('Asia/Kolkata');
	}
	
	public function index(){
		if($this->session->has_userdata('id') && $this->session->userdata('type') == 'frontend'){
        	redirect('user-dashboard');
    	}
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			$response = $this->Home_model->checkuser($postData);
			//if(!empty($user_details)){
			if($response['status'] == 'success'){
				$user_details = $response['userdata'];
				$user_details['type'] = 'frontend';
				$this->session->set_userdata($user_details);
				redirect('user-dashboard');
			}
			else if($response['status'] == 'error') {
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">'.$response['msg'].'</div>');
				redirect('');
			}
			else {
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Login Credentials are incorrect, Please try with correct one.</div>');
		        redirect('');
			}
		}
		$page['title'] = 'Login | Advance India Insurance Broker Services';
		$page['content'] = 'pages/index';
		$this->load->view('layouts/template', $page);
	}

	function set_upload_options()
	{   
		$config = array();
		$config['upload_path'] = './uploads/kyc/';
		$config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx';
		$config['max_size']     = 0;
		return $config;
	}

	public function become_pos(){
		if($this->session->has_userdata('id') && $this->session->userdata('type') == 'frontend'){
        	redirect('user-dashboard');
    	}
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			$page['base_url'] = base_url();
			if (isset($_FILES['pan_file']) && !empty($_FILES['pan_file']['name'])) {
				$this->upload->initialize($this->set_upload_options());
				if (!$this->upload->do_upload('pan_file')) {
					$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">'.$this->upload->display_errors().'</div>');
					redirect('become-pos');
					}else {
					$upload_data = $this->upload->data();
					$postData["pan_file"] = 'uploads/kyc/'.$upload_data['file_name'];
					//$filename2 = $upload_data['file_name'];
					//$postData['pan_file']=$postData["pan_file"]; 
				}
			}
			if (isset($_FILES['aadhar_file']) && !empty($_FILES['aadhar_file']['name'])) {
				$this->upload->initialize($this->set_upload_options());
				if (!$this->upload->do_upload('aadhar_file')) {
					$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">'.$this->upload->display_errors().'</div>');
					redirect('become-pos');
					}else {
					$upload_data = $this->upload->data();
					$postData["aadhar_file"] = 'uploads/kyc/'.$upload_data['file_name'];
					// $filename = $upload_data['file_name'];
				}
			}
			if (isset($_FILES['certificate_file']) && !empty($_FILES['certificate_file']['name'])) {
				$this->upload->initialize($this->set_upload_options());
				if (!$this->upload->do_upload('certificate_file')) {
					$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">'.$this->upload->display_errors().'</div>');
					redirect('become-pos');
					}else {
					$upload_data = $this->upload->data();
					$postData["certificate_file"] = 'uploads/kyc/'.$upload_data['file_name'];
				}
			}
			if (isset($_FILES['photo_file']) && !empty($_FILES['photo_file']['name'])) {
				$this->upload->initialize($this->set_upload_options());
				if (!$this->upload->do_upload('photo_file')) {
					$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">'.$this->upload->display_errors().'</div>');
					redirect('become-pos');
					}else {
					$upload_data = $this->upload->data();
					$postData["photo_file"] = 'uploads/kyc/'.$upload_data['file_name'];
				}
			}
			if (isset($_FILES['cheque_file']) && !empty($_FILES['cheque_file']['name'])) {
				$this->upload->initialize($this->set_upload_options());
				if (!$this->upload->do_upload('cheque_file')) {
					$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">'.$this->upload->display_errors().'</div>');
					redirect('become-pos');
					}else {
					$upload_data = $this->upload->data();
					$postData["cheque_file"] = 'uploads/kyc/'.$upload_data['file_name'];
				}
			}
			
			$response = $this->Home_model->save_become_pos_data($postData);
			if($response['status'] == 'success'){
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have successfully completed your KYC process, Please wait for verification.</div>');
	        	redirect('become-pos');
			}
			else if($response['status'] == 'error') {
				//$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Email and Mobile both are already exist, please try with different.</div>');
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">'.$response['msg'].'</div>');
				redirect('become-pos');
			}
			else {
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Please try again having some issue.</div>');
				redirect('become-pos');
			}
		}
		$page['title'] = 'Become POS | Advance India Insurance Broker Services';
		$page['content'] = 'pages/become-pos';
		$this->load->view('layouts/template', $page);
	}

	function fetch_varints_basedon_model(){
	  if(!empty($this->input->post())){
	  	$postData = $this->input->post();
	   	echo $this->Home_model->fetch_variants_list($postData);
	  }
 	}
 	
 	function fetch_cc_basedon_varints(){
	  if(!empty($this->input->post())){
	  	$postData = $this->input->post();
	  	//print_r($postData);die();
	   	echo $this->Home_model->fetch_cc_amount_basedon_varints($postData);
	  }
 	}

	public function user_dashboard(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	//print_r($this->user_data['id']);
    	$insurance_type = 'car';
    	$page['car_models_data'] = $this->Admin_model->all_twowheeler_car_models_data($insurance_type);
    	$page['car_variants_data'] = $this->Admin_model->all_twowheeler_car_variants_data($insurance_type);
    	$page['rto_cities_data'] = $this->Admin_model->all_vehicle_rto_city_data();
    	
    	if(!empty($this->input->post())){
    		//Create Policy Number
    		$last_policy_no = $this->Home_model->get_last_policy_number();
		    if($last_policy_no['policy_no']==''){
		        $policy_no = 'BBTA00252594201';
		    }
		    else{
		        $policy_no = $last_policy_no['policy_no'];
		        $policy_no++;
		    }
		    /*print_r($last_policy_no['policy_no']);
		    echo "<br/>";
		    print_r($policy_no); die();*/
    		$userid = $this->user_data['id'];
			$postData = $this->input->post();
			$response = $this->Home_model->add_twowheeler_car_insurance_data($postData, $policy_no, $userid);
			//print_r($response);die();
			if($response == 1){
				$Insid = $this->db->insert_id();
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added your four wheeler policy data successfully.</div>');
        		redirect('quotes/car/'.$Insid.'');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in added policy data, Please try again!</div>');
        		redirect('user-dashboard');
		 	}
		}

    	//print_r($page['rto_cities_data']);die();
		$page['title'] = 'User Dashboard | Advance India Insurance Broker Services';
		$page['content'] = 'pages/dashboard';
		$this->load->view('layouts/template', $page);
	}
	public function user_profile(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	$user_id = $this->user_data['id'];
    	$page['user_detail'] = $this->Home_model->get_user_detail($user_id);
		$page['title'] = 'User Profile | Advance India Insurance Broker Services';
		$page['content'] = 'pages/user-profile';
		$this->load->view('layouts/template', $page);
	}
	public function bike_insurance(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	$insurance_type = 'two_wheeler';
    	$page['bike_models_data'] = $this->Admin_model->all_twowheeler_car_models_data($insurance_type);
    	$page['bike_variants_data'] = $this->Admin_model->all_twowheeler_car_variants_data($insurance_type);
    	$page['rto_cities_data'] = $this->Admin_model->all_vehicle_rto_city_data();

    	if(!empty($this->input->post())){
    		//Create Policy Number
    		$last_policy_no = $this->Home_model->get_last_policy_number();
		    if($last_policy_no['policy_no']==''){
		        $policy_no = 'BBTA00252594201';
		    }
		    else{
		        $policy_no = $last_policy_no['policy_no'];
		        $policy_no++;
		    }
		    /*print_r($last_policy_no['policy_no']);
		    echo "<br/>";
		    print_r($policy_no); die();*/
    		$userid = $this->user_data['id'];
			$postData = $this->input->post();
			$response = $this->Home_model->add_twowheeler_car_insurance_data($postData, $policy_no, $userid);
			if($response == 1){
				$Insid = $this->db->insert_id();
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added your two wheeler policy data successfully.</div>');
        		redirect('quotes/bike/'.$Insid.'');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in added policy data, Please try again!</div>');
        		redirect('bike-info');
		 	}
		}

		$page['title'] = 'Bike Insurance | Advance India Insurance Broker Services';
		$page['content'] = 'pages/bikeinfo';
		$this->load->view('layouts/template', $page);
	}

	public function quotes(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	$InsData['InsType'] = $this->uri->segment(2);
    	$InsData['InsId'] = $this->uri->segment(3);
    	if($InsData['InsType']=='car'){
    		$wheelerType = 'four';
    	}else{
    		$wheelerType = 'two';
    	}
    	//print_r($this->userid);die();
    	$page['exp_policy_data'] = $this->Home_model->get_expired_policy_detail($InsData, $this->userid);
    	//print_r($page['exp_policy_data']);die();
    	if(!empty($this->input->post())){
    		$postData = $this->input->post();
    		$response = $this->Home_model->update_quotes_data($InsData, $postData, $this->userid);
    		if($response == 1){
				//$Insid = $this->db->insert_id();
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added your '.$wheelerType.' wheeler quotes data successfully.</div>');
        		redirect('owner-details/'.$InsData['InsType'].'/'.$InsData['InsId'].'');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in quotes data, Please try again!</div>');
        		redirect('quotes/'.$InsData['InsType'].'/'.$InsData['InsId'].'');
		 	}
    	}
		$page['title'] = 'Insurance-Quotes | Advance India Insurance Broker Services';
		$page['content'] = 'pages/quotes';
		$this->load->view('layouts/template', $page);
	}

	function fetch_city(){
	  if(!empty($this->input->post('state_name'))){
	  	$stateName = $this->input->post('state_name');
	   	echo $this->Home_model->fetch_city_list($stateName);
	  }
 	}
 	
	public function owner_details(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	$InsData['InsType'] = $this->uri->segment(2);
    	$InsData['InsId'] = $this->uri->segment(3);
    	$page['exp_policy_data'] = $this->Home_model->get_expired_policy_detail($InsData, $this->userid);
    	if(!empty($this->input->post())){
    		$postData = $this->input->post();
    		$response = $this->Home_model->update_owner_details_data($InsData, $postData, $this->userid);
    		if($response == 1){
				//$Insid = $this->db->insert_id();
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added owner details successfully.</div>');
        		redirect('personal-details/'.$InsData['InsType'].'/'.$InsData['InsId'].'');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in owner details, Please try again!</div>');
        		redirect('owner-details/'.$InsData['InsType'].'/'.$InsData['InsId'].'');
		 	}
    	}
		$page['title'] = 'Insurance-Owner Details | Advance India Insurance Broker Services';
		$page['content'] = 'pages/owner-details';
		$this->load->view('layouts/template', $page);
	}
	public function personal_details(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	//print_r($this->user_data);
    	$InsData['InsType'] = $this->uri->segment(2);
    	$InsData['InsId'] = $this->uri->segment(3);
    	$page['exp_policy_data'] = $this->Home_model->get_expired_policy_detail($InsData, $this->userid);
    	if(!empty($this->input->post())){
    		$postData = $this->input->post();
    		$response = $this->Home_model->update_personal_details_data($InsData, $postData, $this->userid);
    		if($response == 1){
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added personal details successfully.</div>');
        		redirect('vehicle-details/'.$InsData['InsType'].'/'.$InsData['InsId'].'');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in personal details, Please try again!</div>');
        		redirect('personal-details/'.$InsData['InsType'].'/'.$InsData['InsId'].'');
		 	}
    	}
		$page['title'] = 'Insurance-Personal Details | Advance India Insurance Broker Services';
		$page['content'] = 'pages/personal-details';
		$this->load->view('layouts/template', $page);
	}
	public function vehicle_details(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	$InsData['InsType'] = $this->uri->segment(2);
    	$InsData['InsId'] = $this->uri->segment(3);
    	$page['exp_policy_data'] = $this->Home_model->get_expired_policy_detail($InsData, $this->userid);
    	if(!empty($this->input->post())){
    		$postData = $this->input->post();

    		/*Img QR Code Start*/
			$this->load->library('ciqrcode');

			$policy_holder='';
			$vehicle_no='';
			$policy_period='';
			if(!empty($page['exp_policy_data']['first_name']) || !empty($page['exp_policy_data']['last_name'])){
			    $policy_holder = "Insured Name: ".strtoupper($page['exp_policy_data']['first_name']." ".$page['exp_policy_data']['last_name']);
			}
			if(!empty($page['exp_policy_data']['company_name'])){
				$policy_holder = "Insured Name: ".strtoupper($page['exp_policy_data']['company_name']);
			}

			if(!empty($postData['vehicle_regis_no'])){
				$Vehicle_No = str_replace(' ', '', $postData['vehicle_regis_no']);
			    $vehicleRegisNo = strtoupper($postData['vehicle_rto_code']."".$Vehicle_No);
				$vehicle_no = "Registration Number: ".$vehicleRegisNo;
			}
			if(!empty($page['exp_policy_data']['payment_date']) && !empty($page['exp_policy_data']['policy_exp_date'])){
				$policy_period = "Period of Insurance: ".date("j M y 00:00", strtotime($page['exp_policy_data']['payment_date']))." hrs to ".date("j M y 23:59",strtotime($page['exp_policy_data']['policy_exp_date']))." hrs";
			}
			$qrcode_data = $policy_holder."\n".$vehicle_no."\n".$policy_period;
			//$qr_image=rand().'.png';
			$qr_image = 'Qrcode-'.$InsData['InsId'].$InsData['InsType'].rand(2,200).'.png';
			$params['data'] = $qrcode_data;
			$params['level'] = 'H';
			$params['size'] = 2;
			$params['savename'] =FCPATH."uploads/qr_code/".$qr_image;
			if($this->ciqrcode->generate($params))
			{
				$data['img_url']=$qr_image;	
				$qrcode_dbimg = 'uploads/qr_code/'.$qr_image;
				/*print_r($qrcode_dbimg);
				echo"<center><img src=".base_url().'uploads/qr_code/'.$qr_image."></center";*/
			}
    		/*Img QR Code End*/
    		$response = $this->Home_model->update_vehicle_details_data($InsData, $postData, $qrcode_dbimg, $this->userid);
    		
    		if($response == 1){
    		    $InsUid = base64_encode($InsData['InsId']."&".$this->userid);
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added vehicle details successfully.</div>');
        		redirect('payment-summary/'.$InsData['InsType'].'/'.$InsUid.'');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in vehicle details, Please try again!</div>');
        		redirect('vehicle-details/'.$InsData['InsType'].'/'.$InsData['InsId'].'');
		 	}
    	}
		$page['title'] = 'Insurance-Vehicle Details | Advance India Insurance Broker Services';
		$page['content'] = 'pages/vehicle-details';
		$this->load->view('layouts/template', $page);
	}

	public function insurance_documents(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	//print_r($this->user_data);
		$page['title'] = 'Insurance-Documents | Advance India Insurance Broker Services';
		$page['content'] = 'pages/documents';
		$this->load->view('layouts/template', $page);
	}

	public function payment_summary(){
		/*if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	$InsData['InsType'] = $this->uri->segment(2);
    	$InsData['InsId'] = $this->uri->segment(3);
    	$page['exp_policy_data'] = $this->Home_model->get_expired_policy_detail($InsData, $this->userid);

		$page['title'] = 'Insurance-Payment Summary | Advance India Insurance Broker Services';
		$page['content'] = 'pages/payment-summary';
		$this->load->view('layouts/template', $page);*/
		
    	$InsData['InsType'] = $this->uri->segment(2);
    	$InsUid = $this->uri->segment(3);
    	$ExpldInsUid = explode('&',base64_decode($InsUid));
    	$InsData['InsId'] = $ExpldInsUid[0];
    	$User_Id = $ExpldInsUid[1];
    	/*echo $InsUid."<br/>";
    	print_r($ExpldInsUid);die();*/
    	
    	$page['exp_policy_data'] = $this->Home_model->get_expired_policy_detail_paymentsummaryRed($InsData, $User_Id);
    	if($page['exp_policy_data']['payment_status'] == 1){
    	    redirect('');
    	}
    	else{
    	    $page['exp_policy_data'] = $this->Home_model->get_expired_policy_detail($InsData, $User_Id);
    		
    	    //echo date_default_timezone_get(); die();
    	    $selecteddate = explode(" ", $page['exp_policy_data']['created']);
    	    $selectTime = '11:59:00pm';
			$SelectedTimeStamp = strtotime($selecteddate[0]." ".$selectTime);
    	    $currentDate = date('Y-m-d');
			$currentTimeStamp = strtotime(date('h:i:sa'));
			
			//$Selected1pmTimeStamp = strtotime('01:00:00pm');
			/*echo $selecteddate[0].'--'.$selectTime.'--'.$SelectedTimeStamp.'--'.$currentDate.'--'.$currentTimeStamp;
            die();
            if ($selecteddate[0] <= $currentDate && $currentTimeStamp >= $Selected12amTimeStamp)*/
			if ($currentTimeStamp >= $SelectedTimeStamp) {
			    $response = $this->Home_model->update_payment_link_expire_status($InsData, $User_Id);
			    redirect('');
			}
    	    else{
        		$page['title'] = 'Insurance-Payment Summary | Advance India Insurance Broker Services';
        		$page['content'] = 'pages/payment-summary';
        		$this->load->view('layouts/template', $page);
    	    }
        }
	}

	function payment_success(){
		/*if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}*/
	    $this->load->helper('pdf_helper');
	    $InsData['InsType'] = $this->uri->segment(2);
    	//$InsData['InsId'] = $this->uri->segment(3);
    	
    	$InsUid = $this->uri->segment(3);
    	$ExpldInsUid = explode('&',base64_decode($InsUid));
    	$InsData['InsId'] = $ExpldInsUid[0];
    	$User_Id = $ExpldInsUid[1];
    	
    	$page['exp_policy_data'] = $this->Home_model->get_expired_policy_detail($InsData, $User_Id);
    	//$page['exp_policy_data'] = $this->Home_model->get_pdf_policy_details_afterpayment($InsData, $this->userid);

    	$site_url = base_url();
	    tcpdf();
	    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		//$obj_pdf = new TCPDF('P', PDF_UNIT, array(400, 260), true, 'UTF-8', false);
		//$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', true);
		$obj_pdf->SetCreator(PDF_CREATOR);
		//$title = ucwords($InsData['InsType'])." Insurance Policy PDF";
		$title = $page['exp_policy_data']['policy_no'].".pdf";
		$obj_pdf->SetTitle($title);

		// Call before the addPage() method
		$obj_pdf->setPrintHeader(false); //Remove TCPDF PDF Header Top Border line
		//$obj_pdf->setPrintFooter(false); //Remove TCPDF PDF Footer
		$obj_pdf->SetFont('dejavusans', '', 10);

		$obj_pdf->AddPage();

		/*BG QR-Code with TCFDF Start*/
		/*$policy_holder='';
		$vehicle_no='';
		$policy_period='';
		if(!empty($page['exp_policy_data']['first_name']) || !empty($page['exp_policy_data']['last_name'])){
		    $policy_holder = "Insured Name: ".$page['exp_policy_data']['first_name']." ".$page['exp_policy_data']['last_name'];
		}
		if(!empty($page['exp_policy_data']['vehicle_registration_no'])){
			$vehicle_no = "Vehicle Number: ".$page['exp_policy_data']['vehicle_registration_no'];
		}
		if(!empty($page['exp_policy_data']['payment_date']) && !empty($page['exp_policy_data']['policy_exp_date'])){
			$policy_period = "Period of Insurance: ".date("j F Y h:i", strtotime($page['exp_policy_data']['payment_date']))." hrs to ".date("j F Y h:i",strtotime($page['exp_policy_data']['policy_exp_date']))." hrs";
		}
		$qrcode_data = $policy_holder."\n".$vehicle_no."\n".$policy_period;

		$style = array(
		    'border' => false,
		    'vpadding' => 3,
		    //'hpadding' => 8,
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);
		// QRCODE,H : QR-CODE Best error correction
		$obj_pdf->write2DBarcode($qrcode_data, 'QRCODE,H', 215, 10, 50, 0, $style, 'N');
		//$obj_pdf->Text(20, 205, 'QRCODE H');
		//$obj_pdf->write2DBarcode('http://advanceinsurances.in/uploads/insurance_pdf/car_insurance_policy25_1586512950.pdf', 'QRCODE,H', 148, 0, 50, 0, $style, 'N');*/
		/*BG QR-Code with TCFDF End*/

		ob_start();
		$htm_content = pdf_template($page['exp_policy_data'], $site_url); // Here pdf_template() is custom helper function created by me.
		ob_end_clean();
		$obj_pdf->writeHTML($htm_content, true, false, true, false, '');
		//$pdf_filename = $InsData['InsType'].'_insurance_policy'.$InsData['InsId'].'_'.time().'.pdf';

		$pdf_filename = $page['exp_policy_data']['policy_no'].'.pdf';
		/*if($page['exp_policy_data']['ins_type']=='car'){
		    $pdf_filename = '0.0.pdf';
		}
		else{
		    $pdf_filename = 'e25a1ef6010533de538ca0736d0b2aa5.pdf';
		}*/
		
		$url = $_SERVER["DOCUMENT_ROOT"].'/uploads/insurance_pdf/'; //Live Storage Path /home/ugwoyyxc299n/public_html/advanceinsurances.in

		//$url = 'c:/xampp/htdocs/insurance/uploads/insurance_pdf/'; //Local Storage Path
		//$url = base_url('uploads/insurance_pdf/');
		//$obj_pdf->Output($url.$pdf_filename, 'I');
		if(!empty($this->input->post())){
    		$postData = $this->input->post();
    		//print_r($postData);die();
    		$PDF_FileName = 'uploads/insurance_pdf/'.$pdf_filename;
			$FunResponse = $this->Home_model->update_PaymentWithPdf_details_data($postData, $PDF_FileName, $User_Id);
			//$FunResponse = $this->Home_model->update_pdf_details_data($InsData, $PDF_FileName, $this->userid);
			if($FunResponse == 1){
				//$obj_pdf->Output($url.$pdf_filename, 'I');
				$obj_pdf->Output($url.$pdf_filename, 'F');
				echo json_encode($FunResponse);
	 			//redirect('thankyou/'.$InsData['InsType'].'/'.$InsData['InsId'].'');
		 	}
    	}
	}

	public function payment_thankyou(){
		/*if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}*/
    	$InsData['InsType'] = $this->uri->segment(2);
    	//$InsData['InsId'] = $this->uri->segment(3);
    	
    	$InsUid = $this->uri->segment(3);
    	$ExpldInsUid = explode('&',base64_decode($InsUid));
    	$InsData['InsId'] = $ExpldInsUid[0];
    	$User_Id = $ExpldInsUid[1];
    	
    	$page['exp_policy_data'] = $this->Home_model->get_pdf_policy_details_afterpayment($InsData, $User_Id);
    	//print_r($page['exp_policy_data']);$this->user_data['email'];
    	
    	/*Email Notification Start for User/Admin*/
    	if(!empty($page['exp_policy_data']['first_name']) || !empty($page['exp_policy_data']['last_name'])){
    	    $policy_holder_name = $page['exp_policy_data']['first_name']." ".$page['exp_policy_data']['last_name'];
			}
		if(!empty($page['exp_policy_data']['company_name'])){
			$policy_holder_name = $page['exp_policy_data']['company_name'];
		}
    	$from_email = 'no-reply@posadvanceinsurance.com';
		$admin_email = 'admin@posadvanceinsurance.com';
		$email_sub = 'Advance India Insurance: '.strtoupper($policy_holder_name).', Download your Policy for '.$page['exp_policy_data']['make_model'];
		$pdfPath = base_url($page['exp_policy_data']['insurance_pdf_file']);
		$pdfAttachment = $_SERVER["DOCUMENT_ROOT"].'/'.$page['exp_policy_data']['insurance_pdf_file'];
		
    	/*$config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'abc@gmail.com', 
          'smtp_pass' => 'passwrd', 
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );
        $this->load->library('email', $config);*/
        
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'r074.blr1.mysecurecloudhost.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'no-reply@posadvanceinsurance.com';
        $config['smtp_pass']    = 'c#yN@!{Cn1&#';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      
        $this->email->initialize($config);
        
		//Email Notification for User
     	/*$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
     	$this->email->set_header('Content-type', 'text/html');*/
      	$this->email->from($from_email, 'Advance India Insurance'); 
      	//$this->email->to('gupta.bhavna612@gmail.com, seosattisingh@gmail.com, moneyrao30@gmail.com');
        $this->email->to($page['exp_policy_data']['email']);
        $this->email->reply_to('reply@posadvanceinsurance.com');
        //$this->email->attach($buffer, 'attachment', $pdfPath, 'application/pdf');
        $this->email->subject($email_sub); 

        $message = '<html><body style="margin:0px; padding:0px;"><div style="width:420px; margin:0px auto; background:#f1f2f4; padding:20px;">';
        $message .= '<table width="420" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td style="background:#fff; border-radius:5px 5px 0px 0px; padding:20px 10px;"><a href="#"><img src="'.base_url().'assets/images/logo.png" alt="" style="width:auto; height:60px;" /></a></td>
		</tr>
		<tr>
		<td style="background:#020d43; padding:30px 10px; text-align:center;">
		<img src="'.base_url().'assets/images/word.png" align="center" alt="" style="margin-bottom:20px;"  />
		<h3 style="font-family:Arial, Helvetica, sans-serif; line-height:36px;font-size:24px; font-weight:normal; color:#fff; margin:0px;">Here is your Policy for <span style="display:block; font-weight:bold">'.$page['exp_policy_data']['vehicle_registration_no'].'</span></h3>
		</td>
		</tr>
		<tr>
		<td style="background:#fff; padding:30px;">
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px;"><strong>Dear '.strtoupper($policy_holder_name).',</strong></p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px;">Thank you for choosing Advance india insurance broker Pvt Ltd. Download the policy for your <strong>'.$page['exp_policy_data']['make_model'].' </strong> bearing Registration Number <strong>'.$page['exp_policy_data']['vehicle_registration_no'].'</strong>. Your Policy Number is <strong>'.$page['exp_policy_data']['policy_no'].'/00</strong>.</p>
		</td>
		</tr>
		<tr>
		<td style="background:#fff; padding:0px 20px 0px 15px;">
		<ul style="list-style:none; margin:0px; padding:0px 0px 20px;">
		<li style="border:1px solid #d3d3d3; border-radius:5px;padding:20px"><img style="float:left; margin-right:15px;" src="'.base_url().'assets/images/download.png" alt="" />
		<h2 style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px; margin:0px; font-weight:bold;">ACKO General Insurance Limited</h2>
		<a style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:18px; font-weight:bold; color:#71a6fc; text-decoration:none;" href="'.$pdfPath.'" target="_blank">Download your policy</a>
		</li>
		</ul>
		</td>
		</tr>
		<tr>
		<td style="background:#fff; padding:30px; border-radius:0px 0px 10px 10px">
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:24px; margin:0px; font-weight:normal;">Warm Regards,</p>
		<a href="#"><img src="'.base_url().'assets/images/logo-email.png" alt="" style="margin:5px 0px 0px; width:auto; height:35px;" /></a>
		</td>
		</tr>
		</table>';
		$message .= '<table width="420" border="0" cellpadding="0" cellspacing="0" style="margin:15px 0px 0px;">
		<tr>
		<td style="background:#fff; padding:10px 30px; border-radius:10px ">
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; margin:0px; font-weight:normal; color:#999999">Advance india insurance broker Pvt limited address. 0-144. Shopping Mall  Arjun Marg. DLF Phase - 1 Gurugram,Haryana 122002 IRDAI License no 292 vaild up to :19th March 2021</p>
		</td>
		</tr>
		</table>';
		$message .= '<table width="420" border="0" cellpadding="0" cellspacing="0" style="margin:15px 0px 0px;">
		<tr>
		<td style="background:#fff; padding:20px 30px; border-radius:10px  10px 0px 0px ">
		<img src="'.base_url().'assets/images/call.png" alt="" style=" margin:8px 20px 0px 0px; width:35px;float:left;"  />
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:24px; margin:0px; font-weight:normal; color:#999999">we&#39;re happy to help</p>
		<p style="font-weight:bold;font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:24px; margin:0px; color:#333">1800212071392</p>
		</td>
		</tr>
		</table>';
		$message .= '<table width="420" border="0" cellpadding="0" cellspacing="0" style="margin:0px; border-top: 1px solid #d3d3d3;">
		<tr>
		<td style="background:#fff; padding:20px 30px 20px 85px; border-radius:0px 0px 10px 10px ">
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:18px; margin:0px; font-weight:normal; color:#999999;">Monday to Saturday 10am to 7pm except public holidays.</p>
		<a href="mailto:support@posadvanceinsurance.com" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:24px; font-weight:normal; color:#71a6fc; text-decoration:none;">support@posadvanceinsurance.com</a>
		</td>
		</tr>
		</table>';
        $message .= "</div></body></html>";
       	$this->email->message($message);
       	//$this->email->attach($pdfAttachment);
        
        if($this->email->send()){
            //echo "<br/>".$pdfAttachment."<br/>";
        	//Email Notification for Admin
        	/*$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
     	    $this->email->set_header('Content-type', 'text/html');*/
         	$this->email->from($from_email, 'Advance India Insurance'); 
            $this->email->to('gupta.bhavna612@gmail.com');
            $this->email->reply_to('reply@posadvanceinsurance.com');
            $this->email->subject('Advance India Insurance: Admin, Download '.strtoupper($policy_holder_name).' Policy of '.$page['exp_policy_data']['make_model']); 
    		
            $message1 = '<html><body style="margin:0px; padding:0px;"><div style="width:420px; margin:0px auto; background:#f1f2f4; padding:20px;">';
	        $message1 .= '<table width="420" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td style="background:#fff; border-radius:5px 5px 0px 0px; padding:20px 10px;"><a href="#"><img src="'.base_url().'assets/images/logo.png" alt="" style="width:auto; height:60px;" /></a></td>
			</tr>
			<tr>
			<td style="background:#020d43; padding:30px 10px; text-align:center;">
			<img src="'.base_url().'assets/images/word.png" align="center" alt="" style="margin-bottom:20px;"  />
			<h3 style="font-family:Arial, Helvetica, sans-serif; line-height:36px;font-size:24px; font-weight:normal; color:#fff; margin:0px;">Here is <strong>'.strtoupper($policy_holder_name).'</strong> Policy for <span style="display:block; font-weight:bold">'.$page['exp_policy_data']['vehicle_registration_no'].'</span></h3>
			</td>
			</tr>
			<tr>
			<td style="background:#fff; padding:30px;">
			<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px;"><strong>Dear ADMIN,</strong></p>
			<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px;"><strong>'.ucwords($policy_holder_name).'</strong> chooses policy of Advance india insurance broker Pvt Ltd. Check the policy for his/her <strong>'.$page['exp_policy_data']['make_model'].' </strong> bearing Registration Number <strong>'.$page['exp_policy_data']['vehicle_registration_no'].'</strong>. His/Her Policy Number is <strong>'.$page['exp_policy_data']['policy_no'].'/00</strong>.</p>
			</td>
			</tr>
			<tr>
			<td style="background:#fff; padding:0px 20px 0px 15px;">
			<ul style="list-style:none; margin:0px; padding:0px 0px 20px;">
			<li style="border:1px solid #d3d3d3; border-radius:5px;padding:20px"><img style="float:left; margin-right:15px;" src="'.base_url().'assets/images/download.png" alt="" />
			<h2 style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:20px; margin:0px; font-weight:bold;">ACKO General Insurance Limited</h2>
			<a style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:18px; font-weight:bold; color:#71a6fc; text-decoration:none;" href="'.$pdfPath.'" target="_blank">Download policy</a>
			</li>
			</ul>
			</td>
			</tr>
			<tr>
			<td style="background:#fff; padding:30px; border-radius:0px 0px 10px 10px">
			<p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:24px; margin:0px; font-weight:normal;">Warm Regards,</p>
			<a href="#"><img src="'.base_url().'assets/images/logo-email.png" alt="" style="margin:5px 0px 0px; width:auto; height:35px;" /></a>
			</td>
			</tr>
			</table>';
			$message1 .= '<table width="420" border="0" cellpadding="0" cellspacing="0" style="margin:15px 0px 0px;">
			<tr>
			<td style="background:#fff; padding:10px 30px; border-radius:10px ">
			<p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:17px; margin:0px; font-weight:normal; color:#999999">Advance india insurance broker Pvt limited address. 0-144. Shopping Mall  Arjun Marg. DLF Phase - 1 Gurugram,Haryana 122002 IRDAI License no 292 vaild up to :19th March 2021</p>
			</td>
			</tr>
			</table>';
			$message1 .= '<table width="420" border="0" cellpadding="0" cellspacing="0" style="margin:15px 0px 0px;">
			<tr>
			<td style="background:#fff; padding:20px 30px; border-radius:10px  10px 0px 0px ">
			<img src="'.base_url().'assets/images/call.png" alt="" style=" margin:8px 20px 0px 0px; width:35px;float:left;"  />
			<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:24px; margin:0px; font-weight:normal; color:#999999">we&#39;re happy to help</p>
			<p style="font-weight:bold;font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:24px; margin:0px; color:#333">1800212071392</p>
			</td>
			</tr>
			</table>';
			$message1 .= '<table width="420" border="0" cellpadding="0" cellspacing="0" style="margin:0px; border-top: 1px solid #d3d3d3;">
			<tr>
			<td style="background:#fff; padding:20px 30px 20px 85px; border-radius:0px 0px 10px 10px ">
			<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:18px; margin:0px; font-weight:normal; color:#999999;">Monday to Saturday 10am to 7pm except public holidays.</p>
			<a href="mailto:support@posadvanceinsurance.com" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:24px; font-weight:normal; color:#71a6fc; text-decoration:none;">support@posadvanceinsurance.com</a>
			</td>
			</tr>
			</table>';
	        $message1 .= "</div></body></html>";
	        //print_r($message1);die();
           	$this->email->message($message1); 
           	//$this->email->attach($pdfAttachment);
            if($this->email->send()){
             $page['success_msg'] = "Email sent to your register email, Please check your email for insurance policy detail.";   
            }
        }
    	/*Email Notification End for User/Admin*/

		$page['title'] = 'Insurance-Thankyou | Advance India Insurance Broker Services';
		//$this->load->view('pages/thankyou', $page);
		$page['content'] = 'pages/thankyou';
		$this->load->view('layouts/template', $page);
	}

	public function insurance_transactions(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'frontend'){
        	redirect('');
    	}
    	//print_r($this->userid);
    	$page['ins_policy_data'] = $this->Home_model->get_all_ins_policy_data_withpaid($this->userid);
    	//print_r($page['ins_policy_data']);
		$page['title'] = 'All Transactions | Advance India Insurance Broker Services';
		$page['content'] = 'pages/transactions';
		$this->load->view('layouts/template', $page);
	}
	public function contact_us_form(){
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			$response = $this->Home_model->contact_us_data($postData);
			//echo json_encode($response);
			if($response['status'] == 1){
				$Insid = $this->db->insert_id();
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">'.$response['msg'].'</div>');
        		redirect('contact-us');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">'.$response['msg'].'</div>');
        		redirect('contact-us');
		 	}
		}
		$page['title'] = 'Contact Us | Advance India Insurance Broker Services';
		$page['content'] = 'pages/contact-us';
		$this->load->view('layouts/template', $page);
	}

	public function logout(){
		if($this->session->has_userdata('id') && $this->session->userdata('type') == 'frontend' ){
			$this->session->sess_destroy();
			redirect('');
		}	
	}
	
}
	
