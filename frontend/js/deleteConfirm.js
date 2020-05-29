$("#deleteBtn").click(function() {
	$("#deleteBtn").hide();
	$("#confirmForm").show();
});

$("#confirmBtn").click(function() {
	if ($("#confirmInput").val().toLowerCase() == "abracadabra")
		alert("Deleting");
	else
		alert("Please enter \"Abracadabra\" to confirm your delete")
});

$("#cancelBtn").click(function() {
	$("#deleteBtn").show();
	$("#confirmForm").hide();
});