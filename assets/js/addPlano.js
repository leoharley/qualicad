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
	
	var addPlanoForm = $("#addPlano");
	
	var validator = addPlanoForm.validate({
		
		rules:{
			Ds_Plano: {cnpj: true, required: true}
		},
		messages:{
			Ds_Plano: { cnpj: 'CNPJ inválido'}
		}
	});
});
