function userValidation() {
	// validate admin user add/edit form
	$("#frmUserEdit").validate({
		rules: {
			first_name: "required",
			last_name: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			first_name: first_name_err,
			last_name: last_name_err,
			email: email_err
		}
	});

	
}


$(function() {
	"use strict";
	
    userValidation()
});
