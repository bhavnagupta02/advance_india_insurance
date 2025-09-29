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

  	$content .= '<table class="first"  cellpadding="0" cellspacing="0" width="100%" border="0">
 <tr>
  <td  width="120"><img src="'.$site_url.'assets/images/logo.jpg" alt=""></td>
  <td  width="300" style="font-size: 15px;color: #000;font-weight: bold;line-height:20px;"><span >LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</span>
  <span style="font-family:Arial, Helvetica, sans-serif;font-size: 13px;color: #000;font-weight: normal;line-height: 20px;">Certificate of Insurance cum Policy Schedule</span></td>
   <td rowspan="6" width="100" ><img style="width:80px;" align="right" src="'.$site_url.'assets/images/scan.jpg" alt=""></td>
 </tr>
</table>';
$content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr >
 <td width="265" style="padding: 0px;font-weight:bold; font-family: Arial;line-height: 30px;padding-bottom: 4px;margin-bottom: 10px;font-size:13px;border-bottom:1px solid #000">POLICY DETAILS</td>
 <td width="265" style="padding: 0px;font-weight:bold; font-family: Arial;line-height: 30px;padding-bottom: 4px;margin-bottom: 10px;font-size:13px;border-bottom:1px solid #000">VEHICLE DETAILS</td>

</tr>

<tr>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Insured Name: <span>'.$full_name.' </span></td>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Registration Number:<span>'.$exp_policy_data['vehicle_registration_no'].' </span></td>
</tr>
<tr>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Pincode: <span>'.$exp_policy_data['primary_pin_code'].' </span></td>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Make/Model:<span>'.$exp_policy_data['make_model'].' </span></td>
</tr>
<tr>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Company Name: <span>'.$exp_policy_data['company_name'].' </span></td>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Fuel Type: <span>'.$exp_policy_data['fuel_type'].' </span></td>
</tr>
<tr>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">GSTIN: <span>'.$exp_policy_data['company_gstin'].' </span></td>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Purchase Year: <span> '.$exp_policy_data['registration_year'].' </span></td>
</tr>
<tr>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Period of Insurance: <span> '.$payment_date.' to '.$policy_exp_date.' </span></td>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;"> Engine No: <span>'.$exp_policy_data['engine_no'].' </span></td>
</tr>
<tr>
  <td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Policy Insurance Date:<span> '.$insurance_date.'</span></td>
  <td width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:v;line-height:16px;">Chassis No:<span>'.$exp_policy_data['chassis_no'].'</span></td>
</tr>
<tr>
<td  width="265" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Policy Number: <span>'.$exp_policy_data['policy_no'].'/00</span></td>
</tr>

</table>';
$content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>

    table.section-pre td {
        font-family: Arial;
        font-size: 14px;
        line-height:30px;
        border-bottom:1px solid #000;
        font-weight:bold; 
    }
    </style><table width="530" class="section-pre" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530">PREMIUM DETAILS (₹)</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>

    table.section-premium td {
        border-bottom: 1px solid #d3d3d3;
        text-align:right;
        padding:15px;
        font-family: Arial;
        font-size: 11px;
        line-height:24px;
    }
    </style>
<table width="530" class="section-premium"  cellpadding="0" cellspacing="0" width="100%" border="0" style="border: 1px solid #d3d3d3;">
<tr>
  <td width="530" bgcolor="#f5f5f5" style="text-align:left;"> Premium Breakup</td>
</tr>
<tr>
  <td width="265" style="text-align:left;"> Basic Third Party Liability </td>
  <td width="265"> '.$exp_policy_data['basic_amount'].' </td>
</tr>
<tr>
  <td width="265" style="text-align:left;"> Net Liability Premium (B) </td>
  <td width="265"> '.$exp_policy_data['basic_amount'].' </td>
</tr>
<tr>
  <td width="265" style="text-align:left;"> IGST (18%) </td>
  <td width="265"> '.$exp_policy_data['gst_amount'].' </td>
</tr>
<tr>
  <td width="265" style="text-align:left; border:none"> Total Premium </td>
  <td width="265" style=" border:none"> '.$exp_policy_data['total_amount'].' </td>
</tr>
</table>';

$content .= '<style>

    table.section-Geographical td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 11px;
        line-height:30px;
    }
    </style><table width="530" class="section-Geographical" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="130">Geographical Area:</td>
  <td width="130">India</td>
</tr>
</table>';

$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table width="530" class="section-note" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530" style="font-size: 10px;" ><strong>Please Note:</strong>In case of a claim event arising within 30 days from the start of this Policy&cedil; the Insured is required to submit a copy of his Previous Insurance Policy.</td>
</tr>
</table>
';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530" style="font-size: 10px;"><strong>Limitations As To Use:</strong> The Policy covers use only under a permit within the meaning of the Motor Vehicle Act (M V Act) 1988 or such a carriage falling under Sub-Section (3) of Section 66 of the Motor Vehicle&acute;s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person (including the insured)&cedil; provided that a person driving holds a valid driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the person holding a valid learner&acute;s license may also drive the vehicle when not used for the transport of passengers at the time of accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules&cedil; 1989. <strong>Limits of Liability.</strong> 1. Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles Act&cedil; 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner - Driver(CSI): Rs. 0.0 <strong>Terms&cedil; Conditions & Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost on request & the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days of the Acko Policy Start Date.</td>
</tr>
</table>
';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530" style="font-size: 10px;">I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the provision of chapter X&cedil; XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide GRAS Deface no. 0004976826201920 dated 19/12/2019 as prescribed in Government Notification Revenue & Forest Department No. Mudrank - 2017/C.R.97/M-1&cedil; dated 09/01/2018 . GSTN: 27AAOCA9055C1ZJ. <strong>IMPORTANT NOTICE:</strong> The Insured is not indemnified if the vehicle is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms appearing in the Certificate in order to comply with the Motor Vehicle Act&cedil; 1988 is recoverable from the Insured. See the clause headed "AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY" in the policy wordings. <strong>Disclaimer</strong>: The Policy shall be void from inception if the premium cheque is not realized. In the event of misrepresentation&cedil; fraud or non-disclosure of material fact&cedil; the Company reserves the right to cancel the Policy. The policy is issued basis the information provided by you&cedil; which is available with the company. In case of discrepancy/non recording of relevant information in the policy&cedil; the insured is requested to bring the same to the notice of the company within 15 days. This Policy is to be read in conjunction with the Policy wordings <a href="https://www.acko.com/download">(https://www.acko.com/download)</a> available on the website of the Company. On renewal&cedil; the benefits provided under the policy and/or terms and conditions of the policy including premium rate may be subject to change.</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-insurance td {
    text-align:left;
    padding:15px;
    font-family: Arial;
    font-size: 14px;
    line-height:30px;
    font-weight:bold; 
    }
    </style>
<table class="section-insurance" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
<td width="530" style="border-bottom:1px solid #000">INTERMEDIARY DETAILS</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-Advance td {
    border: 1px solid #000;
    text-align:left;
    padding:15px;
    font-family: Arial;
    font-size: 10px;
    line-height:24px;
    }
    </style><table  class="section-Advance" cellpadding="0" cellspacing="0" width="100%" border="0">
    
  <tr>
     <td width="265"> Policy Issuing Office: <span style="text-align:right"> Direct - Mumbai</span></td>
	 <td width="265"> Intermediary Name: <span style="text-align:right">Direct</span> </td>
	 </tr>
	 <tr>
	 <td width="265"> +917551196988<span style="text-align:right"> Phone Number:</span><span style="text-align:right">N/A</span></td>
	 <td width="265"> Intermediary Code:<span style="text-align:right"> N/A</span></td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-general td{
    text-align:left;
    padding:15px;
    font-family: Arial;
    line-height:18px;
    }
</style>
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="380"><span style="font-size: 14px;line-height:24px;">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 10px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 9px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    <td  align="center" width="150"><img style="text-align:center;border-bottom:1px solid #000;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 16px;font-size: 9px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
  }
  else{
  	$content .= '<table class="first" cellpadding="0" cellspacing="0">
 <tr>
  <td width="120" ><img src="'.$site_url.'assets/images/logo.jpg" alt=""></td>
  <td width="350"><span style="font-size: 16px;color: #000;font-weight:bold; line-height:20px;">LIABILITY ONLY POLICY - PRIVATE '.strtoupper($exp_policy_data['ins_type']).'</span>
  <span style="font-family:Arial, Helvetica, sans-serif;font-size: 13px;color: #000;font-weight: normal;line-height: 20px;">Certificate of Insurance cum Policy Schedule</span></td>
 </tr>
</table>';	
$content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>';
$content .= '<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr >
  <td width="215" style="padding: 0px;font-family: Arial;line-height: 30px;padding-bottom: 4px;font-weight:bold; margin-bottom: 10px;font-size:13px;border-bottom:1px solid #000">POLICY DETAILS</td>
  <td width="215" style="padding: 0px;font-family: Arial;line-height: 30px;padding-bottom: 4px;font-weight:bold; margin-bottom: 10px;font-size:13px;border-bottom:1px solid #000">VEHICLE DETAILS</td>
  <td rowspan="6" width="100" ><img style="width:80px;" align="right" src="'.$site_url.'assets/images/scan.jpg" alt=""></td>
</tr>
<tr>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Insured Name: <span>'.$full_name.' </span></td>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Registration Number:<span>'.$exp_policy_data['vehicle_registration_no'].' </span></td>
</tr>
<tr>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Pincode: <span>'.$exp_policy_data['primary_pin_code'].' </span></td>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Make/Model:<span>'.$exp_policy_data['make_model'].' </span></td>
</tr>
<tr>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Company Name: <span>'.$exp_policy_data['company_name'].' </span></td>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Fuel Type: <span>'.$exp_policy_data['fuel_type'].' </span></td>
</tr>
<tr>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">GSTIN: <span>'.$exp_policy_data['company_gstin'].' </span></td>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Purchase Year: <span> '.$exp_policy_data['registration_year'].' </span></td>
</tr>
<tr>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Period of Insurance: <span> '.$payment_date.' to '.$policy_exp_date.' </span></td>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;"> Engine No: <span>'.$exp_policy_data['engine_no'].' </span></td>
</tr>
<tr>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Policy Insurance Date:<span> '.$insurance_date.'</span></td>
  <td width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:v;line-height:16px;">Chassis No:<span>'.$exp_policy_data['chassis_no'].'</span></td>
</tr>
<tr>
  <td  width="215" style="font-size: 10px;color:#000;font-family: Arial;font-weight:normal;line-height:16px;">Policy Number: <span>'.$exp_policy_data['policy_no'].'/00</span></td>
</tr>
</table>';
 $content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-details td {
        font-family: Arial;
        font-size: 14px;
        line-height:30px;
        border-bottom:1px solid #000;
        font-weight:bold; 
    }
    </style>
<table width="530" class="section-details" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td width="530">PREMIUM DETAILS (₹)</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>

    table.section-Breakup td {
        border-bottom: 1px solid #d3d3d3;
        text-align:right;
        padding:15px;
        font-family: Arial;
        font-size: 11px;
        line-height:24px;
    }
    </style>
<table width="530" class="section-Breakup"  cellpadding="0" cellspacing="0" width="100%" border="0" style="border: 1px solid #d3d3d3;">
<tr>
  <td width="530" bgcolor="#f5f5f5" style="text-align:left;"> Premium Breakup</td>
</tr>
<tr>
  <td width="265" style="text-align:left;"> Basic Third Party Liability </td>
  <td width="265"> '.$exp_policy_data['basic_amount'].' </td>
</tr>
<tr>
  <td width="265" style="text-align:left;"> Net Liability Premium (B) </td>
  <td width="265"> '.$exp_policy_data['basic_amount'].' </td>
</tr>
<tr>
  <td width="265" style="text-align:left;"> IGST (18%) </td>
  <td width="265"> '.$exp_policy_data['gst_amount'].' </td>
</tr>
<tr>
  <td width="265" style="text-align:left; border:none"> Total Premium </td>
  <td width="265" style=" border:none"> '.$exp_policy_data['total_amount'].' </td>
</tr>
</table>';
$content .= '<style>
    table.section-Deductible td {
        font-family: Arial;
        font-size: 10px;
        line-height:20px;
		font-weight:normal;
    }
    </style><table width="530" class="section-Deductible" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="176">Geographical Area: <span style="text-align:right">India </span></td>
  <td width="176">Compulsory Deductible: <span style="text-align:right">₹ 0</span></td>
  <td width="176">Voluntary Deductible:<span style="text-align:right"n> ₹ 0</span></td>
</tr>
<tr>
  <td width="176">No-Claim Bonus:<span style="text-align:right"> 0 %</span></td>
  <td width="176">Hypothecation:<span style="text-align:right"> None</span></td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" border="0"><tr><td>&nbsp;</td></tr></table>';

$content .= '<style>

    table.section-inter td {
        font-family: Arial;
        font-size: 14px;
        line-height:30px;
        border-bottom:1px solid #000;
        font-weight:bold; 
    }
    </style><table width="530" class="section-inter" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530">INTERMEDIARY DETAILS</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Code td {
        font-family: Arial;
        font-size:9px;
        line-height:16px;
        border:0.5px solid #000;
		font-weight:normal;
    }
    </style><table width="530" class="section-Code" cellpadding="0" cellspacing="1" width="100%" border="0">
<tr>
  <td width="110"> Name </td>
  <td width="70"> Code </td>
  <td width="90"> Contact </td>
  <td width="120"> Email </td>
  <td width="140"> Address </td>
</tr>
<tr>
  <td width="110"> Advance india insurance broker Pvt limited </td>
  <td width="70"> 131362 </td>
  <td width="90"> +917551196988 </td>
  <td width="120"> <a href="#">support@info.cvom</a> </td>
  <td width="140"> Plot No.49, 3rd Floor, <br /> Gurgaon, Haryana 122004 </td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-pos td {
        font-family: Arial;
        font-size: 10px;
        line-height:20px;
        border:1px solid #000;
		font-weight:normal;
    }
    </style><table width="530" class="section-pos" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="178"> POS Name </td>
  <td width="178"> POS Contact </td>
  <td width="178"> POS ID NO </td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Corporate td{
    text-align:left;
    padding:15px;
    font-family: Arial;
    line-height:18px;
    }
</style>
<table class="section-Corporate" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="320"><span style="font-size: 14px;line-height:24px;">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 8px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 10px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size: 8px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 8px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    <td  align="center" width="80"> <img src="'.$site_url.'assets/images/acko-badge.jpg" alt="" style="text-align:center;"></td>
      <td  align="center" width="130"> <img style="border-bottom:1px solid #000;text-align:center;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;border-top:1px solid #000;line-height: 16px;font-size: 8px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530" style="font-size: 10px;"><strong>Limitations As To Use:</strong> The Policy covers use only under a permit within the meaning of the Motor Vehicle Act (M V Act) 1988 or such a carriage falling under Sub-Section (3) of Section 66 of the Motor Vehicle&acute;s Act 1988. The Policy does not cover use for: a) Organised racing b) Pace Making c) Reliability Trials d) Speed Testing e) Use whilst drawing a trailer except the towing (other than for reward) of any one disabled mechanically propelled vehicle. <strong>Persons or Class of Persons entitled to drive:</strong> Any person (including the insured), provided that a person driving holds a valid driving license at the time of the accident and is not disqualified from holding or obtaining such a license. Provided also that the person holding a valid learner&acute;s license may also drive the vehicle when not used for the transport of passengers at the time of accident and that such a person satisfies the requirements of Rule 3 of the Central Motor Vehicles Rules, 1989. <strong>Limits of Liability.</strong> 1. Under Section II-1 (i) of the policy - Death of or bodily injury - Such amount as is necessary to meet the requirements of the Motor Vehicles Act, 1988. 2. Under Section II - 1(ii) of the policy -Damage to Third Party Property - Rs. 100000 3. P. A. Cover under Section III for Owner - Driver(CSI): Rs. 0.0 <strong>Terms, Conditions &amp; Exclusions:</strong> As per the Indian Motor Tariff. A personal copy of the same is available free of cost on request &amp; the same is also available at our website. Please note: Previous Policy document is required in case of claim within 30 days of the Acko Policy Start Date.</td>
</tr>
</table>
';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530" style="font-size: 10px;">I / We hereby certify that the policy to which the certificate relates as well as the certificate of insurance are issued in accordance with the provision of chapter X, XI of M. V.Act 1988. "The stamp duty of Rs. 0.50 paid by electronic medium vide GRAS Deface no. 0004976826201920 dated 19/12/2019 as prescribed in Government Notification Revenue &amp; Forest Department No. Mudrank - 2017/C.R.97/M-1, dated 09/01/2018 . GSTN: 27AAOCA9055C1ZJ. <strong>IMPORTANT NOTICE:</strong> The Insured is not indemnified if the vehicle is used or driven otherwise than in accordance with this Schedule. Any payment made by the Company by reason of wider terms appearing in the Certificate in order to comply with the Motor Vehicle Act, 1988 is recoverable from the Insured. See the clause headed "AVOIDANCE OF CERTAIN TERMS AND RIGHT OF RECOVERY" in the policy wordings. <strong>Disclaimer</strong>: The Policy shall be void from inception if the premium cheque is not realized. In the event of misrepresentation, fraud or non-disclosure of material fact, the Company reserves the right to cancel the Policy. The policy is issued basis the information provided by you, which is available with the company. In case of discrepancy/non recording of relevant information in the policy, the insured is requested to bring the same to the notice of the company within 15 days. This Policy is to be read in conjunction with the Policy wordings <a href="https://www.acko.com/download">(https://www.acko.com/download)</a> available on the website of the Company. On renewal, the benefits provided under the policy and/or terms and conditions of the policy including premium rate may be subject to change.</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-general td{
    text-align:left;
    padding:15px;
    font-family: Arial;
    line-height:18px;
    }
</style>
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="380"><span style="font-size: 14px;line-height:24px;">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 10px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 9px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    <td  align="center" width="150"><img style="text-align:center;border-bottom:1px solid #000;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;line-height: 16px;font-size: 9px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="100"><img src="'.$site_url.'assets/images/logo.jpg" alt=""> </td>
    <td  width="300" style="font-size: 15px;color: #000;font-weight: bold;line-height:36px;"> PREMIUM RECEIPT </td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td  width="530" style="font-size: 10px;color: #000;font-weight: normal;line-height:20px;">Receieved with thanks from '.$full_name.' a sum of ₹ '.$exp_policy_data['total_amount'].' towards premium on '.strtoupper($exp_policy_data['ins_type']).' Insurance Policy</td>
  </tr>
</table>'; 
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-diary td{
    text-align:left;
    padding:15px;
    font-family: Arial;
    font-size: 10px;
    line-height:16px;
}
</style>
<table width="530" class="section-diary" cellpadding="2" cellspacing="1" width="100%" border="0">
<tr >
  <td width="265" style="border-bottom:1px solid #000; font-weight:bold; font-size:13px; line-height: 30px;">INSURED DETAILS</td>
  <td width="265" style="border-bottom:1px solid #000; font-weight:bold; font-size:13px;line-height: 30px;">INTERMEDIARY DETAILS</td>
</tr>
<tr>
  <td width="265">Insured Name: <span>'.$full_name.' </span></td>
  <td width="265">Name : <span>Advance india insurance broker Pvt limited</span></td>
</tr>
<tr>
  <td width="265">Address: <span> '.$exp_policy_data['primary_address_line1'].", ".$exp_policy_data['primary_address_line2'].", ".$exp_policy_data['primary_city'].", ".$exp_policy_data['primary_state'].' </span></td>
  <td width="265">Code:<span> 131362 </span></td>
</tr>
<tr>
  <td width="265">Company Name: <span>'.$exp_policy_data['company_name'].' </span></td>
  <td width="265"> &nbsp;</td>
</tr>
<tr>
  <td width="265">GST: <span> '.$exp_policy_data['company_gstin'].' </span></td>
  <td width="265">&nbsp;</td>
</tr>
<tr>
  <td width="265">Period of Insurance: <span> '.$payment_date.' to '.$policy_exp_date.' </span></td>
  <td width="265"> &nbsp;</td>
</tr>
<tr>
  <td width="265">Policy Number :<span> '.$exp_policy_data['policy_no'].'/00 </span></td>
  <td width="265"> &nbsp;</td>
</tr>
</table>';

 $content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>

    table.section-pre1 td {
        font-family: Arial;
        font-size: 14px;
        line-height:30px;
        border-bottom:1px solid #000;
        font-weight:bold; 
    }
    </style><table width="530" class="section-pre1" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530">PREMIUM DETAILS (₹)</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '<style>
    table.section-Net td {
        border-bottom: 1px solid #d3d3d3;
        text-align:right;
        padding:15px;
        font-family: Arial;
        font-size: 11px;
        line-height:24px;
    }
    </style>
<table width="530" class="section-Net"  cellpadding="0" cellspacing="2" width="100%" border="0" style="border: 1px solid #d3d3d3;">
<tr>
  <td width="265" style="text-align:left;"> Net Premium</td>
  <td width="265"> '.$exp_policy_data['basic_amount'].' </td>
</tr>
<tr>
  <td width="265" style="text-align:left;"> IGST (18%) </td>
  <td width="265"> '.$exp_policy_data['gst_amount'].' </td>
</tr>
<tr>
  <td width="265" style="text-align:left; border-bottom:none;"> <strong>Total Premium</strong> </td>
  <td width="265" style="border-bottom:none;"> <strong>'.$exp_policy_data['total_amount'].'</strong> </td>
</tr>
</table>';
 $content .= '<table class="first"  cellpadding="3" cellspacing="3" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
 $content .= '<style>

    table.section-terms td {
        font-family: Arial;
        font-size: 14px;
        line-height:24px;
        border-bottom:1px solid #000;
        font-weight:bold; 
    }
    </style><table width="530" class="section-terms" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530">TERMS & CONDITIONS</td>
</tr>
</table>';
$content .= '<style>

    table.section-receipt td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table width="530" class="section-receipt"  cellpadding="0" cellspacing="2" width="100%" border="0">
<tr>
  <td width="530">Issuance of this receipt does not amount to acceptance of the risk by Acko General Insurance Limited. The insurance cover for the risk shall be as per the terms and conditions of the Insurance Policy if and when issued. Cheque/DD/PO receipt is valid subject to the realization of the instrument.</td>
</tr>

</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Limitations td{
    text-align:left;
    padding:15px;
    font-family: Arial;
    line-height:18px;
    }
</style>
<table class="section-Limitations" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="380"><span style="font-size: 14px;line-height:24px;">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 10px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 9px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    <td  align="center" width="150"><img style="text-align:center;border-bottom:1px solid #000;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;line-height: 16px;font-size: 9px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="100"><img src="'.$site_url.'assets/images/logo.jpg" alt=""> </td>
    <td  width="300" style="font-size: 15px;color: #000;font-weight: bold;line-height:36px;"> PROPOSAL FORM</td>
  </tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='
<table class="section-general" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td  width="530" style="font-size: 10px;color: #000;font-weight: normal;line-height:20px;">Dear '.$full_name.',<br /><br />
	          We wish to inform you that the Insurance policy number '.$exp_policy_data['policy_no'].'/00 has been issued on the basis of the information and declaration given by you, the transcript whereof is mentioned below.<br /><br />
	          Please be informed that this Policy shall be construed to be void ab initio/invalid in the event we find that you have not disclosed material or correct information required for the purpose of providing the below insurance cover and in case of any claim arising under the policy in such a scenario, we shall be under no obligation whatsoever to settle such claim to you and the premium paid by you under this policy shall stand fully forfeited.
    </td>
  </tr>
</table>'; 
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-bike td{
    text-align:left;
    padding:15px;
    font-family: Arial;
    font-size: 10px;
    line-height:16px;
}
</style>
<table width="530" class="section-diary" cellpadding="2" cellspacing="1" width="100%" border="0">
<tr >
  <td width="265" style="border-bottom:1px solid #000; font-weight:bold; font-size:13px; line-height: 30px;">POLICY DETAILS</td>
  <td width="265" style="border-bottom:1px solid #000; font-weight:bold; font-size:13px;line-height: 30px;">BIKE DETAILS</td>
</tr>
<tr>
  <td width="265">Policy Number: <span> '.$exp_policy_data['policy_no'].'/00 </span></td>
  <td width="265">Bike Number : <span> '.$exp_policy_data['vehicle_registration_no'].' </span></td>
</tr>
<tr>
  <td width="265">Period of Insurance: <span> '.$payment_date.' to '.$policy_exp_date.' </span></td>
  <td width="265">Make/Model: <span> '.$exp_policy_data['make_model'].' </span></td>
</tr>
<tr>
  <td width="265">Policy Insurance Date: <span> '.$insurance_date.' </span></td>
  <td width="265"> Fuel Type: <span> '.$exp_policy_data['fuel_type'].' </span></td>
</tr>
<tr>
  <td width="265">&nbsp;</td>
  <td width="265">Registration Year: <span> '.$exp_policy_data['registration_year'].' </span></td>
</tr>
<tr>
<td width="265"> &nbsp;</td>
  <td width="265">Manufacturing Year: <span> '.$mfg_date.' </span></td>
  
</tr>
<tr>
<td width="265"> &nbsp;</td>
  <td width="265">Insured Declared Value (IDV): <span> N/A </span></td> 
</tr>
<tr>
<td width="265"> &nbsp;</td>
  <td width="265">Accessories (IDV): <span> 0</span></td> 
</tr>
</table>';

 $content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .= '
<style>
table.section-owner td{
    text-align:left;
    padding:15px;
    font-family: Arial;
    font-size: 10px;
    line-height:16px;
}
</style>

<table width="530" class="section-owner" cellpadding="2" cellspacing="1" width="100%" border="0">
<tr >
  <td width="265" style="border-bottom:1px solid #000; font-weight:bold; font-size:13px; line-height: 30px;">BIKE OWNER DETAILS</td>
  <td width="265" style="border-bottom:1px solid #000; font-weight:bold; font-size:13px;line-height: 30px;">NOMINEE DETAILS</td>
</tr>
<tr>
  <td width="265">Name: <span> '.$full_name.' </span></td>
  <td width="265">Name: <span> '.$exp_policy_data['nominee_name'].' </span></td>
</tr>
<tr>
  <td width="265">Email Address:  <span> '.$exp_policy_data['email'].' </span></td>
  <td width="265">Relationship with Insured: <span> '.$exp_policy_data['nominee_relation'].' </span></td>
</tr>
<tr>
  <td width="265">Mobile Number: <span> '.$exp_policy_data['phone_no'].' </span></td>
  <td width="265"> &nbsp; </td>
</tr>
<tr>
  
  <td width="265">Pincode: <span> '.$exp_policy_data['primary_pin_code'].' </span></td>
  <td width="265">&nbsp;</td>
</tr>

</table>';

 $content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530" style="font-size: 10px;">"I/We hereby declare that the statements made by me/us in this proposal form are true to the best of my knowledge and belief and I/We hereby agree that this declaration shall form the basis of the contract between me/us and Acko General Insurance Ltd. I/We agree and undertake to convey to Acko General Insurance Limited any change / alterations carried out in the risk proposed for insurance after submission of this proposal form. I/we hereby declare that the contents of the form have been fully explained to me/us and that I/we have fully understood the significance of the proposed contract.</td>
</tr>
</table>
';
$content .= '<table class="first"  cellpadding="1" cellspacing="1" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
    table.section-note td {
        text-align:left;
        padding:15px;
        font-family: Arial;
        font-size: 10px;
        line-height:14px;
    }
    </style>
<table width="530" class="section" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
  <td width="530" style="font-size: 10px;"><strong>Prohibition of Rebated (Section 41) of the Insurance Act - 1938 (as amended)</strong> 1. No person shall allow or offer to allow, either directly or indirectly as an inducement to any person to take out or renew or continue and insurance in respect of any kind or risk relating to lives or property in India, any rebate of the whole or part of the commission payable or any rebate of the premium shown on the policy, nor shall any person taking out or renewing or continuing a policy accept any rebate expect such rebate as may be allowed in accordance with the prospectus or tables of the Insurer. <br />
	            2. Any person making default in complying with the provisions of this section shall be liable for a penalty which may extend to 10 lakh rupees."</td>
</tr>
</table>';
$content .= '<table class="first"  cellpadding="2" cellspacing="2" width="100%" border="0"><tr><td>&nbsp;</td></tr></table>';
$content .='<style>
.section-Limitations td{
    text-align:left;
    padding:15px;
    font-family: Arial;
    line-height:18px;
    }
</style>
<table class="section-Limitations" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td width="380"><span style="font-size: 14px;line-height:24px;">Acko General Insurance Ltd.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Unit No. 301, 3rd Floor, E Wing, Lotus Corporate Park, Off Western Express Highway,</span><br />
      <span style="line-height: 16px;font-size: 10px;">Goregaon (E), Mumbai – 400063.</span><br />
      <span style="line-height: 16px;font-size: 9px;">Email: hello@acko.com | Phone: 1800 266 2256 | www.acko.com </span><br />
      <span style="line-height: 16px;font-size: 9px;">CIN : U66000MH2016PLC287385 | IRDAI Reg No. 157 | UIN: IRDAN157P0002V01201718 </span></td>
    <td  align="center" width="150"><img style="text-align:center;border-bottom:1px solid #000;" src="'.$site_url.'assets/images/sign.jpg" alt=""><br />
      <span style="text-align:center;line-height: 16px;font-size: 9px;">For Acko General Insurance Ltd. Duly Constituted Attorney</span></td>
  </tr>
</table>';
 
  }
  
  return $content;
}
?>
