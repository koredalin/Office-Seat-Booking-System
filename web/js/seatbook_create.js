$(document).ready(function () {
	
});

var sendFirstCategory = function() {
	var test = "this is an ajax test";
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::$app->getUrlManager()->createUrl('cases/ajax'); ?>",
		data: {test: test},
		success: function (test) {
			alert(test);
		},
		error: function (exception) {
			alert(exception);
		}
	});
};