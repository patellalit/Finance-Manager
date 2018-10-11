$(document).ready(function(){
    $("#profile_form").validate(
    {
        rules: 
        {
            full_name:
            {
              required:true
            } 
       },
      messages: 
       {
            full_name: {
              required: 'Full name is required.'    
            }
        }
    });
});

