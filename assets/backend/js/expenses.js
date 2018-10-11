$(document).ready(function(){
  $("#expenses_formadd").validate({
        rules: 
        {
            title:
            {
              required:true
            },
            expenses_date:
            {
              required:true
            },
            amount:
            {
              required:true
            }
       },
      messages: 
       {
            title:
            {
              required:"Title is required."
            },
            expenses_date:{
                required:"Expenses date is required."
            },
            amount:
            {
              required:"Amount is required."
            }
        }
    });

    $("#expenses_formedit").validate({
        rules: 
        {
            title:
            {
                required:true
            },
            expenses_date:
            {
                required:true
            },
            amount:
            {
                required:true
            }
        },
       messages: 
        {
            title:
            {
              required:"Title is required."
            },
            expenses_date:{
                required:"Expenses date is required."
            },
            amount:
            {
              required:"Amount is required."
            }
        }
    });
});



$(function() {
    $("#amount").keydown(function(event) {
        if (event.shiftKey == true) {
            event.preventDefault();
        }
        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {
        }else {
            event.preventDefault();
        }
        if ($(this).val().indexOf('.') !== -1 && (event.keyCode == 190 || event.keyCode == 110))
            event.preventDefault();
    });
});

