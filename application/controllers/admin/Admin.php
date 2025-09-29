<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->library(array('session', 'email', 'upload', 'form_validation'));
		$this->load->helper(array('url', 'file'));
		$this->load->model(array('admin/Admin_model'));
        //$this->user_type = $this->session->userdata('user_level');
		$this->userid = $this->session->userdata('id');
		$this->admin_data = $this->Admin_model->admin_details($this->userid);
	}

	public function index()
	{
		if($this->session->has_userdata('id') && $this->session->userdata('type') == 'admin'){
            redirect('admin/dashboard');
        }
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			$admin_details = $this->Admin_model->checkuser($postData);
			if(!empty($admin_details)){
				$admin_details['type'] = 'admin';
				$this->session->set_userdata($admin_details);
				redirect('admin/dashboard');
			} else {
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Email & Password combination not matched.</div>');
		        redirect('admin');
			}
		}
		$page['title'] = 'Login | Advance India Insurance Admin';
		$this->load->view('admin/pages/login', $page);
		$this->load->view('admin/layouts/footer');
	}
	public function dashboard(){
	    if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		$page['title'] = 'Dashboard | Insurance Admin';
		$page['content'] = 'admin/pages/dashboard';
		$this->load->view('admin/layouts/template', $page);
	}
	public function view_users(){
	    if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		$page['users_data'] = $this->Admin_model->all_kyc_users_data();
		//print_r($page['users_data']);
		$page['title'] = 'View KYC Users | Insurance Admin';
		$page['content'] = 'admin/pages/view-kyc-users';
		$this->load->view('admin/layouts/template', $page);
	}
	public function edit_user($userid = NULL){
	    if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		//print_r($userid);die();
		$page['user_detail'] = $this->Admin_model->get_kyc_user_detail($userid);
		$page['title'] = 'Edit KYC User | Insurance Admin';
		$page['content'] = 'admin/pages/edit-kyc-user';
		$this->load->view('admin/layouts/template', $page);
	}
	public function kyc_verification($userid = NULL){
	    if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		//print_r($userid);die();
		$kyc_verify = $this->Admin_model->user_kyc_verification($userid);
		if($kyc_verify){
			$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have verified this user KYC successfully.</div>');
        	redirect('admin/edit-user/'.$userid.'');
		} 
		else {
			$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Please try again!</div>');
        	redirect('admin/edit-user/'.$userid.'');
       }
	}
	public function add_twowheeler_car_model(){
	    if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		if(!empty($this->input->post())){
			$postData = $this->input->post();
		 	$response = $this->Admin_model->add_vehicle_model_data($postData);
		 	if($response == 1){
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added Vehicle Model successfully.</div>');
        	redirect('admin/add-model');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in add vehicle model, Please try again!</div>');
        		redirect('admin/add-model');
		 	}
		}
		$page['title'] = 'Add Model | Insurance Admin';
		$page['content'] = 'admin/pages/add-model';
		$this->load->view('admin/layouts/template', $page);
	}
	public function view_twowheeler_models(){
	    if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		$model_type = 'two_wheeler';
		$page['twowheeler_models_data'] = $this->Admin_model->all_twowheeler_car_models_data($model_type);
		//print_r($page['twowheeler_models_data']);
		$page['title'] = 'View Two Wheeler Models | Insurance Admin';
		$page['content'] = 'admin/pages/view-twowheeler-models';
		$this->load->view('admin/layouts/template', $page);
	}
	public function view_car_models(){
	    if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		$model_type = 'car';
		$page['car_models_data'] = $this->Admin_model->all_twowheeler_car_models_data($model_type);
		//print_r($page['car_models_data']);
		$page['title'] = 'View Car Models | Insurance Admin';
		$page['content'] = 'admin/pages/view-car-models';
		$this->load->view('admin/layouts/template', $page);
	}
	public function edit_vehicle_model($modelid = NULL){
	    if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		$page['model_data'] = $this->Admin_model->get_vehiclemodel_data($modelid);
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			//print_r($postData);die();
			$response = $this->Admin_model->update_vehiclemodel_data($postData,$modelid);
			if($response==1){
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have update vehicle model successfully.</div>');
	        	redirect('admin/edit-vehicle-model/'.$modelid.'');
			} 
			else {
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in update vehicle model, Please try again!</div>');
	        	redirect('admin/edit-vehicle-model/'.$modelid.'');
	       	}
		}
       	$page['title'] = 'Edit Vehicle Model | Insurance Admin';
		$page['content'] = 'admin/pages/edit-vehicle-model';
		$this->load->view('admin/layouts/template', $page);
	}
	public function delete_vehicle_model($modelid = NULL){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		//print_r($modelid);die();
		$response = $this->Admin_model->delete_vehicle_model_data($modelid);
		if($response){
			echo json_encode($response);
		}
	}
	
	function fetch_models_for_variants(){
	  if(!empty($this->input->post('model_type'))){
	  	$modelType = $this->input->post('model_type');
	   	echo $this->Admin_model->fetch_models_list_in_variants($modelType);
	  }
 	}
	public function add_twowheeler_car_variants(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		//$page['models_data'] = $this->Admin_model->all_twowheeler_car_models_data();
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			$response = $this->Admin_model->add_vehicle_variant_data($postData);
			//print_r($response);die();
			if($response == 1){
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added Vehicle Variant successfully.</div>');
        		redirect('admin/add-variant');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in add vehicle variant, Please try again!</div>');
        		redirect('admin/add-variant');
		 	}
		}
		$page['title'] = 'Add Variant | Insurance Admin';
		$page['content'] = 'admin/pages/add-vehicle-variant';
		$this->load->view('admin/layouts/template', $page);
	}
	public function view_twowheeler_variants()
	{
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin'){
			redirect('admin');
		}
		$variant_type = 'two_wheeler';
		$page['twowheeler_variants_data'] = $this->Admin_model->all_twowheeler_car_variants_data($variant_type);
		//print_r($page['twowheeler_variants_data']);die();
		$page['title'] = 'View Two Wheeler Variants | Insurance Admin';
		$page['content'] = 'admin/pages/view-twowheeler-variants';
		$this->load->view('admin/layouts/template', $page);
	}
	public function view_car_variants()
	{
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin'){
			redirect('admin');
		}
		$variant_type = 'car';
		$page['car_variants_data'] = $this->Admin_model->all_twowheeler_car_variants_data($variant_type);
		//print_r($page['car_variants_data']);die();
		$page['title'] = 'View Car Variants | Insurance Admin';
		$page['content'] = 'admin/pages/view-car-variants';
		$this->load->view('admin/layouts/template', $page);
	}

	function fetch_models_forEdit_variants(){
	  if(!empty($this->input->post())){
	  	$postData = $this->input->post();
	   	echo $this->Admin_model->fetch_models_list_inEdit_variants($postData);
	  }
 	}

	public function edit_vehicle_variant($variantid){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin'){
			redirect('admin');
		}
		$page['variant_data'] = $this->Admin_model->get_vehiclevariant_data($variantid);
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			$response = $this->Admin_model->update_vehiclevariant_data($postData,$variantid);
			if($response==1){
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have update vehicle variant successfully.</div>');
	        	redirect('admin/edit-vehicle-variant/'.$variantid.'');
			} 
			else {
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in update vehicle variant, Please try again!</div>');
	        	redirect('admin/edit-vehicle-variant/'.$variantid.'');
	       	}
		}
		$page['title'] = 'Edit Vehicle Variant | Insurance Admin';
		$page['content'] = 'admin/pages/edit-vehicle-variant';
		$this->load->view('admin/layouts/template', $page);
	}
	public function delete_vehicle_variant($variantid = NULL){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		//print_r($variantid);die();
		$response = $this->Admin_model->delete_vehicle_variant_data($variantid);
		if($response){
			echo json_encode($response);
		}
	}
	public function add_vehicle_rto_city_num(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			$response = $this->Admin_model->add_vehicle_rto_city_number($postData);
			//print_r($response);die();
			if($response == 1){
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have added RTO/City vehicle data successfully.</div>');
        		redirect('admin/add-rto-city');
		 	}
		 	else{
		 		$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in add RTO/City vehicle data, Please try again!</div>');
        		redirect('admin/add-rto-city');
		 	}
		}
		$page['title'] = 'Add Vehicle RTO/City | Insurance Admin';
		$page['content'] = 'admin/pages/add-rto-city';
		$this->load->view('admin/layouts/template', $page);
	}
	public function view_vehicle_rto_cities()
	{
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin'){
			redirect('admin');
		}
		$page['rto_cities_data'] = $this->Admin_model->all_vehicle_rto_city_data();
		//print_r($page['car_variants_data']);die();
		$page['title'] = 'View Vehicle RTO/City | Insurance Admin';
		$page['content'] = 'admin/pages/view-rto-cities';
		$this->load->view('admin/layouts/template', $page);
	}
	public function edit_vehicle_rto_city($RTOcityid){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin'){
			redirect('admin');
		}
		$page['rto_city_data'] = $this->Admin_model->get_vehicle_rtocity_data($RTOcityid);
		if(!empty($this->input->post())){
			$postData = $this->input->post();
			$response = $this->Admin_model->update_vehicle_rtocity_data($postData,$RTOcityid);
			if($response==1){
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-success text-center">You have updated vehicle RTO/City data successfully.</div>');
	        	redirect('admin/edit-vehicle-rto-city/'.$RTOcityid.'');
			} 
			else {
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">Error in update vehicle RTO/City data, Please try again!</div>');
	        	redirect('admin/edit-vehicle-rto-city/'.$RTOcityid.'');
	       	}
		}
		$page['title'] = 'Edit Vehicle RTO/City | Insurance Admin';
		$page['content'] = 'admin/pages/edit-rto-city';
		$this->load->view('admin/layouts/template', $page);
	}
	public function delete_vehicle_rto_city($RTOcityid = NULL){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin' ){
			redirect('admin');
		}
		$response = $this->Admin_model->delete_vehicle_rto_city_data($RTOcityid);
		if($response){
			echo json_encode($response);
		}
	}
	public function view_car_insurance_policies(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin'){
			redirect('admin');
		}
		$Insurance_type = 'car';
		$page['car_policies_data'] = $this->Admin_model->all_twowheeler_car_Inspolicies_data($Insurance_type);
		//print_r($page['car_policies_data']);die();
		$page['title'] = 'View Car Insurance Policies | Insurance Admin';
		$page['content'] = 'admin/pages/view-car-insurance-policies';
		$this->load->view('admin/layouts/template', $page);
	}
	public function view_twowheeler_insurance_policies(){
		if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin'){
			redirect('admin');
		}
		$Insurance_type = 'bike';
		$page['bike_policies_data'] = $this->Admin_model->all_twowheeler_car_Inspolicies_data($Insurance_type);
		//print_r($page['bike_policies_data']);die();
		$page['title'] = 'View Bike Insurance Policies | Insurance Admin';
		$page['content'] = 'admin/pages/view-bike-insurance-policies';
		$this->load->view('admin/layouts/template', $page);
	}

	/*BG Export Excel File Code Start*/
	// create xlsx
    public function export_excel_insurance_policies() {
    	if(!$this->session->has_userdata('id') && $this->session->userdata('type') != 'admin'){
			redirect('admin');
		}
    	if(!empty($this->input->post())){
			$postData = $this->input->post();
			//print_r($postData);die();

			//create file name
        	$fileName = $postData['vehicle_type'].'_insurance_policy-'.time().'.xlsx';  
 			//load excel library
        	$this->load->library('excel');
        	$response = $this->Admin_model->export_insurance_policies_data($postData);
        	//print_r($response);die();
			if($response){
		        $objPHPExcel = new PHPExcel();
		        $objPHPExcel->setActiveSheetIndex(0);
		        //set Header
		        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Month');
		        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Insurance Co.');
		        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Payment ID');
		        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Policy Start');
		        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Policy End');
		        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Policy Number');
		        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Customer Name');
		        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Vehicle Type');
		        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Case Type');
		        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Policy Type');
		        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Partner Name'); 
		        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Reg No'); 
		        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Vehicle Name');
		        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Mode of Payment');
		        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'TP Prem');
		        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Tax');
		        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Total Prem');

		        //set Header Layout Design
		        $objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setSize(9);
		        $objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setBold(true);
		        $objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        
		        //set Row in excel
		        $rowCount = 2;
		        foreach ($response as $val) 
		        {
		        	$CustomerName = ucwords($val['first_name'].' '.$val['last_name']);

		        	//set Row Layout Design
		        	$objPHPExcel->getActiveSheet()->getStyle('A:Q')->getFont()->setSize(10);
		        	$objPHPExcel->getActiveSheet()->getStyle('A:Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        	/*$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		        	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		        	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);*/

		            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, date("F", strtotime($val['payment_date'])));
		            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Acko');
		            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['transaction_id']);
		            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, date("j M y 00:00", strtotime($val['payment_date'])).' hrs');
		            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, date("j M y 23:59", strtotime($val['policy_exp_date'])).' hrs');
		            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['policy_no']);
		            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $CustomerName);
		            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, ucwords($val['ins_type']));
		            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, 'Online');
		            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, 'Third Party');
		            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, ucwords($val['name']));
		            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $val['vehicle_registration_no']);
		            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, ucwords($val['make_model']));
		            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, 'Online');
		            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $val['basic_amount']);
		            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $val['gst_amount']);
		            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $val['total_amount']);

		            $rowCount++;
		        }
		        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		        $file_storage = "uploads/excel_files/".$fileName;
		        $objWriter->save($file_storage);
		        //$objWriter->save($fileName);
		 		//download excel file
		        header("Content-Type: application/vnd.ms-excel");
		        redirect(base_url().$file_storage);
		        //redirect(site_url().$fileName);
			} 
			else {
				$this->session->set_flashdata('msg','<div style="float: left;width: 100%;" class="alert alert-danger text-center">No data found for these dates, Please try again!</div>');
	        	redirect('admin/export-insurance-policies');
	       	}
		}
        $page['title'] = 'Export Insurance Policies | Insurance Admin';
		$page['content'] = 'admin/pages/export-insurance-policies';
		$this->load->view('admin/layouts/template', $page);            
    }
    /*BG Export Excel File Code End*/

	public function logout(){
		if($this->session->has_userdata('id') && $this->session->userdata('type') == 'admin' ){
			$this->session->sess_destroy();
			redirect('admin');
		}	
	}


}