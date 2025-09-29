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
  /*if(empty($exp_policy_data['first_name']) && empty($exp_policy_data['last_name'])){
    $full_name = 'N/A';
  }
  else{
    $full_name = strtoupper($exp_policy_data['first_name']." ".$exp_policy_data['last_name']);
  }*/
  
  if((isset($exp_policy_data['first_name']) && !empty($exp_policy_data['first_name'])) || (isset($exp_policy_data['last_name']) && !empty($exp_policy_data['last_name']))){
      $full_name = strtoupper($exp_policy_data['first_name']." ".$exp_policy_data['last_name']);
  }
  
  if(isset($exp_policy_data['company_name']) && !empty($exp_policy_data['company_name'])){
      $full_name = strtoupper($exp_policy_data['company_name']);
  }
  //echo $full_name; die();
  
  if(empty($exp_policy_data['company_gstin'])){
    $exp_policy_data['company_gstin'] = 'N/A';
  }
  
  if(!empty($exp_policy_data['mfg_date'])){
    $mfg_date = date("Y", strtotime($exp_policy_data['mfg_date']));
  }
  
  if($exp_policy_data['ins_type']=='car'){
      if(!empty($exp_policy_data['payment_date'])){
        $payment_date = date("j M y (00:00", strtotime($exp_policy_data['payment_date'])).' hrs)';
      }
      if(!empty($exp_policy_data['policy_exp_date'])){
        $policy_exp_date = date("j M y (23:59",strtotime($exp_policy_data['policy_exp_date'])).' hrs)';
      }
  }
  else{
      if(!empty($exp_policy_data['payment_date'])){
        $payment_date = date("j M y 00:00", strtotime($exp_policy_data['payment_date'])).' hrs';
      }
      if(!empty($exp_policy_data['policy_exp_date'])){
        $policy_exp_date = date("j M y 23:59",strtotime($exp_policy_data['policy_exp_date'])).' hrs';
      }
  }
  
  if(!empty($exp_policy_data['payment_date'])){
    $insurance_date = date("j M y", strtotime($exp_policy_data['payment_date']));
  }
  
  if(isset($exp_policy_data['policy_no']) && !empty($exp_policy_data['policy_no'])){
    $policy_no = $exp_policy_data['policy_no'].'/00';
  }
  else{
    $policy_no = 'N/A';
  }
  
  if(!empty($exp_policy_data['qr_image'])){
    $qrcode_img = $site_url.$exp_policy_data['qr_image'];
  }
  
  if(!empty($exp_policy_data['financial_company_name'])){
    $financial_company = $exp_policy_data['financial_company_name'];
  }
  else{
    $financial_company = 'None';
  }

  $content = '';
  
  if($exp_policy_data['ins_type']=='car'){

  	$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td width="120" ><span style="line-height:24px">&nbsp;</span><br /><img style="width:90px;vertical-align: middle;" src="'.$site_url.'assets/images/logo.jpg" alt=""  align="middle"></td>
  <td  width="460" style="font-family:helvetica ;font-size: 15px;color: #000;font-weight: bold;line-height:18px;"><span ><br />LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</span><br />
  <span style="font-family: Helvetica, sans-serif;font-size: 11px;color: #8c8c8c;font-weight: normal;line-height:16px;">Certificate of Insurance cum Policy Schedule</span></td>
   <td rowspan="2" align="right" width="100" ><img style="width:70px;" align="right" src="'.$qrcode_img.'" alt=""></td>
 </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0px"><tr><td style="line-height:10px">&nbsp;</td></tr></table>';
$content .= '
<Style>
.section-vehicle td{
font-size: 10px;
color:#000;
font-family: helvetica ;
font-weight:normal;
line-height:20px;
text-align:left;
}
</style><table class="section-vehicle" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr >
 <td width="360" style="font-weight:bold; line-height: 24px;padding-bottom: 4px;font-size:13px;border-bottom:2px solid #000">POLICY DETAILS</td>
 <td width="20">&nbsp;</td>
 <td width="300" style="position:relative; right:0px float:right;font-weight:bold; font-family: helvetica ;line-height: 24px;font-size:13px;border-bottom:2px solid #000">VEHICLE DETAILS</td>

</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0px"><tr><td style="line-height:5px">&nbsp;</td></tr></table>';
$content .= '
<style>
.section-Registration td{
font-size:9.5px;
color:#000;
font-family: helvetica ;
font-weight:normal;
line-height:16px;
text-align:left;
}
</style><table width="800" class="section-Registration" cellpadding="0" cellspacing="0" width="100%" border="0" >
<tr>
  <td width="110">Insured Name: </td>
  <td style="color:#000;font-weight:bold; " width="250">'.$full_name.'</td>
  <td width="20">&nbsp;</td>
  <td width="110">Registration Number:</td>
  <td style="color:#000;font-weight:bold; " width="220">'.$exp_policy_data['vehicle_registration_no'].'</td>
</tr>
<tr>
  <td width="110">Pincode: </td>
  <td style="color:#000;font-weight:bold; " width="250">'.$exp_policy_data['primary_pin_code'].' </td>
  <td width="20">&nbsp;</td>
  <td width="110">Make/Model:</td>
  <td style="color:#000;font-weight:bold; " width="220">'.$exp_policy_data['make_model'].' </td>
</tr>
<tr>
<td width="110">GSTIN: </td>
  <td style="color:#000;font-weight:bold; " width="250">'.$exp_policy_data['company_gstin'].'</td>
  
  <td width="20">&nbsp;</td>
  <td width="110">Purchase Year: </td>
  <td style="color:#000;font-weight:bold; " width="220">'.$exp_policy_data['registration_year'].' </td>
</tr>
<tr>
  <td width="110">Period of Insurance: </td>
  <td style="color:#000;font-weight:bold; " width="250">'.$payment_date.' to '.$policy_exp_date.' </td>
  <td width="20">&nbsp;</td>
  <td width="110">Fuel Type: </td>
  <td style="color:#000;font-weight:bold; " width="250">'.$exp_policy_data['fuel_type'].' </td>
</tr>
<tr>
  <td  width="110">Policy Issuance Date:</td>
  <td style="color:#000;font-weight:bold; " width="250">'.$insurance_date.'</td>
  <td width="20">&nbsp;</td>
  <td width="110">Engine No: </td>
  <td style="color:#000;font-weight:bold; " width="220">'.strtoupper($exp_policy_data['engine_no']).'</td>
</tr>
<tr>
<td width="110">Policy Number: </td>
<td style="color:#000;font-weight:bold; " width="250">'.$policy_no.'</td>
<td width="20">&nbsp;</td>
<td width="110">Chassis No:</td>
<td style="color:#000;font-weight:bold; " width="220">'.strtoupper($exp_policy_data['chassis_no']).'</td>
</tr>

</table>';
$content .= '<table class="first"  cellpadding="14" cellspacing="14" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-pre-details td {
    font-family: helvetica ;
    font-size: 13px;
    line-height:24px;
    border-bottom:2px solid #000;
    font-weight:bold; 
}
</style>
<table class="section-pre-details" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="680">PREMIUM DETAILS (<span style="font-family:dejavusans;">&#8377;</span>)</td>
</tr>
</table>';
$content .= '<table class="first" cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:9px">&nbsp;</td></tr></table>';
$content .= '<style>
table.section-premium td {
    border-bottom: 1px solid #d3d3d3;
    text-align:right;
    padding:15px;
    font-family: helvetica ;
    font-size: 12px;
    line-height:30px;
    color:#000;
}

</style>
<table width="680" class="section-premium"  cellpadding="0" cellspacing="0" width="100%" border="0" style="border: 1px solid #d3d3d3; border-top:none">
<tr>
  <td width="680" bgcolor="#dddddd" style="text-align:left;border:none !important; color:#000;"> &nbsp; <strong>Premium Breakup</strong></td>
</tr>
<tr>
  <td width="340" style="text-align:left; "> &nbsp; Basic Third Party Liability </td>
  <td width="340"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['basic_amount'].'  &nbsp; &nbsp; </td>
</tr>
<tr>
  <td width="340" style="text-align:left; color:#000;"> &nbsp; Net Liability Premium (B) </td>
  <td width="340" style="color:#000;"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['basic_amount'].'  &nbsp; &nbsp; </td>
</tr>
<tr>
  <td width="340" style="text-align:left;"> &nbsp; IGST (18%) </td>
  <td width="340"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['gst_amount'].' &nbsp; &nbsp;  </td>
</tr>
<tr>
  <td width="340" style="text-align:left; color:#000; border:none"> &nbsp; Total Premium </td>
  <td width="340" style=" border:none; color:#000;"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['total_amount'].'  &nbsp; &nbsp; </td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:6px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Deductible td {
        font-family: helvetica ;
        font-size: 10px;
        line-height:20px;
		font-weight:normal;
		color:#000;
    }
    </style><table class="section-Deductible" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="115">Geographical Area: </td>
  <td width="115"><strong>India</strong> </td>
  <td width="115">Hypothecation:</td>
  <td width="115" style="font-family:helvetica; font-weight:bold;">'.$financial_company.'</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="25" cellspacing="25" border="0"><tr><td style="line-height:10px">&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        color:#000;
        font-family: helvetica ;
        line-height:10px;
    }
    </style>
<table class="section-note" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="680" style="font-size: 7.5px;"><strong>Please Note:</strong>In case of a claim event arising within 30 days from the start of this Policy&cedil; the Insured is required to submit a copy of his Previous Insurance Policy.</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:10px">&nbsp;</td></tr></table>';
$content .='<table class="section-note" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="680" style="font-size: 7.5px;"><strong>Limitations As To Use:</strong> The Policy covers use only under a permit within the meaning of the Motor Vehicle Act (M V Act) 1988 or such a carriage falling under Sub-Section (3) of Section 66 of the Motor Vehicle&acute;s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person (including the insured)&cedil; provided that a person driving holds a valid driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the person holding a valid learner&acute;s license may also drive the vehicle when not used for the transport of passengers at the time of accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules&cedil; 1989. <strong>Limits of Liability.</strong> 1. Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles Act&cedil; 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner - Driver(CSI): Rs. 0.0 <strong>Terms&cedil; Conditions & Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost on request & the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days of the Acko Policy Start Date.</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:10px">&nbsp;</td></tr></table>';
$content .='<table class="section-note" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="680" style="font-size: 7.5px;">I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the provision of chapter X&cedil; XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide GRAS Deface no. 0004976826201920 dated 19/12/2019 as prescribed in Government Notification Revenue & Forest Department No. Mudrank - 2017/C.R.97/M-1&cedil; dated 09/01/2018 . GSTN: 27AAOCA9055C1ZJ. <strong>IMPORTANT NOTICE:</strong> The Insured is not indemnified if the vehicle is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms appearing in the Certificate in order to comply with the Motor Vehicle Act&cedil; 1988 is recoverable from the Insured. See the clause headed "AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY" in the policy wordings. <strong>Disclaimer</strong>: The Policy shall be void from inception if the premium cheque is not realized. In the event of misrepresentation&cedil; fraud or non-disclosure of material fact&cedil; the Company reserves the right to cancel the Policy. The policy is issued basis the information provided by you&cedil; which is available with the company. In case of discrepancy/non recording of relevant information in the policy&cedil; the insured is requested to bring the same to the notice of the company within 15 days. This Policy is to be read in conjunction with the Policy wordings <a href="https://www.acko.com/download">(https://www.acko.com/download)</a> available on the website of the Company. On renewal&cedil; the benefits provided under the policy and/or terms and conditions of the policy including premium rate may be subject to change.</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="1" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-insurance td {
    text-align:left;
    padding:15px;
    font-family: helvetica ;
    font-size: 13px;
    line-height:30px;
    font-weight:bold; 
    border-bottom:2px solid #000
    }
    </style>
<table class="section-insurance" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="680">INTERMEDIARY DETAILS</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:14px">&nbsp;</td></tr></table>';
$content .='<style>
    table.section-Advance-Name td {
    text-align:left;
    font-family: helvetica ;
    font-size: 10px;
    line-height:16px;
    color:#000;
    }
</style>
<table  class="section-Advance-Name" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
     <td width="100">Policy Issuing Office:</td>
     <td width="200" style="color:#000;">Direct - Mumbai</td>
	 <td width="100">Intermediary Name:</td>
	 <td width="200" style="color:#000;">Direct</td>
  </tr>
  <tr>
	 <td width="100">Phone Number:</td>
	 <td width="200" style="color:#000;">N/A</td>
	 <td width="100">Intermediary Code:</td>
	 <td width="200" style="color:#000;">N/A</td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-general td{
    text-align:left;
    padding:15px;
    font-family: helvetica ;
    line-height:14px;
    font-size: 10px;
    }
</style>
<table class="section-general" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="520"><span style="font-weight:bold;font-size: 12px;line-height:24px;"><br />Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 10px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Goregaon (E), Mumbai- 400063</span><br />
      <span style="line-height: 16px;font-size: 10px;">Email: hello@acko.com | Helpline: 1800 266 2256 | www.acko.com</span><br />
      <span style="line-height: 16px;font-size: 10px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0001V01201718</span></td>
    <td  align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 11px; line-height:16px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
	
  }
  else{
  $content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="120" ><span style="line-height:24px">&nbsp;</span><br /><img style="width:90px;vertical-align: middle;" src="'.$site_url.'assets/images/logo.jpg" alt=""  align="middle"></td>
  <td  width="460" style="font-size: 15px;color: #000;font-weight: bold;line-height:18px; font-family: helvetica ;"><span ><br />LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</span><br />
  <span style="font-family:Helvetica, sans-serif;font-size: 11px;color: #8c8c8c;font-weight: normal;line-height:16px;">Certificate of Insurance cum Policy Schedule</span></td>
 </tr>
</table>';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" border="0px"><tr><td>&nbsp;</td></tr></table>';	
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>';
$content .= '
<style>
.vehicle-section td{
font-size:8.5px;
color:#000;
font-family: helvetica;
font-weight:normal;
line-height:16px;
text-align:left;
}
</style>
<table class="vehicle-section" cellpadding="0" cellspacing="0" border="0">
<tr >
  <td width="295" style="line-height:30px;font-weight:bold;font-size:13px;border-bottom:2px solid #000;color:#000;">POLICY DETAILS</td>
  <td width="20">&nbsp;</td>
  <td width="295" style="line-height:30px;font-weight:bold;font-size:13px;border-bottom:2px solid #000;color:#000;">VEHICLE DETAILS</td>
  <td rowspan="8" width="100" ><span width="110" style="line-height:4px;">&nbsp;</span><img style="width:70px;" align="right" src="'.$qrcode_img.'" alt=""></td>
</tr>
<tr>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="185" style="line-height:4px;">&nbsp;</td>
  <td width="20" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="185" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="110">Insured Name: </td>
  <td width="185" style="color:#000;"><strong>'.$full_name.'</strong></td>
  <td width="20">&nbsp;</td>
  <td width="110">Registration Number:</td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['vehicle_registration_no'].'</strong> </td>
</tr>
<tr>
  <td width="110">Address: </td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_address_line2'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].'</strong></td>
  <td width="20">&nbsp;</td>
  <td width="110">Make/Model:</td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['make_model'].' </strong> </td>
</tr>
<tr>
  <td width="110">Pincode: </td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['primary_pin_code'].'</strong> </td>
  <td width="20">&nbsp;</td>
  <td width="110">Registration Year:</td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['registration_year'].'</strong> </td>
</tr>
<tr>
  <td width="110">Manufacturing Year: </td>
  <td width="185" style="color:#000; "><strong>'.$mfg_date.'</strong> </td>
  <td width="20">&nbsp;</td>
  <td width="110">Fuel Type:</td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['fuel_type'].' </strong></td>
</tr>
<tr>
  <td width="110">GSTIN: </td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['company_gstin'].'</strong> </td>
  <td width="20">&nbsp;</td>
  <td width="110">Engine No: </td>
  <td width="185" style="color:#000;"><strong>'.strtoupper($exp_policy_data['engine_no']).' </strong> </td>
</tr>
<tr>
  <td width="110">Period of Insurance: </td>
  <td width="185" style="color:#000;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong> </td>
  <td width="20">&nbsp;</td>
  <td width="110">Chassis No:</td>
  <td width="185" style="color:#000;"><strong>'.strtoupper($exp_policy_data['chassis_no']).' </strong> </td>
</tr>
<tr>
  <td width="110">Policy Issuance Date:</td>
  <td width="185" style="color:#000;"><strong>'.$insurance_date.' </strong> </td>
  
</tr>
<tr>
  <td  width="110">Policy Number: </td>
  <td width="185" style="color:#000;"><strong>'.$policy_no.'</strong> </td>
</tr>
<tr>
  <td  width="110">Nominee: </td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['nominee_name'].', '.$exp_policy_data['nominee_relation'].', '.$exp_policy_data['nominee_age'].' </strong> </td>
</tr>
<tr>
  <td  width="110">Owner Number: </td>
  <td width="185" style="color:#000;"><strong>'.$exp_policy_data['phone_no'].'</strong> </td>
</tr>
<tr>
  <td  width="110">Previous Policy Expiry Date: </td>
  <td width="185" style="color:#000;"><strong>N/A</strong> </td>
</tr>

</table>';
$content .= '<table class="first"  cellpadding="14" cellspacing="14" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-pre-details td {
    font-family: helvetica ;
    font-size: 13px;
    line-height:24px;
    border-bottom:2px solid #000;
    font-weight:bold; 
}
</style>
<table class="section-pre-details" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="680">PREMIUM DETAILS (<span style="font-family:dejavusans;">&#8377;</span>)</td>
</tr>
</table>';
$content .= '<table class="first" cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:9px">&nbsp;</td></tr></table>';
$content .= '<style>
table.section-premium td {
    border-bottom: 1px solid #d3d3d3;
    text-align:right;
    padding:15px;
    font-family: helvetica ;
    font-size: 10px;
    line-height:30px;
    color:#000;
}

</style>
<table width="680" class="section-premium"  cellpadding="0" cellspacing="0" width="100%" border="0" style="border: 1px solid #d3d3d3; border-top:none">
<tr>
  <td width="680" bgcolor="#dddddd" style="text-align:left;border:none !important; color:#000;"> &nbsp; <strong>Premium Breakup</strong></td>
</tr>
<tr>
  <td width="340" style="text-align:left; "> &nbsp; Basic Third Party Liability </td>
  <td width="340"> '.$exp_policy_data['basic_amount'].'  &nbsp; &nbsp; </td>
</tr>
<tr>
  <td width="340" style="text-align:left; color:#000;"> &nbsp; Net Liability Premium (B) </td>
  <td width="340" style="color:#000;"> '.$exp_policy_data['basic_amount'].'  &nbsp; &nbsp; </td>
</tr>
<tr>
  <td width="340" style="text-align:left;"> &nbsp; IGST (18%) </td>
  <td width="340">'.$exp_policy_data['gst_amount'].' &nbsp; &nbsp;  </td>
</tr>
<tr>
  <td width="340" style="text-align:left; color:#000; border:none"> &nbsp; Total Premium </td>
  <td width="340" style=" border:none; color:#000;">'.$exp_policy_data['total_amount'].'  &nbsp; &nbsp; </td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:6px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Deductible td {
        font-family: helvetica ;
        font-size: 10px;
        line-height:20px;
		font-weight:normal;
		color:#000;
    }
    </style><table class="section-Deductible" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="115">Geographical Area: </td>
  <td width="115"><strong>India</strong> </td>
  <td width="115">Compulsory Deductible: </td>
  <td width="115 style="font-family:helvetica; font-weight:bold;""><span style="font-family:dejavusans;">&#8377;</span> 0</td>
  <td width="115">Voluntary Deductible:</td>
  <td width="115" style="font-family:helvetica; font-weight:bold;"><span style="font-family:dejavusans;">&#8377;</span> 0</td>
</tr>
<tr>
  <td width="115">No-Claim Bonus:</td>
  <td width="115" style="font-family:helvetica; font-weight:bold;">0 %</td>
  <td width="115">Hypothecation:</td>
  <td width="115" style="font-family:helvetica; font-weight:bold;">'.$financial_company.'</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" border="0"><tr><td>&nbsp;</td></tr></table>';

$content .= '<style>

    table.section-inter td {
        font-family: helvetica ;
        font-size: 14px;
        line-height:30px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table class="section-inter" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="680">INTERMEDIARY DETAILS</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td style="line-height:8px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Code td {
        font-family: helvetica ;
        font-size:9px;
        line-height:14px;
        border:0.5px solid #000;
		font-weight:normal;
		padding:5px 0px;
    }
    </style><table class="section-Code" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="130" bgcolor="#dddddd" style="line-height:20px; border:none;"> &nbsp; Name </td>
  <td width="90" bgcolor="#dddddd" style="line-height:20px; border:none;"> &nbsp; Code </td>
  <td width="100" bgcolor="#dddddd" style="line-height:20px; border:none;"> &nbsp; Contact </td>
  <td width="140" bgcolor="#dddddd" style="line-height:20px; border:none;"> &nbsp; Email </td>
  <td width="220" bgcolor="#dddddd" style="line-height:20px; border:none;"> &nbsp; Address </td>
</tr>
<tr>
  <td width="130"> &nbsp; Advance india insurance <br /> <span style="display:block;"> &nbsp; broker  Pvt limited </span></td>
  <td width="90"> &nbsp; 131362 </td>
  <td width="100"> &nbsp; +917551196988 </td>
  <td width="140"> &nbsp; <a href="#">support@info.cvom</a> </td>
  <td width="220"> &nbsp; Plot No.49, 3rd Floor, Gurgaon, Haryana 122004 </td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-pos td {
        font-family: helvetica ;
        font-size: 10px;
        line-height:20px;
        border:1px solid #000;
		font-weight:normal;
    }
    </style><table width="530" class="section-pos" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="230" bgcolor="#dddddd" style="border:none;" > &nbsp; POS Name </td>
  <td width="225" bgcolor="#dddddd" style="border:none;"> &nbsp; POS Contact </td>
  <td width="225" bgcolor="#dddddd" style="border:none;"> &nbsp; POS ID NO </td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="45" cellspacing="45" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family: helvetica ;
    line-height:18px;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="400"><span style="font-size: 12px;line-height:24px;font-weight:bold">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 9px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size:9px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 9px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    <td  align="center" width="120"> <img src="'.$site_url.'assets/images/acko-badge.jpg" alt="" style="text-align:center;width:70px"></td>
      
      <td  align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 11px; line-height:16px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="10" cellspacing="10" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: helvetica ;
        font-size: 8.4px;
        line-height:14px;
    }
    </style>
<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="680" style="font-size: 8.5px; font-family: helvetica ;"><strong>Limitations As To Use:</strong> The Policy covers use only under a permit within the meaning of the Motor Vehicle Act (M V Act) 1988 or such a carriage falling under Sub-Section (3) of Section 66 of the Motor Vehicle&acute;s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person (including the insured), provided that a person driving holds a valid driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the person holding a valid learner&acute;s license may also drive the vehicle when not used for the transport of passengers at the time of accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules, 1989. <strong>Limits of Liability.</strong> 1. Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles Act, 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner - Driver(CSI): Rs. 0.0 <strong>Terms, Conditions &amp; Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost on request &amp; the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days of the Acko Policy Start Date.</td>
</tr>
</table>
';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="680" style="font-family: helvetica ;font-size: 8.5px;">I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the provision of chapter X, XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide GRAS Deface no. 0004976826201920 dated 19/12/2019 as prescribed in Government Notification Revenue &amp; Forest Department No. Mudrank - 2017/C.R.97/M-1, dated 09/01/2018 . GSTN: 27AAOCA9055C1ZJ. <strong>IMPORTANT NOTICE:</strong> The Insured is not indemnified if the vehicle is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms appearing in the Certificate in order to comply with the Motor Vehicle Act, 1988 is recoverable from the Insured. See the clause headed "AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY" in the policy wordings. <strong>Disclaimer</strong>: The Policy shall be void from inception if the premium cheque is not realized. In the event of misrepresentation, fraud or non-disclosure of material fact, the Company reserves the right to cancel the Policy. The policy is issued basis the information provided by you, which is available with the company. In case of discrepancy/non recording of relevant information in the policy, the insured is requested to bring the same to the notice of the company within 15 days. This Policy is to be read in conjunction with the Policy wordings <a href="https://www.acko.com/download">(https://www.acko.com/download)</a> available on the website of the Company. On renewal, the benefits provided under the policy and/or terms and conditions of the policy including premium rate may be subject to change.</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="200" cellspacing="200" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family: helvetica ;
    line-height:18px;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="450"><span style="font-size: 12px;line-height:24px;font-weight:bold">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 9px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size:9px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 9px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    
      
      <td  align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 11px; line-height:16px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="10" cellspacing="10" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="120"><img src="'.$site_url.'assets/images/logo.jpg" alt=""> </td>
    <td  width="300" style="font-size: 15px;color: #000;font-weight: bold;line-height:36px; font-family: helvetica ;"> PREMIUM RECEIPT </td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="5" cellspacing="5" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td  width="680" style="font-size: 10px;color: #000;font-weight: normal;line-height:20px;font-family: helvetica ;">Receieved with thanks from '.$full_name.' a sum of <span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['total_amount'].' towards premium on '.strtoupper($exp_policy_data['ins_type']).' Insurance Policy</td>
  </tr>
</table>'; 
$content .= '<table class="first"  cellpadding="6" cellspacing="6" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-diary td{
    text-align:left;
    padding:15px;
    font-family: helvetica ;
    font-size: 10px;
    line-height:16px;
    color:#000;
}
</style>
<table class="section-diary" cellpadding="2" cellspacing="1" border="0">
<tr >
  <td width="330" style="border-bottom:2px solid #000; font-weight:bold; font-size:13px; line-height: 30px;font-family: helvetica ;color:#000;">INSURED DETAILS</td>
  <td width="20">&nbsp;</td>
  <td width="330" style="border-bottom:2px solid #000; font-weight:bold; font-size:13px;line-height: 30px;font-family: helvetica ;color:#000;">INTERMEDIARY DETAILS</td>
</tr>
<tr>
  <td width="100" style="line-height:4px;">&nbsp;</td>
  <td width="230" style="line-height:4px;">&nbsp;</td>
  <td width="20" style="line-height:4px;">&nbsp;</td>
  <td width="100" style="line-height:4px;">&nbsp;</td>
  <td width="230" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Insured Name: </td>
  <td width="230" style="color:#000;"><strong>'.$full_name.'</strong> </td>
  <td width="20" >&nbsp;</td>
  <td width="100">Name : </td>
  <td width="230" style="color:#000;"><strong>Advance india insurance broker Pvt limited</strong></td>
</tr>
<tr>
  <td width="100">Address: </td>
  <td width="230" style="color:#000;"><strong>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_address_line2'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].' </strong> </td>
  <td width="20" >&nbsp;</td>
  <td width="100">Code:</td>
  <td width="230" style="color:#000;"><strong>131362</strong></td>
</tr>
<tr>
  <td width="100">GST: </td>
  <td width="230" style="color:#000;"><strong>'.$exp_policy_data['company_gstin'].'</strong> </td>
  <td width="20" >&nbsp;</td>
  <td width="100">&nbsp;</td>
  <td width="230" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Period of Insurance: </td>
  <td width="230" style="color:#000;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong> </td>
  <td width="20" >&nbsp;</td>
  <td width="100"> &nbsp;</td>
  <td width="230" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Policy Number :</td>
  <td width="230" style="color:#000;"><strong> '.$policy_no.' </strong> </td>
  <td width="20" >&nbsp;</td>
  <td width="100"> &nbsp;</td>
  <td width="230" style="color:#000;">&nbsp;</td>
</tr>
</table>';

 $content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>

    table.section-pre1 td {
        font-family: helvetica ;
        font-size: 14px;
        line-height:30px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table class="section-pre1" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="680" style="font-family: helvetica ;">PREMIUM DETAILS (<span style="font-family:dejavusans;">&#8377;</span>)</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Net td {
        border-bottom: 0.5px solid #d3d3d3;
        text-align:right;
        padding:15px;
        font-family: helvetica ;
        font-size: 11px;
        line-height:24px;
    }
    </style>
<table class="section-Net"  cellpadding="0" cellspacing="0" border="0" style="border: 1px solid #d3d3d3;">
<tr>
  <td width="340" style="text-align:left;"> &nbsp; Net Premium</td>
  <td width="340"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['basic_amount'].' &nbsp; </td>
</tr>
<tr>
  <td width="340" style="text-align:left;"> &nbsp; IGST (18%) </td>
  <td width="340"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['gst_amount'].' &nbsp; </td>
</tr>
<tr>
  <td width="340" style="text-align:left; border-bottom:none;font-weight:bold">  &nbsp; Total Premium</td>
  <td width="340" style="border-bottom:none;font-weight:bold;"> &nbsp; <span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['total_amount'].' &nbsp; </td>
</tr>
</table>';
 $content .= '<table class="first"  cellpadding="5" cellspacing="5" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
 $content .= '<style>

    table.section-terms td {
        font-family: helvetica ;
        font-size: 14px;
        line-height:24px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table width="530" class="section-terms" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="680">TERMS & CONDITIONS</td>
</tr>
</table>';
$content .= '<style>

    table.section-receipt td {
        text-align:left;
        font-family: helvetica ;
        font-size: 11px;
        line-height:18px;
    }
    </style>
<table class="section-receipt"  cellpadding="0" cellspacing="2" width="100%" border="0">
<tr>
  <td width="680" style="line-height:3px"></td>
  </tr>
<tr>
  <td width="680">Issuance of this receipt does not amount to acceptance of the risk by Acko General Insurance Limited. The insurance cover for the risk shall be as per the terms and conditions of the Insurance Policy if and when issued. Cheque/DD/PO receipt is valid subject to the realization of the instrument.</td>
</tr>
<tr>
  <td width="680" style="line-height:3px"></td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="125" cellspacing="125" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family: helvetica ;
    line-height:18px;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="450"><span style="font-size: 12px;line-height:24px;font-weight:bold">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 9px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size:9px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 9px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    
      
      <td  align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 11px; line-height:16px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="15" cellspacing="15" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="100"><img src="'.$site_url.'assets/images/logo.jpg" alt=""> </td>
    <td  width="300" style="font-size: 15px;color: #000;font-weight: bold;line-height:36px;font-family: helvetica ;"> PROPOSAL FORM</td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="4" cellspacing="4" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td  width="680" style="font-size: 10px;color: #000;font-weight: normal;line-height:20px;font-family: helvetica ;">Dear '.$full_name.',<br /><br />
	          We wish to inform you that the Insurance policy number '.$policy_no.' has been issued on the basis of the information and declaration given by you, the transcript whereof is mentioned below.<br /><br />
	          Please be informed that this Policy shall be construed to be void ab initio/invalid in the event we find that you have not disclosed material or correct information required for the purpose of providing the below insurance cover and in case of any claim arising under the policy in such a scenario, we shall be under no obligation whatsoever to settle such claim to you and the premium paid by you under this policy shall stand fully forfeited.
    </td>
  </tr>
</table>'; 
$content .= '<table class="first"  cellpadding="6" cellspacing="6" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-bike td{
    text-align:left;
    font-family: helvetica ;
    font-size:9px;
    line-height:16px;
    color:#000
}
</style>
<table width="530" class="section-diary" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr >
  <td width="330" style="border-bottom:2px solid #000; font-weight:bold; font-size:13px; line-height: 30px;font-family: helvetica ;color:#000;">POLICY DETAILS</td>
  <td width="20">&nbsp;</td>
  <td width="330" style="border-bottom:2px solid #000; font-weight:bold; font-size:13px;line-height: 30px;font-family: helvetica ;color:#000;">BIKE DETAILS</td>
</tr>
<tr>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="220" style="line-height:4px;">&nbsp;</td>
  <td width="20" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="220" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="110">Policy Number: </td>
  <td width="220" style="color:#000;"><strong>'.$policy_no.'</strong></td>
  <td width="20">&nbsp;</td>
  <td width="110">Bike Number : </td>
  <td width="220" style="color:#000;"><strong>'.$exp_policy_data['vehicle_registration_no'].'</strong></td>
</tr>
<tr>
<td width="110">Period of Insurance: </td>
<td  rowspan="1" width="220" style="color:#000;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong></td>
<td width="20">&nbsp;</td>
<td width="110">Make/Model: </td>
<td width="220" style="color:#000;"><strong>'.$exp_policy_data['make_model'].' </strong></td>
</tr>
<tr>
<td width="110">Policy Issuance Date: </td>
<td width="220" style="color:#000;"><strong>'.$insurance_date.'</strong> </td>
<td width="20">&nbsp;</td>
<td width="110">Fuel Type: </td>
<td width="220" style="color:#000;"><strong>'.$exp_policy_data['fuel_type'].' </strong></td>
</tr>
<tr>
<td width="110">&nbsp;</td>
<td width="220" style="color:#000;">&nbsp;</td>
<td width="20">&nbsp;</td>
<td width="110">Registration Year: </td>
<td width="220" style="color:#000;"><strong>'.$exp_policy_data['registration_year'].'</strong> </td>

</tr>
<tr>
<td width="110"> &nbsp;</td>
<td width="220" style="color:#000;">&nbsp;</td>
<td width="20">&nbsp;</td>
<td width="110">Manufacturing Year: </td>
<td width="220" style="color:#000;"><strong>'.$mfg_date.' </strong> </td>
</tr>
<tr>
<td width="110"> &nbsp;</td>
<td width="220" style="color:#000;">&nbsp;</td>
<td width="20">&nbsp;</td>
<td width="110">Insured Declared Value (IDV): </td>
<td width="220" style="color:#000;"><strong>N/A </strong> </td> 
</tr>
<tr>
<td width="110"> &nbsp;</td>
<td width="220" style="color:#000;">&nbsp;</td>
<td width="20">&nbsp;</td>
<td width="110">Accessories (IDV): </td>
<td width="220" style="color:#000;"><strong>0 </strong> </td> 

</tr>
</table>';

 $content .= '<table class="first"  cellpadding="5" cellspacing="5" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-owner td{
    text-align:left;
    font-family: helvetica ;
    font-size: 9px;
    line-height:16px;
        color:#000
}
</style>

<table class="section-owner" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr >
  <td width="330" style="border-bottom:2px solid #000; font-weight:bold; font-size:13px; line-height: 30px;    color:#000">BIKE OWNER DETAILS</td>
  <td width="20">&nbsp;</td>
  <td width="330" style="border-bottom:2px solid #000; font-weight:bold; font-size:13px;line-height: 30px;    color:#000">NOMINEE DETAILS</td>
</tr>
<tr>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="220" style="line-height:4px;">&nbsp;</td>
  <td width="20" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="220" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="110">Name: </td>
  <td width="220" style="color:#000;"><strong>'.$full_name.'</strong> </td>
  <td width="20">&nbsp;</td>
  <td width="110">Name: </td>
  <td width="220" style="color:#000;"><strong>'.$exp_policy_data['nominee_name'].' </strong> </td>
</tr>
<tr>
  <td width="110">Email Address:  </td>
  <td width="220" style="color:#000;"><strong>'.$exp_policy_data['email'].'</strong> </td>
  <td width="20">&nbsp;</td>
  <td width="110">Relationship with Insured: </td>
  <td width="220" style="color:#000;"><strong>'.$exp_policy_data['nominee_relation'].' </strong> </td>
</tr>
<tr>
  <td width="110">Mobile Number: </td>
  <td width="220" style="color:#000;"><strong>'.$exp_policy_data['phone_no'].' </strong> </td>
  <td width="20">&nbsp;</td>
  <td width="110"> &nbsp; </td>
  <td width="220" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  
  <td width="110">Pincode: </td>
  <td width="220" style="color:#000;"><strong>'.$exp_policy_data['primary_pin_code'].' </strong></td>
  <td width="20">&nbsp;</td>
  <td width="110">&nbsp;</td>
  <td width="220" style="color:#000;">&nbsp;</td>
</tr>

</table>';

 $content .= '<table class="first"  cellpadding="5" cellspacing="5" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: helvetica ;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="680" style="font-size: 10px; font-family: helvetica;">"I/We hereby declare that the statements made by me/us in this proposal form are true to the best of my knowledge and belief and I/We hereby agree that this declaration shall form the basis of the contract between me/us and Acko General Insurance Ltd. I/We agree and undertake to convey to Acko General Insurance Limited any change / alterations carried out in the risk proposed for insurance after submission of this proposal form. I/we hereby declare that the contents of the form have been fully explained to me/us and that I/we have fully understood the significance of the proposed contract.</td>
</tr>
</table>
';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: helvetica ;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="680" style="font-size: 10px;font-family: helvetica;"><strong>Prohibition of Rebated (Section 41) of the Insurance Act - 1938 (as amended)</strong><br /><br /> 1. No person shall allow or offer to allow, either directly or indirectly as an inducement to any person to take out or renew or continue and insurance in respect of any kind or risk relating to lives or property in India, any rebate of the whole or part of the commission payable or any rebate of the premium shown on the policy, nor shall any person taking out or renewing or continuing a policy accept any rebate expect such rebate as may be allowed in accordance with the prospectus or tables of the Insurer. <br /><br />
	            2. Any person making default in complying with the provisions of this section shall be liable for a penalty which may extend to 10 lakh rupees."</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="55" cellspacing="55" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family: helvetica ;
    line-height:18px;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="450"><span style="font-size: 12px;line-height:24px;font-weight:bold">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 9px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size:9px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 9px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    
      
      <td  align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 11px; line-height:16px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
 
  }
  
  return $content;
}
?>
