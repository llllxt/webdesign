
var myfirstname=document.getElementById("firstname");
var mylastname=document.getElementById("lastname");
var myemail=document.getElementById("email");
var mydate=document.getElementById("dateofbirth");
myfirstname.addEventListener("change",function(){chkName(myfirstname)},false);
mylastname.addEventListener("change",function(){chkName(mylastname)},false);
myemail.addEventListener("change",chkEmail,false);
mydate.addEventListener("change",chkStartdate,false);

// document.getElementById("mySubmit").addEventListener("click",chkall(),false);
function chkall(){
	if(chkName(myfirstname) && chkName(mylastname) && chkEmail() && chkStartdate()){
	}
	else{
	event.preventDefault();
	}
}
function chkName(myname){
	if(myname.value.match(/^[a-zA-Z ]*$/)){
		myname.focus();
		return true;
	}else{
		alert("The name you have entered (" + myname.value + ") is not in the correct form. \n" +
          "The correct form is: " +
          "ONLY contains alphabet characters and character spaces\n" );
		myname.focus();
		myname.select();

		return false;
	}
}

function chkEmail(){
	if(myemail.value.match(/^[\w\.\-]+@([\w]+\.){1,3}[\w]{2,3}$/)){
		myemail.focus();
		return true;
	}else{
		alert("The email you entered (" + myemail.value +
              ") is not in the correct form. \n");
        myemail.focus();
        myemail.select();
        return false;
	}
	
}

function chkStartdate(){
	var today = new Date();
	var inputday = new Date(mydate.value);
	if (inputday >= today){
		alert("The birthday cannot be from today and the future\n"+
              "please select again \n");
        mydate.focus();
        mydate.select();
        return false;
	}else{
		return true;
	}
}




