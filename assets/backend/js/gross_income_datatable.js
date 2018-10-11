var grossincomeBalance_url = $("#grossincome_Balanceurl").val();
var grossincome_datatableurl = $("#grossincome_datatableurl").val();
var t;
var option ={
            data: {
                type:"remote", source: {
                    read:{
                            url:BASE_URL, map:function(t) {
                                var e=t;
                                return void 0!==t.data&&(e=t.data), e
                            }
                        }
                    }
                , pageSize:10, serverPaging:!0, serverFiltering:!0, serverSorting:!0,
                    saveState: {
                        cookie: false,
                        webstorage: false
                    }
            }
            , layout: {
                scroll: !1, footer: !1
            }
            , sortable:!0, pagination:!0, toolbar: {
                items: {
                    pagination: {
                        pageSizeSelect: [10, 20, 30, 50, 100]
                    }
                }
            }
            , search: {
                input: $("#generalSearch")
            }
            , columns:[
                    {
                        field:"date", title:"Date",sortable: !1,width: 80, template:function(u) {
                            if(u.date=="0000-00-00" || u.date==null){
                                return '-'
                            }else{
                                return u.date
                            } 
                        }
                    }
                    , {
                        field: "payment", title: "Payment", sortable: !1 ,width: 150
                    }
                    , {
                        field: "receipt", title: "Receipt", sortable: !1 ,width: 150
                    }
                    , {
                        field: "closing_balance", title: "Closing Balance", sortable: !1 ,width: 150
                    }
                ]
        };
$('#search').click(function(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    if(start_date != '' && end_date !=''){
        $('#start_date_error').hide();
        $('#end_date_error').hide();
        $.ajax({
            url: grossincomeBalance_url+"/"+start_date, 
            cache: false,
            processData: false, 
            dataType:"json",
            success: function(data){
              $("#opening_balance").show("slow", function(){
                    $("#opening_balance").text('Opening balance : ' +data.opening_balance);
              });         
            }
        });

        option.data.source.read.url = grossincome_datatableurl+"/"+start_date+"/"+end_date;
        if(t==null){
            t=$(".grossincome_table").mDatatable(option);
        }
        else{
            if(!$(".grossincome_table").hasClass('m-datatable--destroyed')){
                t.destroy();
            }
            t=$(".grossincome_table").mDatatable(option);
        }
    }else if(start_date == '' && end_date !=''){
        if(!$(".grossincome_table").hasClass('m-datatable--destroyed') && t!=null){
                t.destroy();
            }
        $('#start_date_error').show();
        $('#end_date_error').hide();
        $('#opening_balance').hide();
    }else if(start_date != '' && end_date ==''){
        if(!$(".grossincome_table").hasClass('m-datatable--destroyed') && t!=null){
                t.destroy();
            }
        $('#start_date_error').hide();
        $('#end_date_error').show();
        $('#opening_balance').hide();
    }else{
        if(!$(".grossincome_table").hasClass('m-datatable--destroyed') && t!=null){
                t.destroy();
            }
        $('#start_date_error').show();
        $('#end_date_error').show();
        $('#opening_balance').hide();
    }
});



