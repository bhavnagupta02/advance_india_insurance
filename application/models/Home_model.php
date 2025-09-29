<?php
class Home_model extends CI_Model {
    public function __construct()
    {
		parent::__construct();
        $this->load->database();			
    }
    public function checkuser($postData){
        /*$query = $this->db->get_where('users', array('email' => $postData['email_mobile'], 'password' => base64_encode($postData['password']), 'user_level' => 1, 'verification_status'=>1 ));
        $user = $query->row_array();*/
        $em_mob = $postData['email_mobile'];
        $ps = base64_encode($postData['password']);
        $query = $this->db->select('*')
          ->from('users')
          ->where("(email = '$em_mob' OR mobile_number = '$em_mob')")
          ->where('password', $ps)
          ->where('user_level', 1)
          //->where('verification_status', 1)
          ->get();
        if($query->num_rows()>0){
            $user = $query->row_array();
            if($user['verification_status'] == 0){
                $response['status'] = 'error';
                $response['msg'] = 'Your KYC is not verified, Please contact to owner.';    
            }
            else{
                $response['status'] = 'success';
                $response['userdata'] = $user;
            }
        }
        return @$response;
        /*if($query->num_rows()>0){
            $user = $query->row_array();
            //print_r($query);die();
            return $user;
        }*/
    }
	
    public function users_details($pdata){
        $query = $this->db->get_where('users', array('id'=>$pdata, 'user_level' => 1, 'verification_status'=>1 ));
        $usersdata = $query->row_array();
        return $usersdata;
    }

    public function save_become_pos_data($postData){
        /*$query = $this->db->get_where('users', array("email"=>$postData['email'], "mobile_number"=>$postData['mobile_number']));
        $result = $query->row_array();
        if($query->num_rows()>0){
            //$response['status'] = 'error';
        }*/
        $em = $postData['email'];
        $mob = $postData['mobile_number'];
        $this->db->select('*');
        $query =  $this->db->from('users');
        $where = "email='".$em."' OR mobile_number=$mob";
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->row_array();
        if($query->num_rows()>0){
            //$response['status'] = 'error';
            if ($em == $result['email'])
            {
                $response['status'] = 'error';
                $response['msg'] = 'Email already exists';
            }
            elseif($mob == $result['mobile_number'])
            {
                $response['status'] = 'error';
                $response['msg'] = 'Mobile number already exists';
            }
        }
        else{
            $data = array(
                'name' => $postData['name'],
                'email' => $postData['email'],
                'password' => base64_encode($postData['password']),
                'mobile_number' => $postData['mobile_number'],
                'dob' => $postData['dob'],
                'pan_number' => $postData['pan_number'],
                'aadhar_number' => $postData['aadhar_number'],
                'city' => $postData['city'],
                'benificiary_name' => $postData['benificiary_name'],
                'account_number' => $postData['account_number'],
                'ifsc_code' => $postData['ifsc_code'],
                'pan_file' => $postData['pan_file'],
                'aadhar_file' => $postData['aadhar_file'],
                'certificate_file' => @$postData['certificate_file'],
                'photo_file' => @$postData['photo_file'],
                'cheque_file' => @$postData['cheque_file']
            );
            if($this->db->insert('users', $data)){
                $response['status'] = 'success';
            }
        }
        return $response;
    }

    public function get_user_detail($uid){
        $query = $this->db->get_where('users', array('id'=>$uid, 'user_level' => 1, 'verification_status'=>1 ));
        $usersdata = $query->row_array();
        return $usersdata;
    }
    public function get_last_policy_number(){
        $query = $this->db->query("SELECT policy_no FROM vehicle_insurance ORDER BY id DESC LIMIT 1");
        $result = $query->row_array();
        //print_r($result[1]['policy_no']);die();
        return $result;
    }

    function fetch_variants_list($postData){
        $this->db->where(array('variant_type'=>$postData['vehicle_type'], 'make_model'=>$postData['model_name'], 'status'=>1 ));
        //$this->db->order_by('variant_name', 'ASC');
        $query = $this->db->get('vehicle_variants');
        $output = '<option value="">Select Variant</option>';
        foreach($query->result() as $row){
            $output .= '<option value="'.$row->variant_name.'" data-variant-id="'.$row->id.'">'.$row->variant_name.'</option>';
        }
        return $output;
    }
    
    function fetch_cc_amount_basedon_varints($postData){
        $this->db->where(array('id'=>$postData['vid'], 'variant_type'=>$postData['vehicle_type'], 'status'=>1 ));
        $query = $this->db->get('vehicle_variants');
        /*$output = '<option value="" disabled="disabled">Select Engine CC</option>';*/
        foreach($query->result() as $row){
            $output = '<option value="'.$row->cube_capacity.'cc-'.$row->amount.'" selected="selected">'.$row->cube_capacity.'cc</option>';
        }
        return $output;
    }

    public function add_twowheeler_car_insurance_data($postData, $policy_no, $userid){
       /*$RegisDate = date("d-m-Y", strtotime($postData['reg_date']));
       $MfgDate = date("d-m-Y", strtotime($postData['mfg_date']));*/
       $data = array(
            'user_id' => $userid,
            'ins_type' => $postData['ins_type'],
            'registration_year' => $postData['registration_year'],
            'make_model' => $postData['make_model'],
            'fuel_type' => $postData['fuel_type'],
            'variant' => $postData['variant'],
            'rto_city' => $postData['rto_city'],
            'fuel_capacity_price' => $postData['fuel_capacity_price'],
            'reg_date' => $postData['reg_date'],
            'mfg_date' => $postData['mfg_date'],
            'policy_no' => $policy_no 
        );
        if($this->db->insert('vehicle_insurance', $data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_expired_policy_detail($postData, $userid){
        $query = $this->db->get_where('vehicle_insurance', array('id'=>$postData['InsId'], 'ins_type'=>$postData['InsType'], 'user_id'=>$userid, 'user_level' => 1, 'payment_status'=>0 ));
        $policydata = $query->row_array();
        return $policydata;
    }
    
    public function get_expired_policy_detail_paymentsummaryRed($postData, $userid){
        $query = $this->db->get_where('vehicle_insurance', array('id'=>$postData['InsId'], 'ins_type'=>$postData['InsType'], 'user_id'=>$userid, 'user_level' => 1, 'payment_status'=>1 ));
        $policydata = $query->row_array();
        return $policydata;
    }
    
    public function update_quotes_data($InsData, $postData, $userid){
        //print_r($postData);die();
        $data = array(
                    'ins_company' => $postData['ins_company'],
                    'total_amount' => $postData['total_amount'],
                    'basic_amount' => $postData['basic_amount'],
                    'gst_amount' => $postData['gst_amount'],
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where(array('id'=>$InsData['InsId'], 'ins_type'=>$InsData['InsType'], 'user_id'=>$userid, 'payment_status'=>0 )); 
        if($this->db->update("vehicle_insurance", $data)){ 
            return true;
        } else{
            return false;
        }
    }

    function fetch_city_list($state_name){
      $this->db->where('city_state', $state_name);
      $this->db->order_by('city_name', 'ASC');
      $query = $this->db->get('state_cities');
      //print_r($query);die();
      $output = '<option value="">Select City</option>';
      foreach($query->result() as $row)
      {
       $output .= '<option value="'.$row->city_name.'">'.$row->city_name.'</option>';
      }
      return $output;
    }

    public function update_owner_details_data($InsData, $postData, $userid){
        //print_r($postData);die();
        $data = array(
                    'company_name' => $postData['company_name'],
                    'company_gstin' => $postData['company_gstin'],
                    'first_name' => $postData['first_name'],
                    'last_name' => $postData['last_name'],
                    'email' => $postData['email'],
                    'phone_no' => $postData['phone_no'],
                    'primary_address_line1' => $postData['primary_address_line1'],
                    'primary_address_line2' => @$postData['primary_address_line2'],
                    'primary_pin_code' => $postData['primary_pin_code'],
                    'primary_state' => $postData['primary_state'],
                    'primary_city' => $postData['primary_city'],
                    'corrs_address_line1' => $postData['corrs_address_line1'],
                    'corrs_address_line2' => $postData['corrs_address_line2'],
                    'corr_pin_code' => $postData['corr_pin_code'],
                    'corr_state' => $postData['corr_state'],
                    'corr_city' => $postData['corr_city'],
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where(array('id'=>$InsData['InsId'], 'ins_type'=>$InsData['InsType'], 'user_id'=>$userid, 'payment_status'=>0 )); 
        if($this->db->update("vehicle_insurance", $data)){ 
            return true;
        } else{
            return false;
        }
    }
    public function update_personal_details_data($InsData, $postData, $userid){
        //print_r($postData);die();
        $payment_date = date('d-m-Y h:i:s');
        $Policy_ExpDate = date('d-m-Y h:i:s',strtotime(date('d-m-Y h:i:s') . " + 364 day"));
        $policy_crnt_month = date('F');
        $policy_crnt_year = date('Y');
        $data = array(
                    'gender' => $postData['gender'],
                    'marital_status' => $postData['marital_status'],
                    'dob' => $RegisDate = $postData['dob'],
                    'occupation' => $postData['occupation'],
                    'nominee_name' => $postData['nominee_name'],
                    'nominee_relation' => $postData['nominee_relation'],
                    'nominee_age' => $postData['nominee_age'],
                    'payment_date' => $payment_date,
                    'policy_exp_date' => $Policy_ExpDate,
                    'policy_month' => $policy_crnt_month,
                    'policy_year' => $policy_crnt_year,
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where(array('id'=>$InsData['InsId'], 'ins_type'=>$InsData['InsType'], 'user_id'=>$userid, 'payment_status'=>0 )); 
        if($this->db->update("vehicle_insurance", $data)){ 
            return true;
        } else{
            return false;
        }
    }
    public function update_vehicle_details_data($InsData, $postData, $qrcode_dbimg, $userid){
        $Vehicle_No = str_replace(' ', '', $postData['vehicle_regis_no']);
        $vehicleRegisNo = strtoupper($postData['vehicle_rto_code']."".$Vehicle_No);
        /*$payment_date = date('d-m-Y h:i:s');
        $Policy_ExpDate = date('d-m-Y h:i:s',strtotime(date('d-m-Y h:i:s') . " + 364 day"));*/
        //print_r($vehicleRegisNo);die();
        $data = array(
                    'vehicle_registration_no' => $vehicleRegisNo,
                    'engine_no' => $postData['engine_no'],
                    'chassis_no' => $postData['chassis_no'],
                    'financial_company_name' => $postData['financial_company_name'],
                    'qr_image' => $qrcode_dbimg,
                    /*'payment_date' => $payment_date,
                    'policy_exp_date' => $Policy_ExpDate,*/
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where(array('id'=>$InsData['InsId'], 'ins_type'=>$InsData['InsType'], 'user_id'=>$userid, 'payment_status'=>0 )); 
        if($this->db->update("vehicle_insurance", $data)){ 
            return true;
        } else{
            return false;
        }
    }

    public function update_payment_details_data($InsData, $postData, $userid){
        $data = array(
                    'pay_by' => $postData['pay_by'],
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where(array('id'=>$InsData['InsId'], 'ins_type'=>$InsData['InsType'], 'user_id'=>$userid, 'payment_status'=>0 )); 
        if($this->db->update("vehicle_insurance", $data)){ 
            return true;
        } else{
            return false;
        }
    }
    public function update_PaymentWithPdf_details_data($postData, $PDF_FileName, $userid){
        /*$payment_date = date('d-m-Y h:i:s');
        $Policy_ExpDate = date('d-m-Y h:i:s',strtotime(date('d-m-Y h:i:s') . " + 364 day"));*/
        //print($payment_date."--".$Policy_ExpDate);die();
        $data = array(
                    'pay_by' => $postData['pay_by'],
                    'payment_method' => $postData['totalAmount'],
                    'transaction_id' => $postData['razorpay_payment_id'],
                    /*'payment_date' => $payment_date,
                    'policy_exp_date' => $Policy_ExpDate,*/
                    'payment_status' => 1,
                    'pdf_status' => 1,
                    'insurance_pdf_file' => $PDF_FileName,
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where(array('id'=>$postData['InsId'], 'ins_type'=>$postData['InsType'], 'user_id'=>$userid, 'payment_status'=>0 )); 
        if($this->db->update("vehicle_insurance", $data)){ 
            return true;
        } else{
            return false;
        }
    }
    
    public function update_payment_link_expire_status($InsData, $userid){
        $data = array(
                    'pay_link_exp' => 1,
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where(array('id'=>$InsData['InsId'], 'ins_type'=>$InsData['InsType'], 'user_id'=>$userid)); 
        if($this->db->update("vehicle_insurance", $data)){ 
            return true;
        } else{
            return false;
        }
    }
    
    public function get_pdf_policy_details_afterpayment($postData, $userid){
        $query = $this->db->get_where('vehicle_insurance', array('id'=>$postData['InsId'], 'ins_type'=>$postData['InsType'], 'user_id'=>$userid, 'user_level' => 1, 'payment_status'=>1 ));
        $policydata = $query->row_array();
        return $policydata;
    }
    
    public function get_all_ins_policy_data_withpaid($userid){
        $crnt_month = date('F');
    	$crnt_year = date('Y');
        $query = $this->db->get_where('vehicle_insurance', array('user_id'=>$userid, 'policy_month' => $crnt_month, 'policy_year' => $crnt_year, 'user_level' => 1, 'payment_status'=>1 ));
        $ins_policydata = $query->result_array();
        return $ins_policydata;
    }

    public function contact_us_data($postData){
        if ($this->db->insert('contact_us', $postData)) {
            
            $this->load->library('email');

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
            
            /*$config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'r074.blr1.mysecurecloudhost.com',
              'smtp_port' => 465,
              'smtp_user' => 'testingemail@posadvanceinsurance.com', 
              'smtp_pass' => ')=Ip*[*C+}.Q', 
              'mailtype' => 'html',
              'charset' => 'iso-8859-1',
              'wordwrap' => TRUE
            );
            $this->load->library('email', $config);*/
            
            $to_email = 'contact@posadvanceinsurance.com';
            //$to_email = 'admin@posadvanceinsurance.com';
            $this->email->from('no-reply@posadvanceinsurance.com', 'Advance India Insurance');
            $this->email->to($to_email);
            /*$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
            $this->email->set_header('Content-type', 'text/html');*/

            $this->email->subject('Contact Us Query - Advance India Insurance');

            $message = '<html><link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"><body style="margin:0px; padding:0px;">';
            $message .= '<div style="width:100%; float:left; margin:0px; padding:0px;">
            <div style="width:100%;  margin:0px auto; padding:0px;">
                <div style="width:100%; float:left; margin:0px; padding:10px 0px;">
            <div style="width:50%; float:left; margin:0px; padding:0px;"><p style="width:100%; float:left; margin:0px; padding:0px; font-family:Roboto, sans-serif; font-size:15px; line-height:50px;">Dear Admin,<br/> Plesae check below contact person details.</p></div>
            </div>
            <div style="width:100%; float:left; margin:0px; padding:0px 0px;">
            <p style="width:100%; float:left; margin:0px; padding:0px 0px 30px; font-family:Roboto, sans-serif; font-size:24px; line-height:40px; font-weight:300;">Name: '.$postData['fullname'].' <br/>
            Email: '.$postData['email'].' <br/>
            Phone: '.$postData['phone'].' <br/>
            Message: '.$postData['message'].' <br/>
            </p>
            
            <p style="width:100%; float:left; margin:0px; padding:0px; font-family:Roboto, sans-serif; font-size:16px; line-height:30px; font-weight:400;">Thanks,</p>
            <p style="width:100%; float:left; margin:0px; padding:0px 0px 30px; font-family:Roboto, sans-serif; font-size:16px; line-height:30px; font-weight:400;">Team Advance India Insurance
            </p>
            </div>
            
            </div>
            </div>';
            $message .= "</body></html>";
            //print_r($message);die();
            $this->email->message($message);
            //print_r($this->email->send());die();
            if($this->email->send()) 
            {
                $response['status'] = 1;
                $response['msg'] = 'Your query sent to our team successfuly. They will contact you soon.';
            }
            else {
                $response['status'] = 0;
                $response['msg'] = 'Unable to send your query, Please try again!';
            }
        }
        return $response;
    }

    /*public function user_profile_activate($userid){
        $query = $this->db->get_where('users', array("id"=>$userid));
        $result = $query->row_array();
        if($query->num_rows()>0){
            if($result['verify_status'] == 1)
            {
                $response['status'] = 'error';
                $response['msg'] = 'Your email is already verified!';
                $response['icon'] = base_url().'assets/images/Profile-Creation-Done.png';
            }
            else{
                $data = array(
                'verify_status' => 1,
                'updated' => date("Y-m-d h:i:s")
                );
                $this->db->set($data); 
                $this->db->where("id", $userid); 
                if($this->db->update("users", $data)){ 
                    $response['status'] = 'success';
                    $response['icon'] = base_url().'assets/images/Profile-Creation-Done.png';
                    $query = $this->db->select('first_name, email, user_level')->from('users')->where('id',$userid)->get();
                    $results = $query->row_array();
                    $response['first_name'] = $results['first_name'];
                    $response['email'] = $results['email'];
                    $response['user_level'] = $results['user_level'];
                }
                else{
                    $response['status'] = 'error';
                    $response['msg'] = 'Verification failed. Please try again!';
                    $response['icon'] = base_url().'assets/images/Profile-Creation-fl.png';
                }
            } 
        }
        else{
            $response['status'] = 'error';
            $response['msg'] = 'Email can not found. Please sign up first!';
            $response['icon'] = base_url().'assets/images/Profile-Creation-nf.png';
        }
        return $response;
    }*/
    
}
