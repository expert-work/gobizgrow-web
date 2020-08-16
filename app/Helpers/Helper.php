<?php
use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
 




function usaCurrencyFormat($float){
    $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
     return $fmt->formatCurrency($float, 'USD');
}




	function TwalioAddANewOutgoingCallerID($phone_number){
		try {
				$client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
				$client->validationRequests->create($phone_number, // phoneNumber
				          ["friendlyName" => $phone_number]
				 );
			  return   true;
		}
		catch(Twilio\Exceptions\RestException $e) {
              return false;
		}
	}


	function TwilioSendSMS($phone_number, $sms){
			try {
				$twilio_number = env('TWILIO_NUMBER');
				if(TwilioMobileNumberCheck($phone_number)){
					$client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
			        					     $client->messages->create(
			        							     $phone_number,
			        							    array(
			        							        'from' => $twilio_number,
			        							        'body' => $sms
			        							    )
			        							);
			        	 return true;				     
			        }else{
                       return false;
			        }
			}
			catch(Twilio\Exceptions\RestException $e) {
	              return false;

			}
	}



	function TwilioMobileNumberCheck($phone_number){
			try {
			     $client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
				 $result= $client->outgoingCallerIds ->read(["phoneNumber" => $phone_number], 20);
				  return  isset($result[0]->sid)?true:TwalioAddANewOutgoingCallerID($phone_number);
			}
			catch(Twilio\Exceptions\RestException $e) {
	              return false;

			}
	}


 
 

