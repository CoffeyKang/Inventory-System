$().ready(function(){
	$('input').addClass('form-control');
	$('input').focus(function(){
            $(this).css({'background-color':'lightblue','font-weight':'700'});
        });
        $('input').focusout(function(){
            $(this).css({'background-color':'white','font-weight':'400'});
	});

    
});


