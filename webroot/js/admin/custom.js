$(document).ready(function(){
		
                $("#forgot_form").validationEngine({scroll: false, maxErrorsPerField:true,'custom_error_messages' : {                                
                             
			'#email':{
                                'required':{
                                    'message':"Please enter Email ID."
                                },
				 'custom[email]': {
					 'message':"Please enter valid Email ID."
				}
                            } , 
				
			}
                    });  
		                        
});

