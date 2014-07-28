/* For validating form */

/*
 * document.getElementsByName(name)[0] => Text field
 * document.getElementsByName(name)[1] => Checkbox
 * document.getElementsByName(name)[2] => Response for AJAX
 */

// connects the html to the php validation
function validate(name, val) {
	if (val.length==0) {
		document.getElementsByName(name)[1].checked=false;
		document.getElementsByName(name)[2].innerHTML="";
		return;
	}
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) { // response is ready
			var ret = xmlhttp.responseText.split(",");
			var bool = (ret[0] === "true");
			document.getElementsByName(name)[1].checked=bool;
			document.getElementsByName(name)[2].innerHTML=ret[1];
		}
	}	  
	xmlhttp.open("POST","validate.php?name="+name+"&val="+val,true);
	xmlhttp.send();
}

/* pop-up validation */
function finalValidate(allFields)
{
	// validate each field (all fields are mandatory)
	for (var i = 0; i < allFields.length; i++) {
		var checked = document.getElementsByName(allFields[i])[1].checked;
		if (!checked) { // this has not been AJAX validated
			var s = document.getElementsByName(allFields[i])[2].innerHTML;
			if (s == "")
				alert("Please fill out all fields.");
			else
				alert(s);
			return false;
		}
	}
	
}