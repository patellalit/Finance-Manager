var actual_url = $("#outstanding_datatableurl").val();
var outstanding_data = $("#outstanding_datatableurl").val();
var customerledger = $("#customerledger_datatableurl").val();
var type_val = $("#emi_type").val();
outstanding_data=outstanding_data+"/"+type_val;
var t;
var option ={
            data: {
                type:"remote", source: {
                    read: {
                        url:outstanding_data, map:function(t) {
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
            , columns:[ {
                field: "id", title: "#", sortable: !1, width: 40, selector: !1, textAlign: "center"
            }
            , {
                field:"date", title:"Date", width: 100, template:function(t) {
                    if(t.miss_emi==null){
                        return t.date
                    }else if (t.miss_emi>0){
                        return'<span style="color:red">'+t.date+"</span>"
                    }else{
                        return'<span style="color:green">'+t.date+"</span>"
                    }
                }
            }
            , {
                field:"name", title:"Name", width: 100, template:function(t) {
                    if(t.miss_emi==null){
                        return'\t\t\t\t\t\t<a href="'+customerledger+t.id+'">'+t.name+'</a>\t\t\t\t\t\t'
                    }else if(t.miss_emi>0){
                        return'\t\t\t\t\t\t<a href="'+customerledger+t.id+'" style="color:red">'+t.name+'</a>\t\t\t\t\t\t'
                    }else{
                        return'\t\t\t\t\t\t<a href="'+customerledger+t.id+'" style="color:green">'+t.name+'</a>\t\t\t\t\t\t'
                    } 
                }
            }
            , {
                field:"mobile", title:"Mobile No.", width: 200, template:function(t) {
                    var str=t.mobile.split(",");
                    var output_text = '';
                    if(t.miss_emi==null){
                        if(str.length>1){
                            $.each(str,function(i,val){
                                output_text += '<a href="tel:'+val+'">'+val+'</a>, ';
                            });
                        }else{
                            output_text += '<a href="tel:'+t.mobile+'">'+t.mobile+'</a>';
                        }
                        return output_text;
                    }else if(t.miss_emi>0){
                        if(str.length>1){
                            $.each(str,function(i,val){
                                output_text += '<a href="tel:'+val+'" style="color:red">'+val+'</a>, ';
                            });
                        }else{
                            output_text += '<a href="tel:'+t.mobile+'" style="color:red">'+t.mobile+'</a>';
                        }
                        return output_text;
                    }else{
                        if(str.length>1){
                            $.each(str,function(i,val){
                                output_text += '<a href="tel:'+val+'" style="color:green">'+val+'</a>, ';
                            });
                        }else{
                            output_text += '<a href="tel:'+t.mobile+'" style="color:green">'+t.mobile+'</a>';
                        }
                        return output_text;
                    }  
                }
            }
            , {
                field:"loan_date", title:"Loan Date", width: 80, template:function(t) {
                    if(t.miss_emi==null){
                        if(t.loan_date=="00-00-0000" || t.loan_date==null){
                            return '-'
                        }else{
                            return t.loan_date;
                        }
                    }else if(t.miss_emi>0){
                        if(t.loan_date=="00-00-0000" || t.loan_date==null){
                            return '-'
                        }else{
                            return'<span style="color:red">'+t.loan_date+"</span>"
                        }
                    }else{
                        if(t.loan_date=="00-00-0000" || t.loan_date==null){
                            return '-'
                        }else{
                            return'<span style="color:green">'+t.loan_date+"</span>"
                        }
                    } 
                }
            }
            , {
                field:"amount", title:"Loan Amount", width: 80, template:function(t) {
                    if(t.miss_emi==null){
                        return t.amount
                    }else if(t.miss_emi>0){
                        return'<span style="color:red">'+t.amount+"</span>"
                    }else{
                        return'<span style="color:green">'+t.amount+"</span>"
                    }  
                }
            }
            , {
                field:"total_emi", title:"Total Emi", width: 80, template:function(t) {
                    if(t.miss_emi==null){
                        return t.total_emi
                    }else if(t.miss_emi>0){
                        return'<span style="color:red">'+t.total_emi+"</span>"
                    }else{
                        return'<span style="color:green">'+t.total_emi+"</span>"
                    } 
                }
            }
            , {
                field:"emi_month", title:"Emi Count", width: 80, template:function(t) {
                    if(t.miss_emi==null){
                        return t.emi_month
                    }else if(t.miss_emi>0){
                        return'<span style="color:red">'+t.emi_month+"</span>"
                    }else{
                        return'<span style="color:green">'+t.emi_month+"</span>"
                    } 
                }
            }
            , {
                field:"closing_balance", title:"Closing Balance", width: 80, template:function(t) {
                    if(t.miss_emi==null){
                        return t.closing_balance
                    }else if(t.miss_emi>0){
                        return'<span style="color:red">'+t.closing_balance+"</span>"
                    }else{
                        return'<span style="color:green">'+t.closing_balance+"</span>"
                    } 
                }
            }
            , {
                field:"remaining_month", title:"Remaining Emi", width: 80, template:function(t) {
                    if(t.miss_emi==null){
                        return t.remaining_month
                    }else if(t.miss_emi>0){
                        return'<span style="color:red">'+t.remaining_month+"</span>"
                    }else{
                        return'<span style="color:green">'+t.remaining_month+"</span>"
                    }
                }
            }
            , {
                field:"miss_emi", title:"Miss Emi", width: 80, template:function(t) {
                    if(t.miss_emi==null){
                        return '-'
                    }else if(t.miss_emi>0){
                        return'<span style="color:red">'+t.miss_emi+"</span>"
                    }else{
                        return'<span style="color:green">'+t.miss_emi+"</span>"
                    }
                }
            }
            ]
        };
$("#emi_type").selectpicker();
$("#emi_type").change(function(){
    var type_val=$("#emi_type").val();
    t.destroy();
    if(type_val=='1' || type_val=='2'){
        option.data.source.read.url = actual_url+"/"+type_val;
    }else{
        option.data.source.read.url = actual_url;
    }
    t=$(".outstanding_table").mDatatable(option);
});
t=$(".outstanding_table").mDatatable(option);

