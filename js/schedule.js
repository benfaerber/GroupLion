function showResult(term, type)
{
	if (term.length == 0)
	{
		$("#" + type + "SearchResults").html("Please enter a search");
		return;
	}

	var url = "getSearchResults.php?t=" + type + "&q=" + term;
	if (type == "course")
		url += "&s=" + $("#subjectInput").val();

	$.get(url, function(data, status){
		console.log(url);
		$("#" + type + "SearchResults").html(data);
	});
}

function setSubject(result)
{
	var sCode = $(result).find(".subjectCode").text();
	$("#subjectInput").val(sCode);
	// Create a seperate response div later
	$("#subjectSearchResults").text("Subject set to " + sCode);
}

// Each loops dumb, why I gotta have a temp variable doh??
function courseInSchedule(catalogId, title)
{
	var f = false;
	$(".scheduleCourse").each(function() {
		var cTitle = $(this).find(".scheduleCourseTitle").text();
		var cCatalogId = $(this).find(".scheduleCatalogId").text();
		//console.log(cTitle + " " + cCatalogId + " = " + title + " " + catalogId);
		if (cTitle == title && cCatalogId == catalogId)
			f  = true;
	});
	return f;
}

function addCourseOption(courseId, catalogId, title, subject, instructors, instructor = "")
{
	$("#courseSelect").append("<option value='" + courseId + "'>" + title + ", Instructor: " + instructor + "</option>");
}

function addCourse(courseId, catalogId, title, subject, instructors, instructor = "")
{
	if (courseInSchedule(catalogId, title))
	{
		alert("You are already in this class");
		return;
	}

	if ($(".scheduleCourse").length >= 10)
	{
		alert("You can only have 10 coures at a time. You can remove classes and add new ones.");
		return;
	}

	$("#schedule").append("<div class='scheduleCourse'></div>");

	var s = $(".scheduleCourse").last();

	s.append("<input class='scheduleCourseId'></input>");
	$(".scheduleCourseId").last().attr("type", "hidden").val(courseId);

	s.append("<span class='scheduleCourseSubject'></span> ");
	$(".scheduleCourseSubject").last().text(subject);

	s.append("<span class='scheduleCatalogId'></span> ");
	$(".scheduleCatalogId").last().text(catalogId);

	s.append("<span class='scheduleCourseTitle'></span> ");
	$(".scheduleCourseTitle").last().text(title);

	var sel = s.append("<select class='scheduleInstructorSelect'></select> ");
	instructors.forEach(function(item) {
		$(".scheduleInstructorSelect").last().append("<option value='" + item + "'>" + item + "</option>");
	});

	sel.val(instructor);

	s.append("<button class='removeButton'></button>")
	$(".removeButton").text("Remove").click(function() {
		$(this).parent().remove();
		prepareIndexes();
	});
}

function prepareIndexes()
{
	$("#courseCount").val($(".scheduleCourse").length);
	$(".scheduleCourse").each(function(i) {
		$(this).find(".scheduleCourseId").attr("name", "course_id_" + i.toString());
		$(this).find(".scheduleInstructorSelect").attr("name", "course_instructor_" + i.toString());
	});
}

function addAllCourses(asOptions = false)
{
	var a = "toAdd";
	$(".courseToAdd").each(function() {
		var id = $(this).find("." + a + "CourseId").text();
		var catId = $(this).find("." + a + "CatalogId").text();
		var title = $(this).find("." + a + "Title").text();
		var subje = $(this).find("." + a + "Subject").text();
		var insts = $(this).find("." + a + "Instructors").text().trim().split(";");
		var inst = $(this).find("." + a + "Instructor").text();
		if (asOptions)
			addCourseOption(id, catId, title, subje, insts, inst);
		else
			addCourse(id, catId, title, subje, insts, inst);
	});

	$(".toAddContainer").remove();
}

