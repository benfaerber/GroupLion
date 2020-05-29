function saveEdit()
{
	$("#editTitle").val($("#groupTitle").val());
	$("#editPrivacy").val($("#groupPrivacy").val());
	$("#editCourse").val($("#courseSelect").val());
	$("#editDescription").val($("#groupDescription").val());
	$("#eventCount").val($(".event").length);

	$(".event").each(function(i) {
		var si = i.toString();
		var title = $(this).find(".eventTitle").val();
		$("#editForm").append("<input type='hidden' name='eventTitle" + si + "'>");
		$("input[name~='eventTitle" + si + "']").val(title);

		var time = $(this).find(".eventTime").val();
		$("#editForm").append("<input type='hidden' name='eventTime" + si + "'>");
		$("input[name~='eventTime" + si + "']").val(time);

		var description = $(this).find(".eventDescription").val();
		$("#editForm").append("<input type='hidden' name='eventDescription" + si + "'>");
		$("input[name~='eventDescription" + si + "']").val(description);

		var id =  $(this).find(".eventId").val();
		$("#editForm").append("<input type='hidden' name='eventId" + si + "'>");
		$("input[name~='eventId" + si + "']").val(id); 
	});

	$("#editForm").submit();
}

$(document).ready(function() {
	var val = $("#groupPrivacyValue").val();
	$("#groupPrivacy").val(val);

	var val = $("#courseSelectValue").val();
	$("#courseSelect").val(val);
});

