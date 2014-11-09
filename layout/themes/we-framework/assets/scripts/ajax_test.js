$( document ).ready(function(){

   	//Exemplo de ajax com WE-FRAMEWORK
  //  	$('#ajax_example').click(function(){
  //  		alert('Clicou');
  //  		$.ajax({
		//   	type: "POST",
	 //        url: '',
	 //        data: { ajax_request: 'hello'} ,
	 //        cache: false,
	 //        dataType: 'json', /* Tipo de transmissão */
	 //        success: function(data)
	 //        {
	 //           alert('Ok');
	 //        }
		// });
  //  	})

   	$('#ajax_example').click(function(){
	   	var request = $.ajax({
		  url:'/WE-FrameWork/engine/lib/weframework/ajax/functions.ajax.php',
		  type: "POST",
		  data: { ajax_request : 'hello' }
		});

		request.done(function( msg ) {
		  $('#log').html(msg);
		});

		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
	})



});