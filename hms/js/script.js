// JavaScript Document

function formValidation()
{
	var uid = document.getElementById("user_id").value;
	if(uid.length==0) {
		alert("Please Enter User ID");
		return false;
	}
	
	var pass = document.getElementById("password").value;
	if(pass=="") {
		alert("Please Enter Password");
		return false;
	}
	
	//create_tanent
		//create_tanent
		var tname = document.getElementById("name").value;
			if(tname=="") {
			alert("Tanent Name is Required!");
			return false;
		}
		
		var occu = document.getElementById("occupation").value;
			if(occu=="") {
			alert("Tanent Occupation is Required!");
			return false;
		}

		
		var phone = document.getElementById("phone").value;
			if(phone=="") {
			alert("Phone Number is Required!");
			return false;
		}
		
				
		var email = document.getElementById("email").value;
			if(email=="") {
			alert("Email Id is Required!");
			return false;
		}
		
		var nid = document.getElementById("nid").value;
			if(nid=="") {
			alert("Tanent National ID is Required!");
			return false;
		}

		
		return true;
	
}

function onlyNumeric(event)
{
	//alert("Test");
	var k = event.keyCode;
	if(k==0) k = event.which;
	//alert(k);
	
	if( (k>=48 && k<=57) || k==8 || k==37 || k==39 || k==32 ) {
		return true;
	}
	return false;
}

function checkPassword()
{
	var pass = document.getElementById('password').value;
	//alert(pass);
	if(pass.length > 0 && pass.length < 6) 
	{
		document.getElementById('pass_note').innerHTML = "<b style='color:#FF0000'>Password too week!</b>";
	} 
	else if(pass.length >= 6 && pass.length < 10) 
	{
		document.getElementById('pass_note').innerHTML = "<b style='color:#999999'>Password is normal!</b>";
	} 
	else if( pass.length >=10 ) 
	{
		document.getElementById('pass_note').innerHTML = "<b style='color:#00FF00'>Password is strong</b>";
	} else {
		document.getElementById('pass_note').innerHTML = "";
	}
}

