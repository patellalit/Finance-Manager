$(document).ready(function(){
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
  $('#receipt_date').val(today);
  $("#receipt_formadd").validate(
    {
        rules: 
        {
            customer_id:
            {
              required:true
            },
            receipt_date:
            {
              required:true
            },
            emi:
            {
              required:true
            },
            interest_income:
            {
              required:true
            }
       },
      messages: 
       {    
            customer_id:
            {
              required:"Please select customer name."
            },
            receipt_date:
            {
              required:"Please select receipt date."
            },
            emi:
            {
              required:"Emi is required."
            },
            interest_income:{
                required:"Interest income is required."
            }
        }
    });
  $("#receipt_formedit").validate(
    {
        rules: 
        {
            customer_id:
            {
              required:true
            },
            date_receipt:
            {
              required:true
            },
            emi:
            {
              required:true
            },
            interest_income:
            {
              required:true
            }
       },
      messages: 
       {    
            customer_id:
            {
              required:"Please select customer name."
            },
            date_receipt:
            {
              required:"Please select receipt date."
            },
            emi:
            {
              required:"Emi is required."
            },
            interest_income:{
                required:"Interest income is required."
            }
        }
    });
});


$(function() {
    $("#emi").keydown(function(event) {
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

$(function() {
    $("#interest_income").keydown(function(event) {
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
    
    $('#customer_id').on('change',function(){
        $.ajax({
            url: BASE_URL + "/receipt/fetchCustomer/" + $(this).val(),
            type: 'json'
        }).done(function(data) {
            try{
                data = jQuery.parseJSON(data);
                $('#emi').val(data.emi_amount);
                $('#interest_income').val(data.emi_interest);
            }catch(e){}
        });   
    });
});