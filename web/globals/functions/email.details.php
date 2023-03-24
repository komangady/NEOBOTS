<?php
$html_tpl = '<div id="rap" style="margin:auto;width:620px;background-color: #f9f6f2;color: #000;font-family: Verdana, Arial, Helvetica, sans-serif;border:1px solid #f2f2f2;padding:10px;">
	<div id="header" style="border-bottom: 1px solid #fff;"><a href="http://www.barudibali.com"><img src="http://www.barudibali.com/header.gif" alt="Baru Di Bali - www.barudibali.com" width="246" height="60" border="0" style="margin-bottom: 2px;" /></a></div>
  <div id="content" style="font-family: Arial, Helvetica, sans-serif;padding: 5px;font-size: 12px;">
    <p>Dear '.$rps['member_name'].',</p>
	  <p>Someone that probably you has requested a new password reset on our Clients Control Centre on '.date("Y/m/d h:i:s").' with the following IP address '.$ip_addr.'.</p>
	  <p>Please follow <a href="'.$generated_link.'"><strong>this link</strong></a> to complete your password reset request.<br />
    If you are experiencing problems clicking the above link, you can copy the following url to your browser address bar:</p>
	  <p>'.$generated_link.' </p>
	  <p>If you feel this is an error, simply ignore this email.<br />
	    For more support regarding this issue, please contact our support department at the following email: <a href="mailto:'.$support_email.'"><strong>'.$support_email.'</strong></a> or call us at <strong>+62 361 769 223</strong></p>
	  <p>This is an automatic email, please do not reply to this email.<br />
      For general enquiries kindly send email to <a href="mailto:info@barudibali.com">info@barudibali.com</a>.</p>
  </div>
  <div id="footer" style="margin-top:5px;border-top:3px solid #fff;padding:3px;font-size: 11px;font-family:Arial, Helvetica, sans-serif;text-align:right;color: #7C7D7A;">
<p><strong style="color:#999;">BaruDiBali.com - PT. Baru di Bali</strong><br />
Istana Kuta Galeria, Block Techno No. 21<br /> 
Jalan Patih Jelantik, Kuta 80361,
Bali - Indonesia<br />
	    phone: +62.361.769223</p>
        <p>info@barudibali.com |
      www.barudibali.com	  </p>
	</div>
</div>';
?>