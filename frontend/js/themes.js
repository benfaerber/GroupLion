var mode = "Light";

$(function() {
	changeTheme();
	$("#themeToggle").prop("checked", mode == "Light");
});

function toggleTheme()
{
	document.cookie = mode == "Light" ? "theme=dark" : "theme=light";
	changeTheme();
}

function changeTheme()
{
	mode = document.cookie.includes("dark") ? "Dark" : "Light";
	darken(mode != "Dark");
	$("#themeName").text(mode);
}

function darken(remove = false)
{
	var d = "bg-dark text-white";

	var excluded = ["alert", "invalid-feedback", "progress-bar", "btn"];
	var addTo = ["body", "header", "footer", "li", "th", "td", "select", "option", "textarea", "input", "a", ".card", "div"];
	addTo.forEach(function(elem) {
			if (remove)
				$(elem).removeClass(d);
			else
				$(elem).addClass(d);
	});

	if (remove)
		$("nav").addClass("bg-light navbar-light").removeClass(d);
	else
		$("nav").removeClass("bg-light navbar-light").addClass(d);

	excluded.forEach(function(item) {
		$("." + item).removeClass(d);
	});

}
