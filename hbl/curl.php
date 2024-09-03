<?php 
echo str_pad(43.51, 12, "0", STR_PAD_LEFT).'<br />';


$date = date_create();
echo date_timestamp_get($date).'<br />';

echo date('YMd', strtotime('2017-12-30'));



/*Array
(
    [paymentGatewayID] => 9103331674
    [respCode] => 
    [fraudCode] => 
    [Pan] => 
    [Amount] => 000000000044
    [invoiceNo] => AfI4jv7
    [tranRef] => 37334
    [approvalCode] => 
    [Eci] => 
    [dateTime] => 20171231023602
    [Status] => IN
    [failReason] => 
    [userDefined1] => Room Booking
    [userDefined2] => 
    [userDefined3] => 
    [userDefined4] => 
    [userDefined5] => 
    [noteToMerchant] => 
    [hashValue] => 0012ABF4CC4B050C36125167EE5172982705123C
)*/