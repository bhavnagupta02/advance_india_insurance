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

  	/*$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td width="80" ><span style="line-height:16px">&nbsp;</span><br /><img style="width:72px;vertical-align: middle;" src="'.$site_url.'assets/images/logo.jpg" alt=""  align="middle"></td>
  <td  width="360" style="font-family: helvetica;font-size: 13px;color: #000;font-weight: Bold;line-height:14px;"><span ><br />LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</span><br />
  <span style="font-family: helvetica;font-size: 11px;color: #8c8c8c;font-weight: normal;line-height:16px;">Certificate of Insurance cum Policy Schedule</span></td>
   <td rowspan="3" align="right" width="100" ><img style="width:60px;" align="right" src="'.$qrcode_img.'" alt=""></td>
 </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0px"><tr><td style="line-height:10px">&nbsp;</td></tr></table>';
$content .= '
<style>
.section-vehicle td{
font-size: 11px;
color:#000;
font-family: helvetica;
font-weight:normal;
line-height:18px;
text-align:left;
}
</style><table class="section-vehicle" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr >
 <td width="260" style="font-weight:bold; line-height: 18px;font-size:11px;border-bottom:2px solid #000">POLICY DETAILS</td>
 <td width="20">&nbsp;</td>
 <td width="260" style="font-weight:bold; line-height: 18px;font-size:11px;border-bottom:2px solid #000">VEHICLE DETAILS</td>

</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0px"><tr><td style="line-height:4px">&nbsp;</td></tr></table>';
$content .= '
<style>
.section-Registration td{
font-size:8px;
color:#000;
font-family: helvetica;
font-weight:normal;
line-height:12px;
text-align:left;
}
</style><table width="800" class="section-Registration" cellpadding="0" cellspacing="0" width="100%" border="0" >
<tr>
  <td width="110">Insured Name: </td>
  <td style="color:#000;font-weight:bold; " width="150">'.$full_name.'</td>
  <td width="20">&nbsp;</td>
  <td width="110">Registration Number:</td>
  <td style="color:#000;font-weight:bold; " width="150">'.$exp_policy_data['vehicle_registration_no'].'</td>
</tr>
<tr>
  <td width="110">Pincode: </td>
  <td style="color:#000;font-weight:bold; " width="150">'.$exp_policy_data['primary_pin_code'].' </td>
  <td width="20">&nbsp;</td>
  <td width="110">Make/Model:</td>
  <td style="color:#000;font-weight:bold; " width="150">'.$exp_policy_data['make_model'].' </td>
</tr>
<tr>
<td width="110">GSTIN: </td>
  <td style="color:#000;font-weight:bold; " width="150">'.$exp_policy_data['company_gstin'].'</td>
  
  <td width="20">&nbsp;</td>
  <td width="110">Purchase Year: </td>
  <td style="color:#000;font-weight:bold; " width="150">'.$exp_policy_data['registration_year'].' </td>
</tr>
<tr>
  <td width="110" rowspan="2">Period of Insurance: </td>
  <td rowspan="2" style="color:#000;font-weight:bold; " width="150">'.$payment_date.' to '.$policy_exp_date.' </td>
  <td width="20">&nbsp;</td>
  <td width="110">Fuel Type: </td>
  <td style="color:#000;font-weight:bold; " width="150">'.$exp_policy_data['fuel_type'].' </td>
</tr>
<tr>
  
  <td width="20">&nbsp;</td>
  <td width="110">Engine No: </td>
  <td style="color:#000;font-weight:bold; " width="120">'.strtoupper($exp_policy_data['engine_no']).'</td>
</tr>
<tr>
<td  width="110">Policy Issuance Date:</td>
  <td style="color:#000;font-weight:bold; " width="150">'.$insurance_date.'</td>
<td width="20">&nbsp;</td>
<td width="110">Chassis No:</td>
<td style="color:#000;font-weight:bold; " width="150">'.strtoupper($exp_policy_data['chassis_no']).'</td>
</tr>
<tr>
<td width="110">Policy Number: </td>
<td style="color:#000;font-weight:bold; " width="150">'.$policy_no.'</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="3" cellspacing="3" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-pre-details td {
    font-family: helvetica;
    font-size:11px;
    line-height:15px;
    border-bottom:2px solid #000;
    font-weight:bold; 
}
</style>
<table class="section-pre-details" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540">PREMIUM DETAILS (<span style="font-family:dejavusans;">&#8377;</span>)</td>
</tr>
</table>';
$content .= '<table class="first" cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:9px">&nbsp;</td></tr></table>';
$content .= '<style>
table.section-premium td {
    border-bottom: 1px solid #d3d3d3;
    text-align:right;
    font-family: helvetica;
    font-size: 9px;
    line-height:18px;
    color:#000;
}

</style>
<table width="540" class="section-premium"  cellpadding="0" cellspacing="0" width="100%" border="0" style="border: 1px solid #d3d3d3; border-top:none">
<tr>
  <td width="540" bgcolor="#dddddd" style="text-align:left;border:none !important; color:#000;"> &nbsp; <strong>Premium Breakup</strong></td>
</tr>
<tr>
  <td width="270" style="text-align:left; "> &nbsp; Basic Third Party Liability </td>
  <td width="270"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['basic_amount'].'  &nbsp; &nbsp; </td>
</tr>
<tr>
  <td width="270" style="text-align:left; color:#000;"> &nbsp; <strong>Net Liability Premium (B)</strong> </td>
  <td width="270" style="color:#000;"><span style="font-family:dejavusans;">&#8377;</span> <strong>'.$exp_policy_data['basic_amount'].'  &nbsp; &nbsp;</strong> </td>
</tr>
<tr>
  <td width="270" style="text-align:left;"> &nbsp; IGST (18%) </td>
  <td width="270"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['gst_amount'].' &nbsp; &nbsp;  </td>
</tr>
<tr>
  <td width="270" style="text-align:left; color:#000; border:none"> &nbsp; <strong>Total Premium</strong> </td>
  <td width="270" style=" border:none; color:#000;"><span style="font-family:dejavusans;">&#8377;</span> <strong> '.$exp_policy_data['total_amount'].'  &nbsp; &nbsp;</strong></td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:6px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Deductible td {
        font-family: helvetica;
        font-size: 9px;
        line-height:16px;
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
$content .= '<table class="first"  cellpadding="3" cellspacing="3" border="0"><tr><td style="line-height:4px">&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        color:#000;
        font-family: helvetica;
        line-height:10px;
    }
    </style>
<table class="section-note" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-size: 7px;"><strong>Please Note:</strong>In case of a claim event arising within 30 days from the start of this Policy&cedil; the Insured is required to submit a copy of his Previous Insurance Policy.</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:2px">&nbsp;</td></tr></table>';
$content .='<table class="section-note" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-size:7px;"><strong>Limitations As To Use:</strong> The Policy covers use only under a permit within the meaning of the Motor Vehicle Act (M V Act) 1988 or such a carriage falling under Sub-Section (3) of Section 66 of the Motor Vehicle&acute;s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person (including the insured)&cedil; provided that a person driving holds a valid driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the person holding a valid learner&acute;s license may also drive the vehicle when not used for the transport of passengers at the time of accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules&cedil; 1989. <strong>Limits of Liability.</strong> 1. Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles Act&cedil; 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner - Driver(CSI): Rs. 0.0 <strong>Terms&cedil; Conditions & Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost on request & the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days of the Acko Policy Start Date.</td>
</tr>
</table>';
$content .='<table class="section-note" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-size:7px;">I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the provision of chapter X&cedil; XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide GRAS Deface no. 0004976826201920 dated 19/12/2019 as prescribed in Government Notification Revenue & Forest Department No. Mudrank - 2017/C.R.97/M-1&cedil; dated 09/01/2018 . GSTN: 27AAOCA9055C1ZJ. <strong>IMPORTANT NOTICE:</strong> The Insured is not indemnified if the vehicle is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms appearing in the Certificate in order to comply with the Motor Vehicle Act&cedil; 1988 is recoverable from the Insured. See the clause headed "AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY" in the policy wordings. <strong>Disclaimer</strong>: The Policy shall be void from inception if the premium cheque is not realized. In the event of misrepresentation&cedil; fraud or non-disclosure of material fact&cedil; the Company reserves the right to cancel the Policy. The policy is issued basis the information provided by you&cedil; which is available with the company. In case of discrepancy/non recording of relevant information in the policy&cedil; the insured is requested to bring the same to the notice of the company within 15 days. This Policy is to be read in conjunction with the Policy wordings <a href="https://www.acko.com/download">(https://www.acko.com/download)</a> available on the website of the Company. On renewal&cedil; the benefits provided under the policy and/or terms and conditions of the policy including premium rate may be subject to change.</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-insurance td {
    text-align:left;
    padding:15px;
    font-family: helvetica;
    font-size: 10px;
    line-height:18px;
    font-weight:bold; 
    border-bottom:2px solid #000
    }
    </style>
<table class="section-insurance" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="540">INTERMEDIARY DETAILS</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:8px">&nbsp;</td></tr></table>';
$content .='<style>
    table.section-Advance-Name td {
    text-align:left;
    font-family: helvetica;
    font-size: 8px;
    line-height:14px;
    color:#000;
    }
</style>
<table  class="section-Advance-Name" cellpadding="0" cellspacing="0" border="0">
  <tr>
     <td width="100">Policy Issuing Office:</td>
     <td width="170" style="color:#000;">Direct - Mumbai</td>
	 <td width="100">Intermediary Name:</td>
	 <td width="170" style="color:#000;">Advance india insurance broker Pvt limited</td>
  </tr>
  <tr>
	 <td width="100">Phone Number:</td>
	 <td width="170" style="color:#000;">1800212071392</td>
	 <td width="100">Intermediary Code:</td>
	 <td width="170" style="color:#000;">131362</td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" border="0"><tr><td>&nbsp;</td></tr></table>';

$content .='<style>
.section-Corporate td{
    text-align:left;
    font-family: helvetica;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="380" style="font-size: 9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size:10px; line-height:16px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table>';*/
    
  $content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="80" ><img style="width:72px;vertical-align: middle;" src="'.$site_url.'assets/images/logo.jpg" alt=""  align="middle"></td>
  <td  width="400" style="font-size: 12px;color: #000;font-weight: bold;line-height:12px;font-family:dejavusans;"><span >LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</span><br />
  <span style="font-family:dejavusans;font-size: 9px;color: #000;font-weight: normal;line-height:10px;">Certificate of Insurance cum Policy Schedule</span></td>
 </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:2px;">&nbsp;</td></tr></table>';
$content .= '
<style>
.vehicle-section td{
font-size:7.5px;
color:#000;
font-family:dejavusans;
font-weight:normal;
text-align:left;
line-height:9px;

}
</style>
<table class="vehicle-section" cellpadding="0" cellspacing="0" border="0">
<tr >
  <td width="220" style="line-height:10px;font-weight:bold;font-size:9px;border-bottom:2px solid #000;color:#000;">POLICY DETAILS</td>
  <td width="30">&nbsp;</td>
  <td width="220" style="line-height:10px;font-weight:bold;font-size:9px;border-bottom:2px solid #000;color:#000;">VEHICLE DETAILS</td>
  <td rowspan="8" width="70" ><img style="width:70px;" align="right" src="'.$qrcode_img.'" alt=""></td>
</tr>
<tr>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="30" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="110" style="line-height:12px;">Insured Name: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$full_name.'</strong></td>
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Registration Number:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['vehicle_registration_no'].'</strong> </td>
</tr>
<tr>
  <td width="110"  rowspan="2" style="line-height:12px;">Address: </td>
  <td width="110"  rowspan="2" style="color:#000;line-height:10px;text-transform: lowercase;"><strong>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].'</strong></td>
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Make/Model:</td>
  <td width="110" style="color:#000;line-height:10px;"><strong>'.$exp_policy_data['make_model'].' </strong> </td>
</tr>
<tr>
  
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Registration Year:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['registration_year'].'</strong> </td>
</tr>
<tr>
<td width="110" style="line-height:12px;">Pincode: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['primary_pin_code'].'</strong> </td>
  
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Manufacturing Year: </td>
  <td width="110" style="color:#000;line-height:12px; "><strong>'.$mfg_date.'</strong> </td>
</tr>
<tr>
<td width="110" style="line-height:12px;">GSTIN: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['company_gstin'].'</strong> </td>
  
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Fuel Type:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['fuel_type'].' </strong></td>
</tr>
<tr>
<td width="110" rowspan="2" style="line-height:12px;">Period of Insurance: </td>
  <td width="110" rowspan="2" style="color:#000;line-height:12px;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong> </td>
  
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Engine No: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.strtoupper($exp_policy_data['engine_no']).' </strong> </td>
</tr>
<tr>
  <td width="30">&nbsp;</td>
   <td width="110" style="line-height:12px;">Chassis No:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.strtoupper($exp_policy_data['chassis_no']).' </strong> </td>
  
</tr>
<tr>
 <td width="110" style="line-height:12px;">Policy Issuance Date:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$insurance_date.' </strong> </td>
   <td width="30">&nbsp;</td>
 
</tr>
<tr>
<td  width="110" style="line-height:12px;">Policy Number: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$policy_no.'</strong> </td>
</tr>
<tr>

<td  width="110" style="line-height:12px;">Nominee: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['nominee_name'].', '.$exp_policy_data['nominee_relation'].', '.$exp_policy_data['nominee_age'].' </strong> </td>
</tr>
<tr>
  <td  width="110" style="line-height:12px;">Owner Number: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['phone_no'].'</strong> </td>
</tr>
<tr>
  <td  width="110" style="line-height:12px;">Previous Policy Expiry Date: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>N/A</strong> </td>
</tr>

</table>';
$content .= '<table class="first"  cellpadding="3" cellspacing="3" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-pre-details td {
    font-family:dejavusans;
    font-size: 9px;
    line-height:10px;
    border-bottom:2px solid #000;
    font-weight:bold; 
}
</style>
<table class="section-pre-details" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540">PREMIUM DETAILS (<span style="font-family:dejavusans;">&#8377;</span>)</td>
</tr>
</table>';
$content .= '<table class="first" cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:6px">&nbsp;</td></tr></table>';
$content .= '<style>
table.section-premium td {
    border-bottom: 1px solid #d3d3d3;
    text-align:right;
    font-family:dejavusans;
    font-size: 8px;
    line-height:18px;
    color:#000;
    font-weight:normal;
}

</style>
<table class="section-premium"  cellpadding="0" cellspacing="0" border="0" style="border: 1px solid #d3d3d3; border-top:none">
<tr>
  <td width="540" bgcolor="#dddddd" style="text-align:left;border:none !important; color:#000;"> &nbsp;Premium Breakup</td>
</tr>
<tr>
  <td width="270" style="text-align:left; "> &nbsp; Basic Third Party Liability </td>
  <td width="270"> '.$exp_policy_data['basic_amount'].'&nbsp; &nbsp; </td>
</tr>
<tr>
  <td width="270" style="text-align:left; color:#000;"> &nbsp; <strong>Net Liability Premium (B)</strong> </td>
  <td width="270" style="color:#000;"> <strong>'.$exp_policy_data['basic_amount'].'&nbsp; &nbsp;</strong> </td>
</tr>
<tr>
  <td width="270" style="text-align:left;"> &nbsp; IGST (18%) </td>
  <td width="270">'.$exp_policy_data['gst_amount'].'&nbsp; &nbsp;  </td>
</tr>
<tr>
  <td width="270" style="text-align:left; color:#000; border:none"> &nbsp; <strong>Total Premium </strong></td>
  <td width="270" style=" border:none; color:#000;"><strong>'.$exp_policy_data['total_amount'].'&nbsp; &nbsp;</strong> </td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:4px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Deductible td {
        font-family:dejavusans;
        font-size: 8px;
        line-height:12px;
		font-weight:normal;
		color:#000;
    }
    </style><table class="section-Deductible" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="120">Geographical Area: </td>
  <td width="60"><strong>India</strong> </td>
  <td width="120">Compulsory Deductible: </td>
  <td width="60" style="font-family:dejavusans; font-weight:bold;"><span style="font-family:dejavusans;">&#8377;</span> 0</td>
  <td width="120">Voluntary Deductible:</td>
  <td width="60" style="font-family:dejavusans;font-weight:bold;"><span style="font-family:dejavusans;">&#8377;</span> 0</td>
</tr>
<tr>
  <td width="120">No-Claim Bonus:</td>
  <td width="60" style="font-family:dejavusans; font-weight:bold;">0 %</td>
  <td width="120">Hypothecation:</td>
  <td width="150" style="font-family:dejavusans; font-weight:bold;">'.$financial_company.'</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" border="0"><tr><td>&nbsp;</td></tr></table>';

$content .= '<style>

    table.section-inter td {
        font-family:dejavusans;
        font-size: 9px;
        line-height:10px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table class="section-inter" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540">INTERMEDIARY DETAILS</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0"  border="0"><tr><td style="line-height:8px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Code td {
        font-family:dejavusans;
        font-size:8px;
        line-height:12px;
        border:0.2px solid #dddddd;
		font-weight:normal;
		padding:5px;
    }
    </style><table class="section-Code" cellpadding="0" cellspacing="0"  border="0">
<tr>
  <td width="120" bgcolor="#dddddd" style="line-height:16px;"> Name</td>
  <td width="50" bgcolor="#dddddd" style="line-height:16px;"> Code </td>
  <td width="70" bgcolor="#dddddd" style="line-height:16px;"> Contact </td>
  <td width="140" bgcolor="#dddddd" style="line-height:16px;"> Email </td>
  <td width="160" bgcolor="#dddddd" style="line-height:16px;"> Address </td>
</tr>
<tr>
  <td width="120"><span style="line-height:4px">&nbsp;</span> Advance india insurance <br /> <span style="display:block;">&nbsp; broker  Pvt limited </span><span style="line-height:4px">&nbsp;</span></td>
  <td width="50"><span style="line-height:4px">&nbsp;</span> 131362 <span style="line-height:4px">&nbsp;</span></td>
  <td width="70"><span style="line-height:4px">&nbsp;</span> 1800212071392 <span style="line-height:4px">&nbsp;</span></td>
  <td width="140"><span style="line-height:4px">&nbsp;</span> support@posadvanceinsurance.com <span style="line-height:4px">&nbsp;</span></td>
  <td width="160"><span style="line-height:4px">&nbsp;</span> DLF Qutab Enclave Ph-1, Gurugram, <br /> <span style="display:block;">&nbsp; Haryana 122002</span> <span style="line-height:4px">&nbsp;</span></td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-pos td {
        font-family:dejavusans;
        font-size:8px;
        line-height:16px;
        border:1px solid #dddddd;
		font-weight:normal;
    }
    </style><table class="section-pos" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="180" bgcolor="#dddddd"> &nbsp; POS Name </td>
  <td width="180" bgcolor="#dddddd"> &nbsp; POS Contact </td>
  <td width="180" bgcolor="#dddddd"> &nbsp; POS ID NO </td>
</tr>
<tr>
  <td width="180" style="line-height:6px;" > &nbsp;</td>
  <td width="180" style="line-height:6px;"> &nbsp;</td>
  <td width="180" style="line-height:6px;"> &nbsp;</td>
</tr>
</table>';
$content .= '<table class="first" cellpadding="20" cellspacing="20" border="0"><tr><td>&nbsp;</td></tr></table>';

$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family:dejavusans;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0"  border="0">
  <tr>
    <td width="300" style="font-size: 9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
    <td  rowspan="8"  align="center" width="80"><br /> <img src="'.$site_url.'assets/images/acko-badge.jpg" alt="" style="text-align:center;width:72px"></td>
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 10px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="300"  style="font-size: 7.5px; line-height:10px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="300"  style="font-size: 7.5px; line-height:10px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="300"  style="font-size:7.5px; line-height:10px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="300"  style="font-size: 7.5px; line-height:10px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="300"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table><br />';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="clear:both;">&nbsp;</td></tr></table><br pagebreak="true" />';

$content .= '<style>
    table.section-inter td {
        font-family:dejavusans;
        font-size: 9px;
        line-height:12px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table class="section-inter" cellpadding="0" cellspacing="0" border="0" >
<tr>
  <td width="540">Limitations As To Use:</td>
</tr>
</table>';
$content .= '<style>
    table.section-space td {
        font-family:dejavusans;
        font-size: 9px;
        line-height:6px;
        font-weight:bold; 
    }
    </style><table class="section-space" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540">&nbsp;</td>
</tr>
</table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        font-family:dejavusans;
        font-size: 8px;
        line-height:12px;
        font-weight:normal;
    }
    </style>
<table class="section" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-size: 8.2px; font-family: helvetica ;">The Policy covers use only under a permit within the meaning of the Motor Vehicle Act 1988 or such a carriage falling under Sub-Section
(3) of Section 66 of the Motor Vehicle’s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials
d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled
vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person including the insured, provided that a person driving holds an
effective driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the
person holding an effective learner’s license may also drive the vehicle when not used for the transport of passengers at the time of
accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules, 1989. <strong>Limits of Liability</strong>. 1.
Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles
Act, 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner -
Driver(CSI): Rs. 0.0 <strong>Terms, Conditions & Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost
on request & the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days
of the Acko Policy Start Date</td>
</tr>
</table>';
$content .='
<table class="section" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-family: helvetica ;font-size: 8.2px;">I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the
provision of chapter X, XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide Receipt/Challan no.
3677100201718 dated 26/10/2017 as prescribed in Government Notification Revenue and Forest Department No. Mudrank
2004/4125/CR/690/M-1, dated 31/12/2004. GSTN: 27AAOCA9055C1ZJ. IMPORTANT NOTICE: The Insured is not indemnified if the vehicle
is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms
appearing in the Certificate in order to comply with the Motor Vehicle Act, 1988 is recoverable from the Insured. See the clause headed
"AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY”. Disclaimer: The Policy shall be void from inception if the premium cheque
is not realized. In the event of misrepresentation, fraud or non-disclosure of material fact, the Company reserves the right to cancel the
Policy. The policy is issued basis the information provided by you, which is available with the company. In case of discrepancy/non
recording of relevant information in the policy, the insured is requested to bring the same to the notice of the company within 15 days.
</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="90" cellspacing="90" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family:dejavusans;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="380" style="font-size: 9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
    
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 10px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="380"  style="font-size:8px; line-height:10px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="clear:both;">&nbsp;</td></tr></table><br pagebreak="true" />';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="80"><img  style="width:72px;" src="'.$site_url.'assets/images/logo.jpg" alt=""> </td>
    <td  width="330" style="font-size: 12px;color: #000;font-weight: bold;line-height:24px; font-family:dejavusans;"> RECEIPT </td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2"  border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0"  border="0">
  <tr>
    <td  width="540" style="font-size:9px;color: #000;font-weight: normal;line-height:16px;font-family:dejavusans;">Receieved with thanks from '.$full_name.' a sum of <span style="font-family:dejavusans;">&#8377;</span> <strong>'.$exp_policy_data['total_amount'].'</strong> towards premium on '.strtoupper($exp_policy_data['ins_type']).' Insurance Policy</td>
  </tr>
</table>'; 
$content .= '<table class="first"  cellpadding="2" cellspacing="2" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-diary td{
    text-align:left;
    font-family:dejavusans;
    font-size: 7.5px;
    line-height:12px;
    color:#000;
    font-weight:normal;
}
</style>
<table class="section-diary" cellpadding="0" cellspacing="1" border="0">
<tr >
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px; line-height: 12px;font-family:dejavusans;color:#000;">INSURED DETAILS</td>
  <td width="30">&nbsp;</td>
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px;line-height: 12px;font-family:dejavusans;color:#000;">INTERMEDIARY DETAILS</td>
</tr>
<tr>
  <td width="100" style="line-height:4px;">&nbsp;</td>
  <td width="155" style="line-height:4px;">&nbsp;</td>
  <td width="30" style="line-height:4px;">&nbsp;</td>
  <td width="100" style="line-height:4px;">&nbsp;</td>
  <td width="155" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Insured Name: </td>
  <td width="155" style="color:#000;"><strong>'.$full_name.'</strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="60">Name : </td>
  <td width="195" style="color:#000;"><strong>Advance india insurance broker Pvt limited</strong></td>
</tr>
<tr>
  <td width="100">Address: </td>
  <td width="155" style="color:#000;"><strong>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].' </strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="60">Code:</td>
  <td width="195" style="color:#000;"><strong>131362</strong></td>
</tr>
<tr>
  <td width="100">GST: </td>
  <td width="155" style="color:#000;"><strong>'.$exp_policy_data['company_gstin'].'</strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="100">&nbsp;</td>
  <td width="155" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Period of Insurance: </td>
  <td width="155" style="color:#000;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="100"> &nbsp;</td>
  <td width="155" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Policy Number :</td>
  <td width="155" style="color:#000;"><strong> '.$policy_no.' </strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="100"> &nbsp;</td>
  <td width="155" style="color:#000;">&nbsp;</td>
</tr>
</table>';

 $content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>

    table.section-pre1 td {
        font-family:dejavusans;
        font-size: 9px;
        line-height:12px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table class="section-pre1" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-family: helvetica ;">PREMIUM DETAILS (<span style="font-family:dejavusans;">&#8377;</span>)</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:6px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Net td {
        border-bottom: 0.5px solid #d3d3d3;
        text-align:right;
        font-family:dejavusans;
        font-size: 8px;
        line-height:18px;
        font-weight:normal;
    }
    </style>
<table class="section-Net"  cellpadding="0" cellspacing="0" border="0" style="border: 1px solid #d3d3d3;">
<tr>
  <td width="270" style="text-align:left;"> &nbsp; Net Premium</td>
  <td width="270"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['basic_amount'].' &nbsp; </td>
</tr>
<tr>
  <td width="270" style="text-align:left;"> &nbsp; IGST (18%) </td>
  <td width="270"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['gst_amount'].' &nbsp; </td>
</tr>
<tr>
  <td width="270" style="text-align:left; border-bottom:none;font-weight:bold"> &nbsp; Total Premium</td>
  <td width="270" style="border-bottom:none;font-weight:bold;">&nbsp; <span style="font-family:dejavusans;">&#8377;</span>'.$exp_policy_data['total_amount'].' &nbsp; </td>
</tr>
</table>';

$content .= '<table class="first"  cellpadding="70" cellspacing="70" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family:dejavusans;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="380" style="font-size:9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
    
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 10px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="380"  style="font-size:8px; line-height:10px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td style="clear:both;">&nbsp;</td></tr></table><br pagebreak="true" />';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="80"><img  style="width:72px;vertical-align: middle;" src="'.$site_url.'assets/images/logo.jpg" alt=""> </td>
    <td  width="310" style="font-size: 12px;color: #000;font-weight: bold;line-height:24px;font-family:dejavusans;"> PROPOSAL </td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="1" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td  width="540" style="font-size: 9px;color: #000;font-weight: normal;line-height:14px;font-family:dejavusans;">Dear '.$full_name.',<br /><br />
	          We wish to inform you that the Insurance policy number <strong>'.$policy_no.'</strong> has been issued on the basis of the information and declaration given by you, the transcript whereof is mentioned below.<br /><br />
	          <span style="font-size:8px;line-height:10px">Please be informed that this Policy shall be construed to be void ab initio/invalid in the event we find that you have not disclosed material or correct information required for the purpose of providing the below insurance cover and in case of any claim arising under the policy in such a scenario, we shall be under no obligation whatsoever to settle such claim to you and the premium paid by you under this policy shall stand fully forfeited.</span>
    </td>
  </tr>
</table>'; 
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-bike td{
    text-align:left;
    font-family:dejavusans;
    font-size:8px;
    line-height:14px;
    color:#000;
    font-weight:normal;
}
</style>
<table class="section-diary" cellpadding="0" cellspacing="0" border="0">
<tr >
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px; line-height: 10px;font-family:dejavusans;color:#000;">POLICY DETAILS</td>
  <td width="30">&nbsp;</td>
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px;line-height: 10px;font-family:dejavusans;color:#000;">CAR DETAILS</td>
</tr>
<tr>
  <td width="125" style="line-height:4px;">&nbsp;</td>
  <td width="130" style="line-height:4px;">&nbsp;</td>
  <td width="30" style="line-height:4px;">&nbsp;</td>
  <td width="125" style="line-height:4px;">&nbsp;</td>
  <td width="130" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="125">Policy Number: </td>
  <td width="130" style="color:#000;"><strong>'.$policy_no.'</strong></td>
  <td width="30">&nbsp;</td>
  <td width="125">Car Number : </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['vehicle_registration_no'].'</strong></td>
</tr>
<tr>
<td rowspan="2" width="125">Period of Insurance: </td>
<td rowspan="2" width="130" style="color:#000;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong></td>
<td width="30">&nbsp;</td>
<td width="125">Make/Model: </td>
<td width="130" style="color:#000;"><strong>'.$exp_policy_data['make_model'].' </strong></td>
</tr>
<tr>
<td width="30">&nbsp;</td>
<td width="125">Fuel Type: </td>
<td width="130" style="color:#000;"><strong>'.$exp_policy_data['fuel_type'].' </strong></td>
</tr>
<tr>
<td width="125">Policy Issuance Date: </td>
<td width="130" style="color:#000;"><strong>'.$insurance_date.'</strong> </td>
<td width="30">&nbsp;</td>
<td width="125">Registration Year: </td>
<td width="130" style="color:#000;"><strong>'.$exp_policy_data['registration_year'].'</strong> </td>

</tr>
<tr>
<td width="125"> &nbsp;</td>
<td width="130" style="color:#000;">&nbsp;</td>
<td width="30">&nbsp;</td>
<td width="125">Manufacturing Year: </td>
<td width="130" style="color:#000;"><strong>'.$mfg_date.' </strong> </td>
</tr>
<tr>
<td width="125"> &nbsp;</td>
<td width="130" style="color:#000;">&nbsp;</td>
<td width="30">&nbsp;</td>
<td width="125">Insured Declared Value (IDV): </td>
<td width="130" style="color:#000;"><strong>N/A </strong> </td> 
</tr>
<tr>
<td width="125"> &nbsp;</td>
<td width="130" style="color:#000;">&nbsp;</td>
<td width="30">&nbsp;</td>
<td width="125">Accessories (IDV): </td>
<td width="130" style="color:#000;"><strong>0 </strong> </td> 

</tr>
</table>';

 $content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-owner td{
    text-align:left;
    font-family:dejavusans;
    font-size: 8px;
    line-height:12px;
        color:#000;
        font-weight:normal;
}
</style>

<table class="section-owner" cellpadding="0" cellspacing="0" border="0">
<tr >
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px; line-height:10px;    color:#000">CAR OWNER DETAILS</td>
  <td width="30">&nbsp;</td>
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px;line-height: 10px;    color:#000">NOMINEE DETAILS</td>
</tr>
<tr>
  <td width="125" style="line-height:4px;">&nbsp;</td>
  <td width="130" style="line-height:4px;">&nbsp;</td>
  <td width="30" style="line-height:4px;">&nbsp;</td>
  <td width="125" style="line-height:4px;">&nbsp;</td>
  <td width="130" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="125">Name: </td>
  <td width="130" style="color:#000;"><strong>'.$full_name.'</strong> </td>
  <td width="30">&nbsp;</td>
  <td width="125">Name: </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['nominee_name'].' </strong> </td>
</tr>
<tr>
  <td width="125">Email Address:  </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['email'].'</strong> </td>
  <td width="30">&nbsp;</td>
  <td width="125">Relationship with Insured: </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['nominee_relation'].' </strong> </td>
</tr>
<tr>
  <td width="125">Mobile Number: </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['phone_no'].' </strong> </td>
  <td width="30">&nbsp;</td>
  <td width="125"> &nbsp; </td>
  <td width="130" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  
  <td width="125">Pincode: </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['primary_pin_code'].' </strong></td>
  <td width="30">&nbsp;</td>
  <td width="125">&nbsp;</td>
  <td width="130" style="color:#000;">&nbsp;</td>
</tr>

</table>';

$content .= '<table class="first"  cellpadding="0" cellspacing="1"  border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-pos td {
        font-family:dejavusans;
        font-size:8px;
        line-height:16px;
        border:1px solid #dddddd;
		font-weight:normal;
    }
    </style><table class="section-pos" cellpadding="0" cellspacing="0"  border="0">
<tr>
  <td width="300" bgcolor="#dddddd"> &nbsp; Covers </td>
  <td width="120" bgcolor="#dddddd"> &nbsp; Opted </td>
  <td width="120" bgcolor="#dddddd"> &nbsp; Not Opted </td>
</tr>
<tr>
  <td width="180" style="line-height:16px;" > &nbsp; Zero Depreciation</td>
  <td width="180" style="line-height:16px;"> &nbsp; - </td>
  <td width="180" style="line-height:16px;"> &nbsp; <img style="text-align:center; width:auto; height:7px;" src="'.$site_url.'assets/admin/images/check.jpg" alt=""></td>
</tr>
<tr>
  <td width="180" style="line-height:16px;"> &nbsp; Consumables </td>
  <td width="180" style="line-height:16px;"> &nbsp; - </td>
  <td width="180" style="line-height:16px;"> &nbsp; <img style="text-align:center; width:auto; height:7px;" src="'.$site_url.'assets/admin/images/check.jpg" alt=""></td>
</tr>
</table>';

$content .= '<table class="first"  cellpadding="30" cellspacing="30"  border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    font-family:dejavusans;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="380" style="font-size:9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
    
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 10px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="380"  style="font-size:8px; line-height:10px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table>';
	
  }
  else{
  $content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="80" ><img style="width:72px;vertical-align: middle;" src="'.$site_url.'assets/images/logo.jpg" alt=""  align="middle"></td>
  <td  width="400" style="font-size: 12px;color: #000;font-weight: bold;line-height:12px;font-family:dejavusans;"><span >LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</span><br />
  <span style="font-family:dejavusans;font-size: 9px;color: #000;font-weight: normal;line-height:10px;">Certificate of Insurance cum Policy Schedule</span></td>
 </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:2px;">&nbsp;</td></tr></table>';
$content .= '
<style>
.vehicle-section td{
font-size:7.5px;
color:#000;
font-family:dejavusans;
font-weight:normal;
text-align:left;
line-height:9px;

}
</style>
<table class="vehicle-section" cellpadding="0" cellspacing="0" border="0">
<tr >
  <td width="220" style="line-height:10px;font-weight:bold;font-size:9px;border-bottom:2px solid #000;color:#000;">POLICY DETAILS</td>
  <td width="30">&nbsp;</td>
  <td width="220" style="line-height:10px;font-weight:bold;font-size:9px;border-bottom:2px solid #000;color:#000;">VEHICLE DETAILS</td>
  <td rowspan="8" width="70" ><img style="width:70px;" align="right" src="'.$qrcode_img.'" alt=""></td>
</tr>
<tr>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="30" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
  <td width="110" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="110" style="line-height:12px;">Insured Name: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$full_name.'</strong></td>
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Registration Number:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['vehicle_registration_no'].'</strong> </td>
</tr>
<tr>
  <td width="110"  rowspan="2" style="line-height:12px;">Address: </td>
  <td width="110"  rowspan="2" style="color:#000;line-height:10px;text-transform: lowercase;"><strong>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].'</strong></td>
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Make/Model:</td>
  <td width="110" style="color:#000;line-height:10px;"><strong>'.$exp_policy_data['make_model'].' </strong> </td>
</tr>
<tr>
  
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Registration Year:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['registration_year'].'</strong> </td>
</tr>
<tr>
<td width="110" style="line-height:12px;">Pincode: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['primary_pin_code'].'</strong> </td>
  
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Manufacturing Year: </td>
  <td width="110" style="color:#000;line-height:12px; "><strong>'.$mfg_date.'</strong> </td>
</tr>
<tr>
<td width="110" style="line-height:12px;">GSTIN: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['company_gstin'].'</strong> </td>
  
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Seating Capacity : </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>2 </strong> </td>
</tr>
<tr>
<td width="110" rowspan="2" style="line-height:12px;">Period of Insurance: </td>
  <td width="110" rowspan="2" style="color:#000;line-height:12px;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong> </td>
  
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Fuel Type:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['fuel_type'].' </strong></td>
</tr>
<tr>
  <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Engine No: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.strtoupper($exp_policy_data['engine_no']).' </strong> </td>
  
</tr>
<tr>
 <td width="110" style="line-height:12px;">Policy Issuance Date:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$insurance_date.' </strong> </td>
   <td width="30">&nbsp;</td>
  <td width="110" style="line-height:12px;">Chassis No:</td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.strtoupper($exp_policy_data['chassis_no']).' </strong> </td>
</tr>
<tr>
<td  width="110" style="line-height:12px;">Policy Number: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$policy_no.'</strong> </td>
</tr>
<tr>

<td  width="110" style="line-height:12px;">Nominee: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['nominee_name'].', '.$exp_policy_data['nominee_relation'].', '.$exp_policy_data['nominee_age'].' </strong> </td>
</tr>
<tr>
  <td  width="110" style="line-height:12px;">Owner Number: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>'.$exp_policy_data['phone_no'].'</strong> </td>
</tr>
<tr>
  <td  width="110" style="line-height:12px;">Previous Policy Expiry Date: </td>
  <td width="110" style="color:#000;line-height:12px;"><strong>N/A</strong> </td>
</tr>

</table>';
$content .= '<table class="first"  cellpadding="3" cellspacing="3" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-pre-details td {
    font-family:dejavusans;
    font-size: 9px;
    line-height:10px;
    border-bottom:2px solid #000;
    font-weight:bold; 
}
</style>
<table class="section-pre-details" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540">PREMIUM DETAILS (<span style="font-family:dejavusans;">&#8377;</span>)</td>
</tr>
</table>';
$content .= '<table class="first" cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:6px">&nbsp;</td></tr></table>';
$content .= '<style>
table.section-premium td {
    border-bottom: 1px solid #d3d3d3;
    text-align:right;
    font-family:dejavusans;
    font-size: 8px;
    line-height:18px;
    color:#000;
    font-weight:normal;
}

</style>
<table class="section-premium"  cellpadding="0" cellspacing="0" border="0" style="border: 1px solid #d3d3d3; border-top:none">
<tr>
  <td width="540" bgcolor="#dddddd" style="text-align:left;border:none !important; color:#000;"> &nbsp;Premium Breakup</td>
</tr>
<tr>
  <td width="270" style="text-align:left; "> &nbsp; Basic Third Party Liability </td>
  <td width="270"> '.$exp_policy_data['basic_amount'].'&nbsp; &nbsp; </td>
</tr>
<tr>
  <td width="270" style="text-align:left; color:#000;"> &nbsp; <strong>Net Liability Premium (B)</strong> </td>
  <td width="270" style="color:#000;"> <strong>'.$exp_policy_data['basic_amount'].'&nbsp; &nbsp;</strong> </td>
</tr>
<tr>
  <td width="270" style="text-align:left;"> &nbsp; IGST (18%) </td>
  <td width="270">'.$exp_policy_data['gst_amount'].'&nbsp; &nbsp;  </td>
</tr>
<tr>
  <td width="270" style="text-align:left; color:#000; border:none"> &nbsp; <strong>Total Premium </strong></td>
  <td width="270" style=" border:none; color:#000;"><strong>'.$exp_policy_data['total_amount'].'&nbsp; &nbsp;</strong> </td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:4px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Deductible td {
        font-family:dejavusans;
        font-size: 8px;
        line-height:12px;
		font-weight:normal;
		color:#000;
    }
    </style><table class="section-Deductible" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="120">Geographical Area: </td>
  <td width="60"><strong>India</strong> </td>
  <td width="120">Compulsory Deductible: </td>
  <td width="60" style="font-family:dejavusans; font-weight:bold;"><span style="font-family:dejavusans;">&#8377;</span> 0</td>
  <td width="120">Voluntary Deductible:</td>
  <td width="60" style="font-family:dejavusans;font-weight:bold;"><span style="font-family:dejavusans;">&#8377;</span> 0</td>
</tr>
<tr>
  <td width="120">No-Claim Bonus:</td>
  <td width="60" style="font-family:dejavusans; font-weight:bold;">0 %</td>
  <td width="120">Hypothecation:</td>
  <td width="150" style="font-family:dejavusans; font-weight:bold;">'.$financial_company.'</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" border="0"><tr><td>&nbsp;</td></tr></table>';

$content .= '<style>

    table.section-inter td {
        font-family:dejavusans;
        font-size: 9px;
        line-height:10px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table class="section-inter" cellpadding="0" cellspacing="0"  border="0">
<tr>
  <td width="540">INTERMEDIARY DETAILS</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:8px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Code td {
        font-family:dejavusans;
        font-size:8px;
        line-height:12px;
        border:0.2px solid #dddddd;
		font-weight:normal;
		padding:5px;
    }
    </style><table class="section-Code" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="120" bgcolor="#dddddd" style="line-height:16px;"> Name</td>
  <td width="50" bgcolor="#dddddd" style="line-height:16px;"> Code </td>
  <td width="70" bgcolor="#dddddd" style="line-height:16px;"> Contact </td>
  <td width="140" bgcolor="#dddddd" style="line-height:16px;"> Email </td>
  <td width="160" bgcolor="#dddddd" style="line-height:16px;"> Address </td>
</tr>
<tr>
  <td width="120"><span style="line-height:4px">&nbsp;</span> Advance india insurance <br /> <span style="display:block;">&nbsp; broker  Pvt limited </span><span style="line-height:4px">&nbsp;</span></td>
  <td width="50"><span style="line-height:4px">&nbsp;</span> 131362 <span style="line-height:4px">&nbsp;</span></td>
  <td width="70"><span style="line-height:4px">&nbsp;</span> 1800212071392 <span style="line-height:4px">&nbsp;</span></td>
  <td width="140"><span style="line-height:4px">&nbsp;</span> support@posadvanceinsurance.com <span style="line-height:4px">&nbsp;</span></td>
  <td width="160"><span style="line-height:4px">&nbsp;</span> DLF Qutab Enclave Ph-1, Gurugram, <br /> <span style="display:block;">&nbsp; Haryana 122002</span> <span style="line-height:4px">&nbsp;</span></td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-pos td {
        font-family:dejavusans;
        font-size:8px;
        line-height:16px;
        border:1px solid #dddddd;
		font-weight:normal;
    }
    </style><table class="section-pos" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="180" bgcolor="#dddddd"> &nbsp; POS Name </td>
  <td width="180" bgcolor="#dddddd"> &nbsp; POS Contact </td>
  <td width="180" bgcolor="#dddddd"> &nbsp; POS ID NO </td>
</tr>
<tr>
  <td width="180" style="line-height:6px;" > &nbsp;</td>
  <td width="180" style="line-height:6px;"> &nbsp;</td>
  <td width="180" style="line-height:6px;"> &nbsp;</td>
</tr>
</table>';
$content .= '<table class="first" cellpadding="20" cellspacing="20" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';

$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family:dejavusans;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0"  border="0">
  <tr>
    <td width="300" style="font-size: 9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
    <td  rowspan="8"  align="center" width="80"><br /> <img src="'.$site_url.'assets/images/acko-badge.jpg" alt="" style="text-align:center;width:72px"></td>
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 10px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="300"  style="font-size: 7.5px; line-height:10px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="300"  style="font-size: 7.5px; line-height:10px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="300"  style="font-size:7.5px; line-height:10px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="300"  style="font-size: 7.5px; line-height:10px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="300"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table><br />';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="clear:both;">&nbsp;</td></tr></table><br pagebreak="true" />';

$content .= '<style>
    table.section-inter td {
        font-family:dejavusans;
        font-size: 9px;
        line-height:12px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table class="section-inter" cellpadding="0" cellspacing="0" border="0" >
<tr>
  <td width="540">Limitations As To Use:</td>
</tr>
</table>';
$content .= '<style>
    table.section-space td {
        font-family:dejavusans;
        font-size: 9px;
        line-height:6px;
        font-weight:bold; 
    }
    </style><table class="section-space" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540">&nbsp;</td>
</tr>
</table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        font-family:dejavusans;
        font-size: 8px;
        line-height:12px;
        font-weight:normal;
    }
    </style>
<table class="section" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-size: 8.2px; font-family: helvetica ;">The Policy covers use only under a permit within the meaning of the Motor Vehicle Act 1988 or such a carriage falling under Sub-Section
(3) of Section 66 of the Motor Vehicle’s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials
d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled
vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person including the insured, provided that a person driving holds an
effective driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the
person holding an effective learner’s license may also drive the vehicle when not used for the transport of passengers at the time of
accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules, 1989. <strong>Limits of Liability</strong>. 1.
Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles
Act, 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner -
Driver(CSI): Rs. 0.0 <strong>Terms, Conditions & Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost
on request & the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days
of the Acko Policy Start Date</td>
</tr>
</table>';
$content .='
<table class="section" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-family: helvetica ;font-size: 8.2px;">I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the
provision of chapter X, XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide Receipt/Challan no.
3677100201718 dated 26/10/2017 as prescribed in Government Notification Revenue and Forest Department No. Mudrank
2004/4125/CR/690/M-1, dated 31/12/2004. GSTN: 27AAOCA9055C1ZJ. IMPORTANT NOTICE: The Insured is not indemnified if the vehicle
is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms
appearing in the Certificate in order to comply with the Motor Vehicle Act, 1988 is recoverable from the Insured. See the clause headed
"AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY”. Disclaimer: The Policy shall be void from inception if the premium cheque
is not realized. In the event of misrepresentation, fraud or non-disclosure of material fact, the Company reserves the right to cancel the
Policy. The policy is issued basis the information provided by you, which is available with the company. In case of discrepancy/non
recording of relevant information in the policy, the insured is requested to bring the same to the notice of the company within 15 days.
</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="90" cellspacing="90" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family:dejavusans;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="380" style="font-size: 9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
    
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 10px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="380"  style="font-size:8px; line-height:10px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="clear:both;">&nbsp;</td></tr></table><br pagebreak="true" />';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="80"><img  style="width:72px;" src="'.$site_url.'assets/images/logo.jpg" alt=""> </td>
    <td  width="330" style="font-size: 12px;color: #000;font-weight: bold;line-height:24px; font-family:dejavusans;"> RECEIPT </td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2"  border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0"  border="0">
  <tr>
    <td  width="540" style="font-size:9px;color: #000;font-weight: normal;line-height:16px;font-family:dejavusans;">Receieved with thanks from '.$full_name.' a sum of <span style="font-family:dejavusans;">&#8377;</span> <strong>'.$exp_policy_data['total_amount'].'</strong> towards premium on '.strtoupper($exp_policy_data['ins_type']).' Insurance Policy</td>
  </tr>
</table>'; 
$content .= '<table class="first"  cellpadding="2" cellspacing="2" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-diary td{
    text-align:left;
    font-family:dejavusans;
    font-size: 7.5px;
    line-height:12px;
    color:#000;
    font-weight:normal;
}
</style>
<table class="section-diary" cellpadding="0" cellspacing="1" border="0">
<tr >
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px; line-height: 12px;font-family:dejavusans;color:#000;">INSURED DETAILS</td>
  <td width="30">&nbsp;</td>
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px;line-height: 12px;font-family:dejavusans;color:#000;">INTERMEDIARY DETAILS</td>
</tr>
<tr>
  <td width="100" style="line-height:4px;">&nbsp;</td>
  <td width="155" style="line-height:4px;">&nbsp;</td>
  <td width="30" style="line-height:4px;">&nbsp;</td>
  <td width="100" style="line-height:4px;">&nbsp;</td>
  <td width="155" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Insured Name: </td>
  <td width="155" style="color:#000;"><strong>'.$full_name.'</strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="60">Name : </td>
  <td width="195" style="color:#000;"><strong>Advance india insurance broker Pvt limited</strong></td>
</tr>
<tr>
  <td width="100">Address: </td>
  <td width="155" style="color:#000;"><strong>'.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].' </strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="60">Code:</td>
  <td width="195" style="color:#000;"><strong>131362</strong></td>
</tr>
<tr>
  <td width="100">GST: </td>
  <td width="155" style="color:#000;"><strong>'.$exp_policy_data['company_gstin'].'</strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="100">&nbsp;</td>
  <td width="155" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Period of Insurance: </td>
  <td width="155" style="color:#000;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="100"> &nbsp;</td>
  <td width="155" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  <td width="100">Policy Number :</td>
  <td width="155" style="color:#000;"><strong> '.$policy_no.' </strong> </td>
  <td width="30" >&nbsp;</td>
  <td width="100"> &nbsp;</td>
  <td width="155" style="color:#000;">&nbsp;</td>
</tr>
</table>';

 $content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>

    table.section-pre1 td {
        font-family:dejavusans;
        font-size: 9px;
        line-height:12px;
        border-bottom:2px solid #000;
        font-weight:bold; 
    }
    </style><table class="section-pre1" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="540" style="font-family: helvetica ;">PREMIUM DETAILS (<span style="font-family:dejavusans;">&#8377;</span>)</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" border="0"><tr><td style="line-height:6px">&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Net td {
        border-bottom: 0.5px solid #d3d3d3;
        text-align:right;
        font-family:dejavusans;
        font-size: 8px;
        line-height:18px;
        font-weight:normal;
    }
    </style>
<table class="section-Net"  cellpadding="0" cellspacing="0" border="0" style="border: 1px solid #d3d3d3;">
<tr>
  <td width="270" style="text-align:left;"> &nbsp; Net Premium</td>
  <td width="270"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['basic_amount'].' &nbsp; </td>
</tr>
<tr>
  <td width="270" style="text-align:left;"> &nbsp; IGST (18%) </td>
  <td width="270"><span style="font-family:dejavusans;">&#8377;</span> '.$exp_policy_data['gst_amount'].' &nbsp; </td>
</tr>
<tr>
  <td width="270" style="text-align:left; border-bottom:none;font-weight:bold"> &nbsp; Total Premium</td>
  <td width="270" style="border-bottom:none;font-weight:bold;">&nbsp; <span style="font-family:dejavusans;">&#8377;</span>'.$exp_policy_data['total_amount'].' &nbsp; </td>
</tr>
</table>';

$content .= '<table class="first"  cellpadding="80" cellspacing="80" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family:dejavusans;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="380" style="font-size:9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
    
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 10px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="380"  style="font-size:8px; line-height:10px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td style="clear:both;">&nbsp;</td></tr></table><br pagebreak="true" />';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="80"><img  style="width:72px;vertical-align: middle;" src="'.$site_url.'assets/images/logo.jpg" alt=""> </td>
    <td  width="310" style="font-size: 12px;color: #000;font-weight: bold;line-height:24px;font-family:dejavusans;"> PROPOSAL </td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="1" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td  width="540" style="font-size: 9px;color: #000;font-weight: normal;line-height:14px;font-family:dejavusans;">Dear '.$full_name.',<br /><br />
	          We wish to inform you that the Insurance policy number <strong>'.$policy_no.'</strong> has been issued on the basis of the information and declaration given by you, the transcript whereof is mentioned below.<br /><br />
	          <span style="font-size:8px;line-height:10px">Please be informed that this Policy shall be construed to be void ab initio/invalid in the event we find that you have not disclosed material or correct information required for the purpose of providing the below insurance cover and in case of any claim arising under the policy in such a scenario, we shall be under no obligation whatsoever to settle such claim to you and the premium paid by you under this policy shall stand fully forfeited.</span>
    </td>
  </tr>
</table>'; 
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-bike td{
    text-align:left;
    font-family:dejavusans;
    font-size:8px;
    line-height:14px;
    color:#000;
    font-weight:normal;
}
</style>
<table class="section-diary" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr >
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px; line-height: 10px;font-family:dejavusans;color:#000;">POLICY DETAILS</td>
  <td width="30">&nbsp;</td>
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px;line-height: 10px;font-family:dejavusans;color:#000;">BIKE DETAILS</td>
</tr>
<tr>
  <td width="125" style="line-height:4px;">&nbsp;</td>
  <td width="130" style="line-height:4px;">&nbsp;</td>
  <td width="30" style="line-height:4px;">&nbsp;</td>
  <td width="125" style="line-height:4px;">&nbsp;</td>
  <td width="130" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="125">Policy Number: </td>
  <td width="130" style="color:#000;"><strong>'.$policy_no.'</strong></td>
  <td width="30">&nbsp;</td>
  <td width="125">Bike Number : </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['vehicle_registration_no'].'</strong></td>
</tr>
<tr>
<td rowspan="2" width="125">Period of Insurance: </td>
<td rowspan="2" width="130" style="color:#000;"><strong>'.$payment_date.' to '.$policy_exp_date.' </strong></td>
<td width="30">&nbsp;</td>
<td width="125">Make/Model: </td>
<td width="130" style="color:#000;"><strong>'.$exp_policy_data['make_model'].' </strong></td>
</tr>
<tr>
<td width="30">&nbsp;</td>
<td width="125">Fuel Type: </td>
<td width="130" style="color:#000;"><strong>'.$exp_policy_data['fuel_type'].' </strong></td>
</tr>
<tr>
<td width="125">Policy Issuance Date: </td>
<td width="130" style="color:#000;"><strong>'.$insurance_date.'</strong> </td>
<td width="30">&nbsp;</td>
<td width="125">Registration Year: </td>
<td width="130" style="color:#000;"><strong>'.$exp_policy_data['registration_year'].'</strong> </td>

</tr>
<tr>
<td width="125"> &nbsp;</td>
<td width="130" style="color:#000;">&nbsp;</td>
<td width="30">&nbsp;</td>
<td width="125">Manufacturing Year: </td>
<td width="130" style="color:#000;"><strong>'.$mfg_date.' </strong> </td>
</tr>
<tr>
<td width="125"> &nbsp;</td>
<td width="130" style="color:#000;">&nbsp;</td>
<td width="30">&nbsp;</td>
<td width="125">Insured Declared Value (IDV): </td>
<td width="130" style="color:#000;"><strong>N/A </strong> </td> 
</tr>
<tr>
<td width="125"> &nbsp;</td>
<td width="130" style="color:#000;">&nbsp;</td>
<td width="30">&nbsp;</td>
<td width="125">Accessories (IDV): </td>
<td width="130" style="color:#000;"><strong>0 </strong> </td> 

</tr>
</table>';

 $content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-owner td{
    text-align:left;
    font-family:dejavusans;
    font-size: 8px;
    line-height:12px;
        color:#000;
        font-weight:normal;
}
</style>

<table class="section-owner" cellpadding="0" cellspacing="0" border="0">
<tr >
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px; line-height:10px;    color:#000">BIKE OWNER DETAILS</td>
  <td width="30">&nbsp;</td>
  <td width="255" style="border-bottom:2px solid #000; font-weight:bold; font-size:9px;line-height: 10px;    color:#000">NOMINEE DETAILS</td>
</tr>
<tr>
  <td width="125" style="line-height:4px;">&nbsp;</td>
  <td width="130" style="line-height:4px;">&nbsp;</td>
  <td width="30" style="line-height:4px;">&nbsp;</td>
  <td width="125" style="line-height:4px;">&nbsp;</td>
  <td width="130" style="line-height:4px;">&nbsp;</td>
</tr>
<tr>
  <td width="125">Name: </td>
  <td width="130" style="color:#000;"><strong>'.$full_name.'</strong> </td>
  <td width="30">&nbsp;</td>
  <td width="125">Name: </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['nominee_name'].' </strong> </td>
</tr>
<tr>
  <td width="125">Email Address:  </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['email'].'</strong> </td>
  <td width="30">&nbsp;</td>
  <td width="125">Relationship with Insured: </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['nominee_relation'].' </strong> </td>
</tr>
<tr>
  <td width="125">Mobile Number: </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['phone_no'].' </strong> </td>
  <td width="30">&nbsp;</td>
  <td width="125"> &nbsp; </td>
  <td width="130" style="color:#000;">&nbsp;</td>
</tr>
<tr>
  
  <td width="125">Pincode: </td>
  <td width="130" style="color:#000;"><strong>'.$exp_policy_data['primary_pin_code'].' </strong></td>
  <td width="30">&nbsp;</td>
  <td width="125">&nbsp;</td>
  <td width="130" style="color:#000;">&nbsp;</td>
</tr>

</table>';


$content .= '<table class="first"  cellpadding="55" cellspacing="55"  border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    font-family:dejavusans;
    font-weight:normal;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="380" style="font-size:9px;line-height:18px;font-weight:bold">Acko General Insurance Ltd.</td>
    
      
      <td rowspan="8"   align="center" width="160"><img style="text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 12px;font-size: 10px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
    <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">Goregaon (E), Mumbai – 400063.</td>
  </tr>
   <tr>
    <td width="380"  style="font-size:8px; line-height:10px">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com</td>
  </tr>
   <tr>
    <td width="380"  style="font-size: 8px; line-height:10px">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | </td>
  </tr>
  <tr>
    <td width="380"  style="font-size: 8px; line-height:12px">UIN: IRDAN157P0002V01201718</td>
  </tr>
</table>';
 
  }
  
  return $content;
}
?>
