<!-- <form method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment">
	<input type="text" id="paymentGatewayID" name="paymentGatewayID" value="9100931211"/>
	<input type="text" id="invoiceNo" name="invoiceNo" value="00000001234567890333"/>
	<input type="text" id="productDesc" name="productDesc" value="Test Product"/>
	<input type="text" id="amount" name="amount" value="000000000100"/>
	<input type="text" id="currencyCode" name="currencyCode" value="356"/>
	<input type="text" id="userDefined1" name="userDefined1" value="custom data"/>
	<input type="text" id="nonSecure" name="nonSecure" value="Y"/>
	<input type="text" id="hashValue" name="hashValue" value="QXXREXMCT2AC1ZEGN4FZIL28PD96UTHV"/>

	<button type="submit">Submit</button>
</form> -->


<form method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment">
	<input id="paymentGatewayID" name="paymentGatewayID" value="9102634359" type="hidden">
	<input id="invoiceNo" name="invoiceNo" value="4294T584" type="hidden">
	<input id="productDesc" name="productDesc" value="Test Product" type="hidden">
	<input id="amount" name="amount" value="000000000001" type="hidden">
	<input id="currencyCode" name="currencyCode" value="524" type="hidden">
	<input id="userDefined1" name="userDefined1" value="custom data" type="hidden">
	<input id="nonSecure" name="nonSecure" value="Y" type="hidden">
	<input id="hashValue" name="hashValue" value="HSCER3AC4OXSKHMUF0HM6MCKN7PJX8M2" type="hidden">
	<div class="buttons">
	    <div class="pull-right">
	      	<input value="Confirm Order" class="btn btn-primary" data-loading-text="Loading..." type="submit">
	    </div>
  	</div>
</form>

<?php 
// set post fields
/*$post = [
    'paymentGatewayID' => '9103331674',
    'invoiceNo' => '4294T584',
    'productDesc'   => 'Test Product',
    'amount' => '000000059900',
    'currencyCode'=> '524',
    'userDefined1' => 'custom data',
    'nonSecure' => 'Y',
    'hashValue' => 'XAVECXOORN2DM44JYLZXPUE8OXAW5N8Q'
];

$ch = curl_init('https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
var_dump($response);*/

?>