$(function () {

	$('#all_tests').on('click', function(){
		var ids   = new Array();
	    $("input[name=test]").each(function(){
	         ids.push(this.value);
	    })
		alert('All Tests'+ ids);
	});
	
	$('#selected_tests').on('click', function(){
		var ids   = new Array();
	    $("input[name=test]:checked").each(function(){
	         ids.push(this.value);
	    })
		alert('Selected Tests:' + ids);
	});
	
})(window.jQuery);