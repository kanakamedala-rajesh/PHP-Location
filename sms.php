<?php
$uid = '9014033558';
$pwd = '09481a0542';
$phone = '9014033558';
$msg = 'hii welcomw';
$provider = 'fullonsms';

$content = 'uid='.rawurlencode($uid).
'&pwd='.rawurlencode($pwd).
'&phone='.rawurlencode($phone).
'&msg='.rawurlencode($msg).
//'&codes=1'. // Use if you need a user freindly response message.
'&provider='.rawurlencode($provider);

$sms_response = file_get_contents('http://ubaid.tk/sms/sms.aspx?' . $content);

echo $sms_response;



?>