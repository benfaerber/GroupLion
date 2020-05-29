$(document).ready(function(){
  var letters = $("#inviteCode").text().split("");
  $("#inviteCode").text("");
  letters.forEach(function(item, index) {
		$("#inviteCode").append("<span style='color:" + randomColor() + "'>" + item + "</span>");
  });
});

var picked = [];
function randomColor()
{
	var colors = ["green", "limeGreen", "chocolate", "red", "blue", "orange", "DarkMagenta", "salmon"];
	var color = colors[Math.floor(Math.random() * colors.length)];
	while (picked.includes(color))
		color = colors[Math.floor(Math.random() * colors.length)];
	picked.push(color);
	return color;
}