$(document).ready(function () {
	$(".project-item").each(function () {
		let element = $(this);

		$.post(
			"home/detail",
			{
				slug: element.data("slug"),
			},
			function (data, status) {
				console.log(data);

				//let project = JSON.parse(data);

				element.find(".project-title b").html(data.title);
				element.find(".project-description").html(data.description);
				element.find(".project-time span").html(data.time);

				element.find("> a").attr("href", data.url);

				if (data.sreenshot.length != 0) {
					element.find(".project-screenshot").attr("src", data.sreenshot);
				}
			}
		);
	});
});
