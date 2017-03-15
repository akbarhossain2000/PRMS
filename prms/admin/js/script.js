// JavaScript Document

function onlyNumeric(event){
	
	var k = event.keyCode;
	if(k==0) k = event.which;
	
	if((k>=48 && k<=58) || k==8 || k==37 || k==39 || k==32){
		return true;
	}
	return false;
	
}