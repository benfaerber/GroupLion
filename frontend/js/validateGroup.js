function isError()
{
	return titleError || descriptionError;
}

var titleError = false;
var titleHadError = false;
function validateTitle()
{
	var error = "";
	var title = $("#groupTitle").val();

	if (title.length > 100)
		error = "Titles cannot be longer than 100 characters!";
	else if (title.length < 10)
		error = "Titles cannot be shorter than 10 characters!";

	titleError = error != "";
	if (titleError)
	{
		$("#titleError").text(error);
		$("#groupTitle").addClass("is-invalid");
		titleHadError = true;
	}
	else
	{
		$("#groupTitle").removeClass("is-invalid");
	}

	setButton();
}

function editValidateTitle()
{
	if (titleHadError)
		validateTitle();
}


var descriptionError = false;
var descriptionHadError = false;
function validateDescription()
{
	var error = ""; 

	var des = $("#groupDescription").val();

	if (des.length > 750)
		error = "Descriptions cannot be longer than 750 characters!";
	else if (des.length < 10)
		error = "Descriptions cannot be shorter than 10 characters!";

	descriptionError = error != "";
	if (descriptionError)
	{
		$("#descriptionError").text(error);
		$("#groupDescription").addClass("is-invalid");
		descriptionHadError = true;
	}
	else
	{
		$("#groupDescription").removeClass("is-invalid");
	}

	setButton();
}

function editValidateDescription()
{
	if (descriptionHadError)
		validateDescription();
}

function setButton()
{
	if (isError())
		$("#createGroup").addClass("disabled");
	else
		$("#createGroup").removeClass("disabled");
}