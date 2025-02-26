<?php
include 'accessToken.php';
include "../DB_connection.php";
#include "callback.php";
# $orderNo = $_POST['phone_number'];
$phone = $_POST['phone_number'];
 $phone = (substr($phone, 0, 1) == "+") ? str_replace("+", "", $phone) : $phone;
 $phone = (substr($phone, 0, 1) == "0") ? preg_replace("/^0/", "254", $phone) : $phone;
 $phone = (substr($phone, 0, 1) == "7") ? "254{$phone}" : $phone;

date_default_timezone_set('Africa/Nairobi');
$processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl ='https://f899-41-90-64-220.ngrok.io/mpesa/callback.php';
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode ='174379';
$Timestamp = date('YmdHis');
$Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
#$phone = '254114597217';
$money = $_POST['amount'];
$PartyA = $phone;
$PartyB = '254718699613';
$AccountReference = 'EBENEZER CHRISTIAN SCHOOL';
$TransactionDesc = 'test';
$Amount = $money;
$year = $_POST['year'];
$term = $_POST['term'];
$student_id = $_POST['student_id'];
$username = $_POST['username'];
$stkpushheader= ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader);
$curl_post_data = array(
    'BusinessShortCode' => $BusinessShortCode,
    'Password'=> $Password,
    'Timestamp'=> $Timestamp,
    'TransactionType'=> 'CustomerPayBillOnline',
    'Amount'=> $Amount,
    'PartyA'=>$phone,
    'PartyB'=>$BusinessShortCode,
    'PhoneNumber'=>$phone,
    'CallBackURL'=>$callbackurl,
    'AccountReference'=>$AccountReference,
    'TransactionDesc'=>$TransactionDesc,
    'student_id'=>$student_id,
    'year'=>$year,
    'term'=>$term,
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);

echo $curl_response;