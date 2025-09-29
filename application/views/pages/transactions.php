<div class="Transactions">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 heading-wrap">
        <h1 style="text-align: center;">All Insurance Transactions</h1>
      </div>
    </div>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 table-section">
      <table class="table table-bordered table-hover" id="DataTable">
        <thead>
          <tr>
            <th>Sr. No.</th>
            <th>Policy No.</th>
            <th>Vehicle Type</th>
            <th>Vehicle Details</th>
            <th>Policy Holder</th>
            <th>Nominee Details</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php //print_r($ins_policy_data);
          $i = 1;
          foreach($ins_policy_data as $val){?>
          <tr id="<?php echo $val['id'];?>">
            <td><?php echo $i;?></td>
            <td><?php if(isset($val['policy_no']) && !empty($val['policy_no'])){ echo $val['policy_no'].'/00';} ?></td>
            <td><?php if(isset($val['ins_type'])){ echo ucwords($val['ins_type']);} ?></td>
            <td>
              <div class="policy_holderdtls">
                <span><?php if(isset($val['make_model']) && isset($val['variant'])){ echo "<strong>Model:</strong>"." ".ucwords($val['make_model']." ".$val['variant']);}?></span>
                <span><?php if(isset($val['vehicle_registration_no'])){ echo "<strong>Registration No:</strong>"." ".$val['vehicle_registration_no'];}?></span>
              </div>
            </td>
            <td>
              <div class="policy_holderdtls"><span><?php if((isset($val['first_name']) && !empty($val['first_name'])) || (isset($val['last_name']) && !empty($val['last_name']))){ echo "<strong>Name:</strong>"." ".ucwords($val['first_name']." ".$val['last_name']);}?></span>
                <span><?php if(isset($val['company_name']) && !empty($val['company_name'])){echo "<strong>Company Name:</strong>"." ".$val['company_name'];} ?></span>
                <span><?php if(isset($val['company_gstin']) && !empty($val['company_gstin'])){echo "<strong>GSTIN:</strong>"." ".$val['company_gstin'];} ?></span>
                <span><?php if(isset($val['email'])){echo "<strong>Email:</strong>"." ".$val['email'];} ?></span>
                <span><?php if(isset($val['phone_no'])){echo "<strong>Mobile:</strong>"." ".$val['phone_no'];} ?></span>
              </div>
            </td>
            <td><div class="policy_holderdtls"><span><?php if(isset($val['nominee_name'])){ echo "<strong>Name:</strong>"." ".ucwords($val['nominee_name']);}?></span>
                <span><?php if(isset($val['nominee_relation'])){echo "<strong>Relation:</strong>"." ".$val['nominee_relation'];} ?></span>
                <span><?php if(isset($val['nominee_age'])){echo "<strong>Age:</strong>"." ".$val['nominee_age'];} ?></span>
              </div>
            </td>
            <td><a href="<?php if(isset($val['insurance_pdf_file'])){ echo base_url($val['insurance_pdf_file']);} ?>" download="<?php if(isset($val['insurance_pdf_file'])){ $file=explode('/', $val['insurance_pdf_file']); echo $file['2'];} ?>" title="Download your policy">Download pdf</a></td>
          </tr>
          <?php $i++; }?>
        </tbody>
        
      </table>
    </div>
  </div>
  </div>
</div>