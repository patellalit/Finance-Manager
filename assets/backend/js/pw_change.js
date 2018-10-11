$(document).ready(function(){
    $("#password_changeform").validate(
    {
        rules: 
        {
            new_password:
            {
              required:true,
              minlength: 5
            },
            r_password: {
              minlength: 5,
              equalTo: "#new_password"            
            } 
       },
      messages: 
       {
            new_password: {
              required: 'New password is required.',  
              minlength: 'New password should be atleast 5 characters.'        
            },  
            r_password: {
              minlength: 'Confirm new password should be atleast 5 characters.'                
            }
        }
    });
});

