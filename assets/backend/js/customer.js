$(document).ready(function(){
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
  $('#loan_date').val(today);

  var customer_id=$('#customer_id').val();

  // if($('#loan_date_edit').val()==''){
  //   $('#loan_date_edit').val(today);
  // }

  calculateSum();
  $(".total_emi").on("keydown keyup", function() {
        calculateSum();
  });

  calculateMonth();
  $(".total_month").on("keydown keyup", function() {
        calculateMonth();
  });

 // jQuery.validator.addMethod('lesserThan', function(value, element, param) {
 //    return ( value < emi_amount.val() );
 //    }, 'Must be less than end' );

jQuery.validator.addMethod("lesserThan",function(value, element) {
    if(parseInt($('#amount').val()) >= parseInt(value)){
        return true;
    }else{
        return false;
    }
},
"This value must be less than loan amount."
);

  //$('#cans').html(Math.ceil(canCount.toFixed(2)));

  $("#customer_formadd").validate({
        rules: 
        {
            customer_name:
            {
              required:true
            },
            mobile:{
                required:true
            },
            emi_type:{
                required:true
            },
            amount:
            {
              required:true
            },
            processing_charges:
            {
              required:true
            },
            emi_amount:
            {
              required:true,
              lesserThan:true
            },
            emi_interest:
            {
              required:true
            }
       },
      messages: 
       {
            customer_name:
            {
              required:"Customer Name is required."
            },
            mobile:{
                required:"Mobile No. is required."
            },
            emi_type:{
                required:"Emi Type is required."
            },
            amount:
            {
              required:"Amount is required."
            },
            processing_charges:
            {
              required:"Processing charges is required."
            },
            emi_amount:
            {
              required:"Emi amount is required."
            },
            emi_interest:
            {
              required:"Emi interest is required."
            }
        }
    });

    $("#customer_formedit").validate({
        rules: 
        {
            customer_name:
            {
                required:true
            },
            mobile:{
                required:true
            },
            emi_type:{
                required:true
            },
            amount:
            {
                required:true
            },
            processing_charges:
            {
                required:true
            },
            emi_amount:
            {
                required:true,
                lesserThan:true
            },
            emi_interest:
            {
                required:true
            }
        },
        messages: 
        {
            customer_name:
            {
                required:"Customer Name is required."
            },
            mobile:{
                required:"Mobile No. is required."
            },
            emi_type:{
                required:"Emi Type is required."
            },
            amount:
            {
                required:"Amount is required."
            },
            processing_charges:
            {
                required:"Processing charges is required."
            },
            emi_amount:
            {
                required:"Emi amount is required."
            },
            emi_interest:
            {
                required:"Emi interest is required."
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

$(function() {
    $("#processing_charges").keydown(function(event) {
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
    $("#emi_amount").keydown(function(event) {
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
    $("#emi_interest").keydown(function(event) {
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
    $("#total_emi").keydown(function(event) {
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
    $("#closing_balance").keydown(function(event) {
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
    $("#emi_type").change(function(){
        var type_val=$("#emi_type").val();
        if(type_val=='1'){
            $('#labelChanged').text('Emi Month:');
            $('#displayEmiDay').hide();
            $(".displayEmiDay-required").removeAttr('required');    
        }else{
            $('#labelChanged').text('Emi Count:');
            $('#displayEmiDay').show();
            $(".displayEmiDay-required").attr('required','');   
        }
    });
});

function calculateSum() {
    var total_emi = 0;
    $(".total_emi").each(function() {
        if (!isNaN(this.value) && this.value.length != 0) {
            total_emi += parseFloat(this.value);
            //$(this).css("background-color", "#FEFFB0");
        }
        // else if (this.value.length != 0){
        //     $(this).css("background-color", "red");
        // }
    });
 
  $("#total_emi").val(total_emi.toFixed(2));
}

function calculateMonth() {
    var total_month = 0;
    var amount=0;
    var emi_amount=0;
    $(".total_month").each(function() {
        if (!isNaN(this.value) && this.value.length != 0) {
          var amount=$('#amount').val();
          var emi_amount=$('#emi_amount').val();
          total_month = parseFloat(amount)/parseFloat(emi_amount);
        }
    });
  //$('#cans').html(Math.ceil(canCount.toFixed(2)));
  $("#emi_month").val(Math.ceil(total_month));
}
