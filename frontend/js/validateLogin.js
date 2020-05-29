var hasError = false;
var hasHadError = false;
function validateEmail()
{
	var patt = /u[0-9]{7}(@)?(umail.)?(utah.edu)?/gi;
	hasError = $("#username").val().match(patt) == null;
	if (hasError)
	{
		hasHadError = true;
		$("#username").addClass("is-invalid");
	}
	else
	{
		$("#username").removeClass("is-invalid");
	}
}

function editValidateEmail()
{
	if (hasHadError)
		validateEmail();
}