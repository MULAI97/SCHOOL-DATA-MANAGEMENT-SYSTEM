<?php
/*
 include "../DB_connection.php";
header("Content-Type: application/json");
$stkCallbackResponse = file_get_contents('php://input');
$logFile="Mpesastkresponse.json";
$log=fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$data = json_decode($stkCallbackResponse);

$MerchantRequestID = $data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
$ResultCode = $data->Body->stkCallback->ResultCode;
$ResultDesc = $data->Body->stkCallback->ResultDesc;
$Amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$TransactionId =$data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$UserPhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[4]->Value;
#$student_id = $data->Body->stkCallback->CallbackMetadata->Item[6]->Value;
#$year = $data->Body->stkCallback->CallbackMetadata->Item[7]->Value;
#$term = $data->Body->stkCallback->CallbackMetadata->Item[8]->Value;
if($ResultCode ==0){

}

*/
//include "conn.php";
include "../DB_connection.php";
include 'accessToken.php';
$callbackJSONData=file_get_contents('php://input');

$logFile = "stkPush.json";
$log = fopen($logFile, "a");
fwrite($log, $callbackJSONData);
fclose($log);

$callbackData=json_decode($callbackJSONData);

$resultCode=$callbackData->Body->stkCallback->ResultCode;
$resultDesc=$callbackData->Body->stkCallback->ResultDesc;
$merchantRequestID=$callbackData->Body->stkCallback->MerchantRequestID;
$checkoutRequestID=$callbackData->Body->stkCallback->CheckoutRequestID;
$pesa=$callbackData->stkCallback->Body->CallbackMetadata->Item[0]->Name;
$amount=$callbackData->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$mpesaReceiptNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$balance=$callbackData->stkCallback->Body->CallbackMetadata->Item[2]->Value;
$b2CUtilityAccountAvailableFunds=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$transactionDate=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$phoneNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[4]->Value;

$amount = strval($amount);
if($resultCode == 0){
$insert = $conn->query("INSERT INTO `fees_pad`(`merchantRequestID`, `checkoutRequestID`,`resultCode`, `resultDesc`, `amount`, `mpesaReceiptNumber`, `transactionDate`, `phoneNumber`)
VALUES ('$merchantRequestID', '$checkoutRequestID','$resultCode', '$resultDesc', '$amount','$mpesaReceiptNumber','$transactionDate','$phoneNumber')");

$sql = $conn->query("UPDATE invoice SET status = 'Paid' WHERE phone = '$phoneNumber' order by id desc limit 1");
}

$conn = null;

echo "
<script>alert('payment has been successfully!')</script>
<script>window.location = 'fees_payments.php'</script>
";