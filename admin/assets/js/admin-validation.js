function adminUserValidation() {
	// validate admin user add/edit form
	$("#frmAdminEdit").validate({
		rules: {
			first_name: "required",
			last_name: "required",
			email: {
				required: true,
				email: true
			},
            password: "required",
			cpassword: "required"
		},
		messages: {
			first_name: first_name_err,
			last_name: last_name_err,
			email: email_err,
            password: password_err,
			cpassword: cpassword_err
		}
	});

	
}


$(function() {
	"use strict";
	
    adminUserValidation()
});
