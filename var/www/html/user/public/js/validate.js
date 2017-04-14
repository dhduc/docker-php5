function email_validate(email){
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
	if(email.value.match(mailformat)){
		return true;
	}
	else {
		alert("You have entered an invalid email address!");  
		email.focus();
		return false;
	}
}
function username_validate(username, min){
	var len = username.value.length;
	if(len == 0 || len < min){
		alert("Username should not be empty or from " + min + " letters");
		username.focus();
		return false;  
	}
	return true;
}
function password_validate(password, min){
	var len = password.value.length;
	if(len == 0 || len < min){
		alert("Password should not be empty or from " + min + " letters");
		password.focus();
		return false;  
	}
	return true;
}
function checkbox(term){
	if(term.checked){
		return true;
	}
	else {
		alert("You must agree the term");
		term.focus();
		return false;
	}
}
function text_validate(text){
	var len = text.value.length;
	if(len == 0){
		alert(toTitleCase(text.name + " field should not be empty"));
		text.focus();
		return false;  
	}
	return true;
}
function capitalize(string){
	return string.charAt(0).toUpperCase() + string.slice(1);
}
function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
