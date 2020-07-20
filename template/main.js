$("input[type='submit']").hide();
$("button#group-2").hide();
$(".group-2").hide();
$(".group-3").hide();

$("button#group-1").on("click", function () {
	$(this).hide();
	$(".group-1").hide();
	$("button#group-2").show();
	$(".group-2").show();
});

$("button#group-2").on("click", function () {
	$(this).hide();
	$("button#group-3").show();
	$(".group-2").hide();
	$(".group-3").show();
	$("input[type='submit']").show();
});
$("button.btn-primary").css("margin-bottom", "80px");
