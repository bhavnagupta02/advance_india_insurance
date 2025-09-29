<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Helper: application/helpers/pdf_helper.php
function tcpdf()
{
    require_once('tcpdf/config/lang/eng.php');
    require_once('tcpdf/tcpdf.php');
    //print_r($InsData);
}

function pdf_template($exp_policy_data,$site_url)
{
  if(empty($exp_policy_data['first_name']) && empty($exp_policy_data['last_name'])){
    $full_name = 'N/A';
  }
  else{
    $full_name = strtoupper($exp_policy_data['first_name']." ".$exp_policy_data['last_name']);
  }
  if(empty($exp_policy_data['company_name'])){
    $exp_policy_data['company_name'] = 'N/A';
  }
  if(empty($exp_policy_data['company_gstin'])){
    $exp_policy_data['company_gstin'] = 'N/A';
  }
  if(!empty($exp_policy_data['mfg_date'])){
    $mfg_date = date("j M, Y", strtotime($exp_policy_data['mfg_date']));
  }
  if(!empty($exp_policy_data['payment_date'])){
    $payment_date = date("j F Y h:i", strtotime($exp_policy_data['payment_date'])).' hrs';
  }
  if(!empty($exp_policy_data['payment_date'])){
    $insurance_date = date("j F Y", strtotime($exp_policy_data['payment_date']));
  }
  if(!empty($exp_policy_data['policy_exp_date'])){
    $policy_exp_date = date("j F Y h:i",strtotime($exp_policy_data['policy_exp_date'])).' hrs';
  }
  /*if(isset($exp_policy_data['policy_no']) && !empty($exp_policy_data['policy_no'])){
    $policy_no = $exp_policy_data['policy_no'].'/00';
  }
  echo $policy_no;die();*/

  $content = '';
  
  if($exp_policy_data['ins_type']=='car'){

  //	$content .= '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Insurance Policy</title><link href="'.$site_url.'assets/css/pdf_style.css" rel="stylesheet" type="text/css"></head><body>';
//	$content .= '<div id="container"><div id="wrapper">';
	$content .= '<style>.header {
	width: 100%;
	float: left;
	padding:0px 0px 10px;
	margin: 0px;
}
.header .logo {
	width: 100%;
	float: left;
}
.header .logo a {
	float: left;
}
.header .logo img {
	float: left;
	margin-right:15px;
}
.header .logo h1 {
	display: inline-table;
	font-size: 20px;color: #000;font-weight: 700;line-height:20px;
}
.header .logo p {
	font-family:Arial, Helvetica, sans-serif;font-size: 13px;color: #000;font-weight: 400;line-height: 20px;
}</style><div class="header"><div class="main-row"><div class="logo"><img src="'.$site_url.'assets/images/pdf-logo.jpg" alt="" style="width:104px; height:34px"><h1 style="margin-top:120px; margin-left:120px;">LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</h1><p style="style="margin-top:90px; margin-left:120px;">Certificate of Insurance cum Policy Schedule</p></div></div></div>
	<div class="section">
	  <div class="main-row">
	    <div class="pliicy-details">
	      <div class="pliicy-left" style="width:50%; float:left">
	        <h3 style="width:50%; float:left">POLICY DETAILS</h3>
	        <ul style="width:50%; float:left">
	          <li>Insured Name: <span>'.$full_name.'</span></li>
	          <!-- <li>Address: <span>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_address_line2'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].'</span></li> -->
	          <li>Pincode: <span>'.$exp_policy_data['primary_pin_code'].'</span></li>
	          <li>Company Name: <span>'.$exp_policy_data['company_name'].'</span></li>
	          <li>GSTIN: <span>'.$exp_policy_data['company_gstin'].'</span></li>
	          
	          <li>Period of Insurance: <span>'.$payment_date.' to '.$policy_exp_date.'</span></li>
	          <!--<li>Period of Insurance: <span>01 March 20 00:00 hrs to 28 Feb 21 23:59 hrs</span></li>-->
	          <li>Policy Insurance Date:<span> '.$insurance_date.'</span></li>
	          <li>Policy Number: <span>'.$exp_policy_data['policy_no'].'/00</span></li>
	          <!--<li>Previous Pliicy Expiry Date:<span>N/A</span></li>-->
	        </ul>
	      </div>
	      <div class="pliicy-center">
	        <h3 style="width:50%; float:left">VEHICLE DETAILS</h3>
	        <ul style="width:50%; float:left">
	          <li>Registration Number:<span>'.$exp_policy_data['vehicle_registration_no'].'</span></li>
	          <li>Make/Model:<span>'.$exp_policy_data['make_model'].'</span></li>
	          <!-- <li>Manufacturing Year:<span>'.$mfg_date.'</span></li> -->
	          <li>Fuel Type: <span>'.$exp_policy_data['fuel_type'].'</span></li>
	          <li>Purchase Year: <span>'.$exp_policy_data['registration_year'].'</span></li>
	          <li>Engine No:<span>'.$exp_policy_data['engine_no'].'</span></li>
	          <li>Chassis No:<span>'.$exp_policy_data['chassis_no'].'</span></li>
	        </ul>
	      </div>
	      <div class="pliicy-right"><img src="'.$site_url.'assets/images/scan.jpg" alt=""></div>
	    </div>
	  </div>
	</div>';
	/*$content .='<div class="section">
	<div class="main-row"><div class="premium-details"><h2>PREMIUM DETAILS (₹)</h2><table border="0" cellpadding="0" cellspacing="0"><thead><tr><th>Premium Breakup</th></tr></thead><tbody><tr><td>Basic Third Party Liability</td><td>'.$exp_policy_data['basic_amount'].'</td></tr><tr><td><strong>Net Liability Premium (B)</strong></td><td><strong>'.$exp_policy_data['basic_amount'].'</strong></td></tr><tr><td>GST (18%)</td><td>'.$exp_policy_data['gst_amount'].' </td><tr><td><strong>Total Premium</strong></td><td><strong>'.$exp_policy_data['total_amount'].'</strong></td></tr> </table><ul><li>Geographical Area: <span>India </span></li><li>Compulsory Deductible: <span>₹ 0</span></li><li>Vliuntary Deductible:<span> ₹ 0</span> </li><li>No-Claim Bonus:<span> 0 %</span></li><li>Hypothecation:<span> None</span></li></ul></div></div></div>';*/
	$content .='<div class="section">
	  <div class="main-row">
	    <div class="premium-details">
	      <h2>PREMIUM DETAILS (₹)</h2><div class="tabldetails">
	      <div><ul>
	      <li>Premium Breakup</li>
	      <li>Basic Third Party Liability
	      <span>'.$exp_policy_data['basic_amount'].'</span></li>
	      <li>
		      <sliong>Net Liability Premium (B)</sliong></span>
		      <span><sliong>'.$exp_policy_data['basic_amount'].'</sliong></span>
		    </li>
		    <li>
		      IGST (18%)
		      <span>'.$exp_policy_data['gst_amount'].' </span>
		    <li>
		      <sliong>Total Premium</sliong>
		      <span><sliong>'.$exp_policy_data['total_amount'].'</sliong></span>
		    </li>
	      </ul></div>
	      </div>
	      <ul>
	        <li>Geographical Area: <span>India </span></li>
	      </ul>
	    </div>
	  </div>
	</div>';
	$content .='<div class="section">
	  <div class="main-row">
	    <div class="Limitations-details">
	      <div class="Limitations">
	      	<p><strong>Please Note:</strong>In case of a claim event arising within 30 days from the start of this Policy, the Insured is required to submit a copy of his Previous Insurance Policy.</p>
	        <p><strong>Limitations As To Use:</strong> The Policy covers use only under a permit within the meaning of the Motor Vehicle Act (M V Act) 1988 or such a carriage falling under Sub-Section (3) of Section 66 of the Motor Vehicle’s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person (including the insured), provided that a person driving holds a valid driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the person holding a valid learner’s license may also drive the vehicle when not used for the transport of passengers at the time of accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules, 1989. <strong>Limits of Liability.</strong> 1. Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles Act, 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner - Driver(CSI): Rs. 0.0 <strong>Terms, Conditions & Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost on request & the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days of the Acko Policy Start Date.</p>
	        <p>I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the provision of chapter X, XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide GRAS Deface no. 0004976826201920 dated 19/12/2019 as prescribed in Government Notification Revenue & Forest Department No. Mudrank - 2017/C.R.97/M-1, dated 09/01/2018 . GSTN: 27AAOCA9055C1ZJ. <strong>IMPORTANT NOTICE:</strong> The Insured is not indemnified if the vehicle is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms appearing in the Certificate in order to comply with the Motor Vehicle Act, 1988 is recoverable from the Insured. See the clause headed "AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY” in the policy wordings. <strong>Disclaimer</strong>: The Policy shall be void from inception if the premium cheque is not realized. In the event of misrepresentation, fraud or non-disclosure of material fact, the Company reserves the right to cancel the Policy. The policy is issued basis the information provided by you, which is available with the company. In case of discrepancy/non recording of relevant information in the policy, the insured is requested to bring the same to the notice of the company within 15 days. This Policy is to be read in conjunction with the Policy wordings <a href="#">(https://www.acko.com/download)</a> available on the website of the Company. On renewal, the benefits provided under the policy and/or terms and conditions of the policy including premium rate may be subject to change.</p>
	      </div>
	      
	    </div>
	  </div>
	</div>';
	$content .='<div class="section">
	  <div class="main-row">
	    <div class="intermediary-details">
	      <h2>INTERMEDIARY DETAILS</h2>
	      <div class="intermediary-top">
	        <!-- <ul>
	          <li class="Name">Name</li>
	          <li class="Code">Code</li>
	          <li class="Contact">Contact</li>
	          <li class="Email">Email</li>
	          <li class="Address">Address</li>
	        </ul> -->
	        <ul>
	          <li class="Name">Name: Advance india insurance broker Pvt limited</li>
	          <li class="Code">Code: 131362</li>
	          <li class="Contact">Contact: +917551196988</li>
	          <li class="Email">Email: <a href="#">support@info.cvom</a></li>
	          <li class="Address">Address: Plot No.49, 3rd Floor, Gurgaon, Haryana 122004</li>
	        </ul>
	      </div>
	      <!-- <div class="intermediary-bottom">
	        <ul>
	          <li class="Name">POS Name</li>
	          <li class="Contact">POS Contact</li>
	          <li class="POS">POS ID NO</li>
	        </ul>
	      </div> -->
	    </div>
	  </div>
	</div>';
		$content .='<div class="section">
	  <div class="main-row">
	    <div class="Insurance-details">
	      <div class="Insurance-left">
	        <h2>Acko General Insurance Ltd.</h2>
	        <p>Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</p>
	        <p>Goregaon (E), Mumbai – 400063.</p>
	        <p> Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </p>
	        <p>CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 |
	        <p>UIN: IRDAN157P0002V01201718</p>
	      </div>
	      <div class="Insurance-right">
	        <!--<div class="badge"><img src="'.$site_url.'assets/images/acko-badge.jpg" alt=""></div>-->
	        <div class="sign"><img src="'.$site_url.'assets/images/sign.jpg" alt="">
	          <p>For Acko General Insurance Ltd. Duly Constituted Attorney</p>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>';
//	$content .='</div></div></body></html>'; //Close Wrapper & Container div here	
  }
  else{
  	/*$content .='<style>.header .logo h1 {
      display: inline-table;
      font-size: 20px;
      clior: red;
      font-weight: 700;
  	  line-height:20px;
  	  }</style>';*/
	  //$content .= '<style>'.file_get_contents($site_url.'assets/css/pdf_style.css').'</style>';
	  //$content .= '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Insurance Policy</title><link href="'.$site_url.'assets/css/pdf_style.css" rel="stylesheet" type="text/css"></head><body>';
	 // $content .= '<div id="container"><div id="wrapper">';
	  $content .= '<style>.header {
	width: 100%;
	float: left;
	padding:0px 0px 10px;
	margin: 0px;
}
.header .logo {
	width: 100%;
	float: left;
}
.header .logo a {
	float: left;
}
.header .logo img {
	float: left;
	margin-right:15px;
}
.header .logo h1 {
	display: inline-table;
	font-size: 20px;color: #000;font-weight: 700;line-height:20px;
}
.header .logo p {
	font-family:Arial, Helvetica, sans-serif;font-size: 13px;color: #000;font-weight: 400;line-height: 20px;
}</style><div class="header"><div class="main-row"><div class="logo"><a href="#"> <img src="'.$site_url.'assets/images/pdf-logo.jpg" alt=""></a><h1>LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</h1><p>Certificate of Insurance cum Policy Schedule</p></div></div></div>
	  <div class="section">
	      <div class="main-row">
	        <div class="pliicy-details">
	          <div class="pliicy-left">
	            <h3>POLICY DETAILS</h3>
	            <ul>
	              <li>Insured Name: <span>'.$full_name.'</span></li>
	              <li>Address: <span>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_address_line2'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].'</span></li>
	              <li>Pincode: <span>'.$exp_policy_data['primary_pin_code'].'</span></li>
	              <li>Company Name: <span>'.$exp_policy_data['company_name'].'</span></li>
	              <li>GSTIN: <span>'.$exp_policy_data['company_gstin'].'</span></li>
	              
	              <li>Period of Insurance: <span>'.$payment_date.' to '.$policy_exp_date.'</span></li>
	              <!--<li>Period of Insurance: <span>01 March 20 00:00 hrs to 28 Feb 21 23:59 hrs</span></li>-->
	              <li>Policy Insurance Date:<span> '.$insurance_date.'</span></li>
	              <li>Policy Number: <span>'.$exp_policy_data['policy_no'].'/00</span></li>
	              <li>Nominee:<span>'.$exp_policy_data['nominee_name'].', '.$exp_policy_data['nominee_relation'].', '.$exp_policy_data['nominee_age'].'</span></li>
	              <li>Owner Number:<span>'.$exp_policy_data['phone_no'].'</span></li>
	              <!--<li>Previous Pliicy Expiry Date:<span>N/A</span></li>-->
	            </ul>
	          </div>
	          <div class="pliicy-center">
	            <h3>VEHICLE DETAILS</h3>
	            <ul>
	              <li>Registration Number:<span>'.$exp_policy_data['vehicle_registration_no'].'</span></li>
	              <li>Make/Model:<span>'.$exp_policy_data['make_model'].'</span></li>
	              <li>Registration Year: <span>'.$exp_policy_data['registration_year'].'</span></li>
	              <li>Manufacturing Year:<span>'.$mfg_date.'</span></li>
	              <li>Fuel Type: <span>'.$exp_policy_data['fuel_type'].'</span></li>
	              <li>Engine No:<span>'.$exp_policy_data['engine_no'].'</span></li>
	              <li>Chassis No:<span>'.$exp_policy_data['chassis_no'].'</span></li>
	            </ul>
	          </div>
	          <div class="pliicy-right"><img src="'.$site_url.'assets/images/scan.jpg" alt=""></div>
	        </div>
	      </div>
	  </div>';
	  /*$content .='<div class="section">
	  <div class="main-row"><div class="premium-details"><h2>PREMIUM DETAILS (₹)</h2><table border="0" cellpadding="0" cellspacing="0"><thead><tr><th>Liability Premium (B)</th></tr></thead><tbody><tr><td>Basic Third Party Liability</td><td>'.$exp_policy_data['basic_amount'].'</td></tr><tr><td><strong>Net Liability Premium (B)</strong></td><td><strong>'.$exp_policy_data['basic_amount'].'</strong></td></tr><tr><td>IGST (18%)</td><td>'.$exp_policy_data['gst_amount'].' </td><tr><td><strong>Total Premium</strong></td><td><strong>'.$exp_policy_data['total_amount'].'</strong></td></tr> </table><ul><li>Geographical Area: <span>India </span></li><li>Compulsory Deductible: <span>₹ 0</span></li><li>Vliuntary Deductible:<span> ₹ 0</span> </li><li>No-Claim Bonus:<span> 0 %</span></li><li>Hypothecation:<span> None</span></li></ul></div></div></div>';*/
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="premium-details">
	          <h2>PREMIUM DETAILS (₹)</h2><div class="tabldetails">
	          <div><ul>
	          <li>Liability Premium (B)</li>
	          <li>Basic Third Party Liability
	          <span>'.$exp_policy_data['basic_amount'].'</span></li>
	          <li>
	  	      <sliong>Net Liability Premium (B)</sliong></span>
	  	      <span><sliong>'.$exp_policy_data['basic_amount'].'</sliong></span>
	  	    </li>
	  	    <li>
	  	      IGST (18%)
	  	      <span>'.$exp_policy_data['gst_amount'].' </span>
	  	    <li>
	  	      <sliong>Total Premium</sliong>
	  	      <span><sliong>'.$exp_policy_data['total_amount'].'</sliong></span>
	  	    </li>
	          </ul></div>
	          </div>
	          <ul>
	            <li>Geographical Area: <span>India </span></li>
	            <li>Compulsory Deductible: <span>₹ 0</span></li>
	            <li>Vliuntary Deductible:<span> ₹ 0</span> </li>
	            <li>No-Claim Bonus:<span> 0 %</span></li>
	            <li>Hypothecation:<span> None</span></li>
	          </ul>
	        </div>
	      </div>
	  </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="intermediary-details">
	          <h2>INTERMEDIARY DETAILS</h2>
	          <div class="intermediary-top">
	            <ul>
	              <li class="Name">Name</li>
	              <li class="Code">Code</li>
	              <li class="Contact">Contact</li>
	              <li class="Email">Email</li>
	              <li class="Address">Address</li>
	            </ul>
	            <ul>
	              <li class="Name">Advance india insurance broker Pvt limited</li>
	              <li class="Code">131362</li>
	              <li class="Contact">+917551196988</li>
	              <li class="Email"><a href="#">support@info.cvom</a></li>
	              <li class="Address">Plot No.49, 3rd Floor, Gurgaon, Haryana 122004</li>
	            </ul>
	          </div>
	          <div class="intermediary-bottom">
	            <ul>
	              <li class="Name">POS Name</li>
	              <li class="Contact">POS Contact</li>
	              <li class="POS">POS ID NO</li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="Insurance-details">
	          <div class="Insurance-left">
	            <h2>Acko General Insurance Ltd.</h2>
	            <p>Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</p>
	            <p>Goregaon (E), Mumbai – 400063.</p>
	            <p> Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </p>
	            <p>CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 |
	            <p>UIN: IRDAN157P0002V01201718</p>
	          </div>
	          <div class="Insurance-right">
	            <div class="badge"><img src="'.$site_url.'assets/images/acko-badge.jpg" alt=""></div>
	            <div class="sign"><img src="'.$site_url.'assets/images/sign.jpg" alt="">
	              <p>For Acko General Insurance Ltd. Duly Constituted Attorney</p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="Limitations-details">
	          <div class="Limitations">
	            <p><strong>Limitations As To Use:</strong> The Policy covers use only under a permit within the meaning of the Motor Vehicle Act (M V Act) 1988 or such a carriage falling under Sub-Section (3) of Section 66 of the Motor Vehicle’s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person (including the insured), provided that a person driving holds a valid driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the person holding a valid learner’s license may also drive the vehicle when not used for the transport of passengers at the time of accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules, 1989. <strong>Limits of Liability.</strong> 1. Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles Act, 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner - Driver(CSI): Rs. 0.0 <strong>Terms, Conditions & Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost on request & the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days of the Acko Policy Start Date.</p>
	            <p>I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the provision of chapter X, XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide GRAS Deface no. 0004976826201920 dated 19/12/2019 as prescribed in Government Notification Revenue & Forest Department No. Mudrank - 2017/C.R.97/M-1, dated 09/01/2018 . GSTN: 27AAOCA9055C1ZJ. <strong>IMPORTANT NOTICE:</strong> The Insured is not indemnified if the vehicle is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms appearing in the Certificate in order to comply with the Motor Vehicle Act, 1988 is recoverable from the Insured. See the clause headed "AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY” in the policy wordings. <strong>Disclaimer</strong>: The Policy shall be void from inception if the premium cheque is not realized. In the event of misrepresentation, fraud or non-disclosure of material fact, the Company reserves the right to cancel the Policy. The policy is issued basis the information provided by you, which is available with the company. In case of discrepancy/non recording of relevant information in the policy, the insured is requested to bring the same to the notice of the company within 15 days. This Policy is to be read in conjunction with the Policy wordings <a href="#">(https://www.acko.com/download)</a> available on the website of the Company. On renewal, the benefits provided under the policy and/or terms and conditions of the policy including premium rate may be subject to change.</p>
	          </div>
	          <div class="Insurance-left">
	            <h2>Acko General Insurance Ltd.</h2>
	            <p>Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</p>
	            <p>Goregaon (E), Mumbai – 400063.</p>
	            <p> Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </p>
	            <p>CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 |
	            <p>UIN: IRDAN157P0002V01201718</p>
	          </div>
	          <div class="Insurance-right">
	            <div class="sign"><img src="'.$site_url.'assets/images/sign.jpg" alt="">
	              <p>For Acko General Insurance Ltd. Duly Constituted Attorney</p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="premium-header">
	      <div class="main-row">
	        <div class="logo"><a href="#"> <img src="'.$site_url.'assets/images/logo.jpg" alt="">
	          <h1>PREMIUM RECEIPT</h1>
	          </a></div>
	        <div class="premium-section">
	          <p>Receieved with thanks from '.$full_name.' a sum of ₹ '.$exp_policy_data['total_amount'].' towards premium on '.strtoupper($exp_policy_data['ins_type']).' Insurance Policy</p>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="policy-details">
	          <div class="policy-left"  style="width:48%;">
	            <h3>INSURED DETAILS</h3>
	            <ul>
	              <li>Name of Insured: <span>'.$full_name.'</span></li>
	              <li>Address: <span>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_address_line2'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].'</span></li>
	              <li>Company Name: <span>'.$exp_policy_data['company_name'].'</span></li>
	              <li>GST: <span>'.$exp_policy_data['company_gstin'].'</span></li>
	              <li>Period of Insurance: <span>'.$payment_date.' to '.$policy_exp_date.'</span></li>
	              <li>Policy Number: <span>'.$exp_policy_data['policy_no'].'/00</span></li>
	            </ul>
	          </div>
	          <div class="policy-center" style="width:48%;">
	            <h3>INTERMEDIARY DETAILS</h3>
	            <ul>
	              <li>Name: <span>Advance india insurance broker Pvt limited</span></li>
	              <li>Code: <span>131362</span></li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="premium-details">
	          <h2>PREMIUM DETAILS (₹)</h2>
	          <div border="0" cellpadding="0" cellspacing="0">
	              <ul>
	                <li>Net Premium <span>'.$exp_policy_data['basic_amount'].'</span></li>
	                <li>IGST (18%) <span>'.$exp_policy_data['gst_amount'].'</span></li>
	                <li><strong>Total Premium '.$exp_policy_data['total_amount'].'</strong></li>
	              </ul>
	          </div>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="Trems-details">
	          <h2>TERMS & CONDITIONS</h2>
	          <p>Issuance of this receipt does not amount to acceptance of the risk by Acko General Insurance Limited. The insurance cover for the risk shall be as per the terms and conditions of the Insurance Policy if and when issued. Cheque/DD/PO receipt is valid subject to the realization of the instrument.</p>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="Limitations-details">
	          <div class="Insurance-left">
	            <h2>Acko General Insurance Ltd.</h2>
	            <p>Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</p>
	            <p>Goregaon (E), Mumbai – 400063.</p>
	            <p> Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </p>
	            <p>CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </p>
	            <p>UIN: IRDAN157P0002V01201718</p>
	          </div>
	          <div class="Insurance-right">
	            <div class="sign"><img src="'.$site_url.'assets/images/sign.jpg" alt="">
	              <p>For Acko General Insurance Ltd. Duly Constituted Attorney</p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="premium-header">
	      <div class="main-row">
	        <div class="logo"><a href="#"> <img src="images/logo.jpg" alt="">
	          <h1>PROPOSAL FORM</h1>
	          </a></div>
	        <div class="premium-section">
	          <h6>Dear '.$full_name.',</h6>
	          <h6>We wish to inform you that the Insurance policy number '.$exp_policy_data['policy_no'].'/00 has been issued on the basis of the information and declaration given by you, the transcript whereof is mentioned below.</h6>
	          <p>Please be informed that this Policy shall be construed to be void ab initio/invalid in the event we find that you have not disclosed material or correct information required for the purpose of providing the below insurance cover and in case of any claim arising under the policy in such a scenario, we shall be under no obligation whatsoever to settle such claim to you and the premium paid by you under this policy shall stand fully forfeited.</p>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="policy-details">
	          <div class="policy-left"  style="width:48%;">
	            <h3>POLICY DETAILS</h3>
	            <ul>
	              <li>Policy Number: <span>'.$exp_policy_data['policy_no'].'/00</span></li>
	              <li>Period of Insurance: <span>'.$payment_date.' to '.$policy_exp_date.'</span></li>
	              <li>Policy Insurance Date:<span> '.$insurance_date.'</span></li>
	            </ul>
	          </div>
	          <div class="policy-center" style="width:48%;">
	            <h3>BIKE DETAILS</h3>
	            <ul>
	              <li>Bike Number: <span>'.$exp_policy_data['vehicle_registration_no'].'</span></li>
	              <li>Make/Model: <span>'.$exp_policy_data['make_model'].'</span></li>
	              <li>Fuel Type: <span>'.$exp_policy_data['fuel_type'].'</span></li>
	              <li>Registration Year: <span>'.$exp_policy_data['registration_year'].'</span></li>
	              <li>Manufacturing Year: <span>'.$mfg_date.'</span></li>
	              <li>Insured Declared Value (IDV): <span>N/A</span></li>
	              <li>Accessories (IDV):<span>0</span></li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="policy-details">
	          <div class="policy-left"  style="width:48%;">
	            <h3>BIKE OWNER DETAILS</h3>
	            <ul>
	              <li>Name: <span>'.$full_name.'</span></li>
	              <li>Email Address: <span>'.$exp_policy_data['email'].'</span></li>
	              <li>Mobile Number:<span>'.$exp_policy_data['phone_no'].'</span></li>
	              <li>Pincode:<span>'.$exp_policy_data['primary_pin_code'].'</span></li>
	            </ul>
	          </div>
	          <div class="policy-center" style="width:48%;">
	            <h3>NOMINEE DETAILS</h3>
	            <ul>
	              <li>Name: <span>'.$exp_policy_data['nominee_name'].'</span></li>
	              <li>Relationship with Insured:<span>'.$exp_policy_data['nominee_relation'].'</span></li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>';
	  $content .='<div class="section">
	      <div class="main-row">
	        <div class="Prohibition-details">
	          <p>"I/We hereby declare that the statements made by me/us in this proposal form are true to the best of my knowledge and belief and I/We hereby agree that this declaration shall form the basis of the contract between me/us and Acko General Insurance Ltd. I/We agree and undertake to convey to Acko General Insurance Limited any change / alterations carried out in the risk proposed for insurance after submission of this proposal form. I/we hereby declare that the contents of the form have been fully explained to me/us and that I/we have fully understood the significance of the proposed contract.</p>
	          <p><strong>Prohibition of Rebated (Section 41) of the Insurance Act - 1938 (as amended)</strong> 1. No person shall allow or offer to allow, either directly or indirectly as an inducement to any person to take out or renew or continue and insurance in respect of any kind or risk relating to lives or property in India, any rebate of the whole or part of the commission payable or any rebate of the premium shown on the policy, nor shall any person taking out or renewing or continuing a policy accept any rebate expect such rebate as may be allowed in accordance with the prospectus or tables of the Insurer. <br />
	            2. Any person making default in complying with the provisions of this section shall be liable for a penalty which may extend to 10 lakh rupees."</p>
	          <div class="Prohibition-sign">
	            <div class="Insurance-left">
	              <h2>Acko General Insurance Ltd.</h2>
	              <p>Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</p>
	              <p>Goregaon (E), Mumbai – 400063.</p>
	              <p> Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </p>
	              <p>CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </p>
	              <p>UIN: IRDAN157P0002V01201718</p>
	            </div>
	            <div class="Insurance-right">
	              <div class="sign"><img src="'.$site_url.'assets/images/sign.jpg" alt="">
	                <p>For Acko General Insurance Ltd. Duly Constituted Attorney</p>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>';
	  //$content .='</div></div></body></html>'; //Close Wrapper & Container div here
  }
  
  return $content;
}
?>
