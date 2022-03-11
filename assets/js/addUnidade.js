/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUnidadeForm = $("#addUnidade");
	
	var validator = addUnidadeForm.validate({
		
		rules:{
			Ds_Unidade: {required: true}
		}
	});
});
