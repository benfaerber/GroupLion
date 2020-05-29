function isError()
{
	return emailError || passwordError || repeatError || nameError;
}

// Email validation
var emailError = false;
var emailHasFailed = false;
function validateEmail()
{
	var patt = /u[0-9]{7}@(umail.)?utah.edu/gi;
	emailError = $("#email").val().match(patt) == null;
	if (emailError)
	{
		emailHasFailed = true;
		$("#email").addClass("is-invalid");
	}
	else
	{
		$("#email").removeClass("is-invalid");
	}
	setButton();
}

function editValidateEmail()
{
	if (emailHasFailed)
		validateEmail();
}

// Password validation
var passwordError = false;
var passwordHasFailed = false;
function validatePassword()
{
	var error = "";
	var passw = $("#password").val();
	if (passw.length > 200)
		error = "Passwords must be shorter than 200 characters!";
	else if (passw.length < 6)
		error = "Passwords must be longer than 6 characters!";

	if (error != "")
	{
		passwordHasFailed = true;
		passwordError = true;
		$("#password-error").text(error);
		$("#password").addClass("is-invalid");
	}
	else
	{
		passwordError = true;
		$("#password").removeClass("is-invalid");
	}
	setButton();
}

function editValidatePassword()
{
	passwordStrength();
	if (passwordHasFailed)
		validatePassword();
}

function passwordStrength()
{
	var special = "!@#$%^&*())_+{}|?><";
	var alphanum = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890";
	var score = 0;
	var passw = $("#password").val().split("");
	passw.forEach(function(letter) {
		if (special.includes(letter))
			score += 1.5;
		else if (alphanum.includes(letter))
			score += 1;
		else
			score += 0.6;
	});

	var sval = "Weak";
	var color = "danger";
	if (score > 10)
	{
		sval = "Strong";
		color = "success";
	}
	else  if (score > 7)
	{
		sval = "Medium";
		color = "warning";
	}

	var size = (100 - ((1-(score/12))*100)) - 20;
	size = size < 0 ? 0 : size;
	size = size >  100 ? 100 : size;

	$("#strengthBar").removeClass("bg-danger bg-success bg-warning");
	$("#strengthBar").css("width", size.toString() + "%").addClass("bg-" + color);
	if (size != 0)
		$("#strengthValue").text(sval);
}

// Repeat validation
var repeatError = false;
var repeatHasFailed = false;
function validateRepeatPassword()
{
	if ($("#password").val() != $("#repeatPassword").val())
	{
		repeatHasFailed = true;
		repeatError = true;
		$("#repeatPassword").addClass("is-invalid");
	}
	else
	{
		repeatError = false;
		$("#repeatPassword").removeClass("is-invalid");
	}
	setButton();
}

function editValidateRepeatPassword()
{
	if (repeatHasFailed)
		validateRepeatPassword();
}

// Name validation
var nameError = false;
var nameHasFailed = false;
function validateName()
{
	nameError = false;
	var nam = $("#realName").val();
	if (!nam.includes(" "))
		nameError = true;
	if (nam.length > 150)
		nameError = true;
	if (nam.length < 5)
		nameError = true;

	if (nameError)
	{
		$("#realName").addClass("is-invalid");
		nameHasFailed = true;
	}
	else
	{
		$("#realName").removeClass("is-invalid");
	}
	setButton();
}

function editValidateName()
{
	if (nameHasFailed)
		validateRepeatPassword();
}

// Button disabling
function setButton()
{
	if (isError())
		$("#register").addClass("disabled");
	else
		$("#register").removeClass("disabled");
}