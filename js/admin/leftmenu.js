function initLeftmenu(){
	
	$(".leftmenuEntry").each(function(){
		var link = $(this).data("link");
		$(this).click(function(){
			document.location.href = link;
		});

	});
	
};
