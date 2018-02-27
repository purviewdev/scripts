<?php

/**************** Settings begin **************/
// See http://www.interfax.net/en/dev/webservice/reference/faxquery2
// for an explanation of properties           

// Valid values for [property]_verb are:
// Equals | GreaterThan | GreaterOrEqual | LessThan | LessOrEqual | Like | IncludedIn | Between
// Leave both [property]_verb and [property]_data empty to ignore the property in the query

$username = 'srad.cmi';  
$password = 'dgfsty16';

$subject_verb = '';
$subject_data = '';

$faxnumber_verb = '';
$faxnumber_data = '';

$today = date("Y-m-d");
//$today = "2016-09-15";
$date_from = "".$today."T00:00:00";
$date_to = "".$today."T23:59:59";

$user_id_verb = '';
$user_id_data = '';

$reply_address_verb = '';
$reply_address_data = '';

$transaction_id_verb = '';
$transaction_id_data = '';

$parent_transaction_id_verb = '';
$parent_transaction_id_data = '';

$status_verb = '';
$status_data = '';

// The following values control display settings

$show_hidden_transactions = TRUE;
$only_parents = FALSE;
$num_of_results = 1000;
$starting_record = 0;

// Valid values for $order_by are:
// TransactionID | SubmitTime | CompletionTime | Status | DestinationFax | Subject | PagesSent | UserID | ReplyEmail

$order_by = 'TransactionID';
$asc_order_direction = TRUE;
$return_items = TRUE;
$return_stats = TRUE;

/**************** Settings end **************/

// Set default values for empty query properties

if(!($subject_verb && $subject_data)){
    $subject_verb = 'Equals';
    $subject_data = '';
}

if(!($faxnumber_verb && $faxnumber_data)){
    $faxnumber_verb = 'Equals';
    $faxnumber_data = '';
}

if(!$date_from) $date_from = '1999-01-01T00:00:01';

if(!$date_to) $date_to = '2999-12-31T23:59:59';

if(!($user_id_verb && $user_id_data)){
    $user_id_verb = 'Equals';
    $user_id_data = '';
}

if(!($reply_address_verb && $reply_address_data)){
    $reply_address_verb = 'Equals';
    $reply_address_data = '';
}

if(!($transaction_id_verb && $transaction_id_data)){
    $transaction_id_verb = 'Equals';
    $transaction_id_data = '';
}

if(!($parent_transaction_id_verb && $parent_transaction_id_data)){
    $parent_transaction_id_verb = 'Equals';
    $parent_transaction_id_data = '';
}

if(!($status_verb && !is_null($status_data))){
    $status_verb = 'Equals';
    $status_data = '';
}

// End setting default values


$params->Username                                 = $username;
$params->Password                                 = $password;
$params->QueryForm->Subject->Verb                 = $subject_verb;
$params->QueryForm->Subject->VerbData             = $subject_data;
$params->QueryForm->FaxNumber->Verb               = $faxnumber_verb;
$params->QueryForm->FaxNumber->VerbData           = $faxnumber_data;
$params->QueryForm->DateFrom                      = $date_from;
$params->QueryForm->DateTo                        = $date_to;
$params->QueryForm->UserID->Verb                  = $user_id_verb;
$params->QueryForm->UserID->VerbData              = $user_id_data;
$params->QueryForm->ReplyAddress->Verb            = $reply_address_verb;
$params->QueryForm->ReplyAddress->VerbData        = $reply_address_data;
$params->QueryForm->TransactionID->Verb           = $transaction_id_verb;
$params->QueryForm->TransactionID->VerbData       = $transaction_id_data;
$params->QueryForm->ParentTransactionID->Verb     = $parent_transaction_id_verb;
$params->QueryForm->ParentTransactionID->VerbData = $parent_transaction_id_data;
$params->QueryForm->Status->Verb                  = $status_verb;
$params->QueryForm->Status->VerbData              = $status_data;
$params->QueryForm->ShowHiddenTransactions        = $show_hidden_transactions;
$params->QueryControl->OnlyParents                = $only_parents;
$params->QueryControl->NumOfResults               = $num_of_results;
$params->QueryControl->StartingRecord             = $starting_record;
$params->QueryControl->OrderBy                    = $order_by;
$params->QueryControl->AscOrderDirection          = $asc_order_direction;
$params->QueryControl->ReturnItems                = $return_items;
$params->QueryControl->ReturnStats                = $return_stats;


$client = new SoapClient("http://ws.interfax.net/dfs.asmx?wsdl");

// Use the call below to trace PHP's SOAP call
// $client = new SoapClient("http://ws.interfax.net/dfs.asmx?wsdl", array('trace' => 1));

$queryResult = $client->FaxQuery2($params);

// Display the SOAP call; use in conjunction with the alternative SOAP call above
// echo $client->__getLastRequest();

// Format and present retrieved data

if ($queryResult->FaxQuery2Result->ResultCode == 0){ // status request succeeded

    if ($return_items){ 

        $queryCount = count($queryResult->FaxQuery2Result->FaxItems->FaxItemEx2);
        switch($queryCount){
            case 0:
                echo 'No transactions fit query';
                break;
     
            default: // multiple items returned by WS call
                for($i = 0; $i < $queryCount; $i++){
    
					$servername = 	"localhost";
					$username = 	"root";
					$password = 	"dgfsty16";
					$dbname = 		"cmi_iris";
				
                    $TransactionID = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->TransactionID;
                    $SubmitTime = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->SubmitTime;
					$CompleteTime = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->CompletionTime;
					$Contact  = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->Contact;
					$DestinationFax =  $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->DestinationFax;
					$PagesSent = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->PagesSent;
					$Status = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->Status;
					$Duration = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->Duration;
					$Subject = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->Subject;
					$PagesSubmitted = $queryResult->FaxQuery2Result->FaxItems->FaxItemEx2[$i]->PagesSubmitted;		    
                    
                    $sql = "INSERT INTO fax_reporting (transaction_id,submit_time,complete_time,destination_fax,pages_sent,pages_submitted,duration,exam,status) 
                    	    VALUES ('$TransactionID',
                    	            '$SubmitTime',
                    	            '$CompleteTime',
                    	            '$DestinationFax',
                    	            '$PagesSent',
                    	            '$PagesSubmitted',
                    	            '$Duration',
                    	            '$Subject',
                    	            '$Status')";
                    
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_query($conn, $sql)) {
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
					
					
                }  // close loop
                    break;
            }  // close switch
    }
} else { // problem getting status
    // Do something here, like alerting an administrator
    echo 'Problem retrieving status, error ' . $queryResult->FaxQuery2Result->ResultCode . '';
}

?>
