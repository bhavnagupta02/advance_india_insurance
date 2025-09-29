<?php
class Admin_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function checkuser($data){
        $query = $this->db->get_where('admin', array('email'=>$data['email'], 'password' => base64_encode($data['password'])));
        $user = $query->row_array();
        return $user;
    }
    public function admin_details($pdata){
        $query = $this->db->get_where('admin', array('id'=>$pdata, 'status' =>1 ));
        $admin = $query->row_array();
        return $admin;
    }
    public function all_kyc_users_data(){
        $query = $this->db->get_where('users', array('user_level'=>1));
        $allusers_data = $query->result_array();
        return $allusers_data;
    }
    public function get_kyc_user_detail($userid){
        $query = $this->db->get_where('users', array('id'=>$userid, 'user_level'=>1));
        $user_detail = $query->row_array();
        return $user_detail;
    }
    public function user_kyc_verification($userid){
        $data = array(
                    'verification_status' => 1,
                );
        $this->db->set($data); 
        $this->db->where("id", $userid); 
        if($this->db->update("users", $data)){ 
            return true;
        } else{
            return false;
        }
    }

    function fetch_models_list_in_variants($modelType){
      $this->db->where('model_type', $modelType);
      //$this->db->order_by('model_name', 'ASC');
      $query = $this->db->get('vehicle_models');
      //print_r($query);die();
      $output = '<option value="">Select Make/Models</option>';
      foreach($query->result() as $row)
      {
       $output .= '<option value="'.$row->model_name.'">'.$row->model_name.'</option>';
      }
      return $output;
    }

    function fetch_models_list_inEdit_variants($postData){
        $this->db->select('make_model');
        $query = $this->db->get_where('vehicle_variants', array('id'=>$postData['variant_id'], 'user_level'=>0));
        $vehicle_variant_model = $query->row_array(); // Assign Model Name in Variant 
        
        // All Models List As per Vehicle Type
        $this->db->select('model_name'); 
        $this->db->where('model_type', $postData['model_type']);
        //$this->db->order_by('model_name', 'ASC');
        $query = $this->db->get('vehicle_models');
        $mdl = $query->result_array();
        /*print_r($vehicle_variant_model);
        echo "<br/>";
        print_r($mdl);*/
        $output = '<option value="">Select Make/Models</option>';
        foreach($mdl as $key=>$val)
        {
            if($val['model_name'] == $vehicle_variant_model['make_model']){ $selectVal = 'selected="selected"';}
            else{ $selectVal = '';}
            $output .= '<option '.$selectVal.' value="'.$val['model_name'].'">'.$val['model_name'].'</option>';
        }
        return $output;
    }

    public function add_vehicle_model_data($postData){
       $add_model = $this->db->insert('vehicle_models',$postData);
       if($add_model){
        return true;
       }else{
        return false;
       }
    }
    public function all_twowheeler_car_models_data($model_type){
        $query = $this->db->get_where('vehicle_models', array('model_type'=>$model_type, 'status'=>1));
        $models_data = $query->result_array();
        return $models_data;
    }
    public function get_vehiclemodel_data($modelid){
        $query = $this->db->get_where('vehicle_models', array('id'=>$modelid, 'status'=>1));
        $vehicle_model_data = $query->row_array();
        return $vehicle_model_data;
    }
    public function update_vehiclemodel_data($postData,$modelid){
        $data = array(
                    'model_type' => $postData['model_type'],
                    'model_name' => $postData['model_name'],
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where("id", $modelid); 
        if($this->db->update("vehicle_models", $data)){ 
            return true;
        } else{
            return false;
        }
    }
    public function delete_vehicle_model_data($modelid){
    	$query = $this->db->delete('vehicle_models', 'id = '.$modelid);
        if($query){
            return true;
        }
        else{
            return false;
        }
    }
    public function add_vehicle_variant_data($postData){
        $query = $this->db->insert('vehicle_variants', $postData);
        if($query){
            return true;
        }else{
            return false;
        }
    }
    public function all_twowheeler_car_variants_data($variant_type){
        $query = $this->db->get_where('vehicle_variants', array('variant_type'=>$variant_type, 'user_level'=>0));
        $variants_data = $query->result_array();
        return $variants_data;
    }

    public function get_vehiclevariant_data($variantid){
        $query = $this->db->get_where('vehicle_variants', array('id'=>$variantid, 'user_level'=>0));
        $vehicle_variant_data = $query->row_array();
        return $vehicle_variant_data;
    }
    public function update_vehiclevariant_data($postData,$variantid){
        $data = array(
                    'variant_type' => $postData['variant_type'],
                    'variant_name' => $postData['variant_name'],
                    'make_model' => $postData['make_model'],
                    'cube_capacity' => $postData['cube_capacity'],
                    'amount' => $postData['amount'],
                    'status' => 1,
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where("id", $variantid); 
        if($this->db->update("vehicle_variants", $data)){ 
            return true;
        } else{
            return false;
        }
    }
    public function delete_vehicle_variant_data($variantid){
        $query = $this->db->delete('vehicle_variants', 'id = '.$variantid);
        if($query){
            return true;
        }
        else{
            return false;
        }
    }
    public function add_vehicle_rto_city_number($postData){
       $add_rto_city = $this->db->insert('vehicle_rto_city',$postData);
       if($add_rto_city){
        return true;
       }else{
        return false;
       }
    }
    public function all_vehicle_rto_city_data(){
        $query = $this->db->get_where('vehicle_rto_city', array('status'=>1));
        $rto_cities_data = $query->result_array();
        return $rto_cities_data;
    }
    public function get_vehicle_rtocity_data($RTOcityid){
        $query = $this->db->get_where('vehicle_rto_city', array('id'=>$RTOcityid, 'status'=>1));
        $vehicle_rto_city_data = $query->row_array();
        return $vehicle_rto_city_data;
    }
    public function update_vehicle_rtocity_data($postData,$RTOcityid){
        $data = array(
                    'rto_city_name' => $postData['rto_city_name'],
                    'rto_city_number' => $postData['rto_city_number'],
                    'updated' => date("Y-m-d h:i:s")
                );
        $this->db->set($data); 
        $this->db->where("id", $RTOcityid); 
        if($this->db->update("vehicle_rto_city", $data)){ 
            return true;
        } else{
            return false;
        }
    }
    public function delete_vehicle_rto_city_data($RTOcityid){
        $query = $this->db->delete('vehicle_rto_city', 'id = '.$RTOcityid);
        if($query){
            return true;
        }
        else{
            return false;
        }
    }
    public function all_twowheeler_car_Inspolicies_data($Insurance_type){
        $query = $this->db->get_where('vehicle_insurance', array('ins_type'=>$Insurance_type, 'user_level'=>1));
        $VehiclePolicies_data = $query->result_array();
        return $VehiclePolicies_data;
    }
    
    public function export_insurance_policies_data($postData) {
        $StartDate = date("Y-m-d", strtotime($postData['start_date']));
        $EndDate = date("Y-m-d", strtotime($postData['end_date']. ' +1 day'));
        
        //$EndDate = date("Y-m-d", strtotime($postData['end_date']));
        //print_r($StartDate." ".$EndDate);die();
        $btwn = "vehicle_insurance.created BETWEEN '".$StartDate."' AND '".$EndDate."'";
        $this->db->where($btwn);
        $this->db->where(array('vehicle_insurance.ins_type'=>$postData['vehicle_type'], 'vehicle_insurance.payment_status'=>1));
        //$this->db->where('vehicle_insurance.created BETWEEN $StartDate AND $EndDate');
        $this->db->select('*');
        $this->db->order_by("vehicle_insurance.policy_no", "ASC");
        $this->db->from('vehicle_insurance');
        $this->db->join('users', 'users.id = vehicle_insurance.user_id');
        $query = $this->db->get();
        //print_r($query->result_array());die();
        return $query->result_array();
        /*$this->db->select(array('m.id', 'm.ins_type', 'm.registration_year', 'm.make_model', 'm.fuel_type', 'm.variant'));
        $this->db->from('vehicle_insurance as m');
        $query = $this->db->get();
        return $query->result_array();*/
    }

}
?>