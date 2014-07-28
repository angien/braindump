<?php


// for AJAX validation
// get the q parameter from URL

$name=$_REQUEST["name"]; 
$val=$_REQUEST["val"]; 
$error="true,";

// depending on the name, do the following validations
switch ($name) {
    case "recurring":
        if ($val == "SELECT") 
			$error = "false,Please choose whether this BrainDump is recurring or not.";
        break;
    case "title":
		if ($val != "") {
    		if (strlen($val) > 100)
    			$error = "false,Please keep your title below 200 characters.";
    	}
    	break;
    case "descrip":
    	if ($val != "") {
    		if (strlen($val) > 200)
    			$error = "false,Please keep your description below 200 characters.";
    	}
    	break;
    case "email":
        if ($val != "") { 
			$regex = '/^[a-z0-9]+(@cisco)\.(com)$/'; // make sure its a correct decimal
			$match = preg_match($regex, $val);
			if ($match == 0)
				$error = "false,Please enter a valid Cisco email address.";
		}
        break;
    case "time":
    	if ($val != "") { 
			$regex = '/^[0-2][0-9](:)[0-5][0-9]$/'; // make sure its a correct decimal
			$match = preg_match($regex, $val);
			if ($match == 0)
				$error = "false,Please enter a time in 24h format. Ex. 23:00";
		}
		break;
	case "date":
		if ($val != "") { 
			$regex = '/^[0-2][0-9][0-9][0-9]\/([0-1])?[0-9]\/([0-3])?[0-9]$/'; // make sure its a correct decimal
			$match = preg_match($regex, $val);
			if ($match == 0)
				$error = "false,Please enter a date in yyyy/mm/dd format. Ex. 2012/06/29";
		}
		break;
}

// Output error message if any
echo $error;
?> 