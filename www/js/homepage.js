$("#target").click(function() {
	$.nette.ajax(
			{
				type: 'post',
				url: formSwitch,
				data: {formSwitch: 'all'}
			});
});