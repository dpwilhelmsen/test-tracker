(function($, window, document, undefined) {
	$(document).ready(function(){
		$('#all_tests').on('click', function(){
			var ids   = new Array();
		    $("input[name=test]").each(function(){
		         ids.push(this.value);
		    });
			alert('All Tests'+ ids);
		    session_submit(ids);
		});
		
		$('#selected_tests').on('click', function(){
			var ids   = new Array();
		    $("input[name=test]:checked").each(function(){
		         ids.push(this.value);
		    });
			alert('Selected Tests:' + ids);
		    session_submit(ids);
		});
	});
	
	function session_submit(ids)
	{
		/*$.ajax({url:"/sessions/create",data:ids,success:function(result){
		    alert(result);
		  }
		});
		$.ajax({
			   type: "POST",
			   url: BASE+"/sessions/create",
			   data: "name=John&location=Boston",
			   success: function(msg){
			     alert( "Data Saved: " + msg );
			   }
			 });*/
		$.post(BASE+'/replace', {
		    name: "Dayle",
		    age: 27
		}, function(data) {
		    alert(data);
		});
	}
	
}(jQuery, window, document));