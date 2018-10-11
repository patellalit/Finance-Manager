var Customer_Datatable= {
    init:function() {
        var t;
        var customer_data = $("#customer_datatableurl").val();
        var edit_url = $("#customer_edit_url").val();
        var delete_url = $("#customer_delete_url").val();
        var customerledger = $("#customerledger_datatableurl").val();
        t=$(".customer_table").mDatatable( {
            data: {
                type:"remote", source: {
                    read: {
                        url:customer_data, map:function(t) {
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
                field:"name", title:"Name", width: 100, template:function(t) {
                        return'\t\t\t\t\t\t<a href="'+customerledger+t.id+'">'+t.name+'</a>\t\t\t\t\t\t'
                }
            }
            , {
                field:"mobile", title:"Mobile No.", width: 200, template:function(u) {
                    var str=u.mobile.split(",");
                    var output_text = '';
                    if(str.length>1){
                        $.each(str,function(i,val){
                            output_text += '<a href="tel:'+val+'">'+val+'</a>, ';
                        });
                    }
                    else{
                        output_text += '<a href="tel:'+u.mobile+'">'+u.mobile+'</a>';
                    }
                    return output_text;
                }
            }
            , {
                field:"loan_date", title:"Loan Date", width: 80, template:function(u) {
                    if(u.loan_date=="0000-00-00" || u.loan_date==null){
                        return '-'
                    }else{
                        return u.loan_date
                    } 
                }
            }
            , {
                field:"emi_type", title:"Emi Type", template:function(t) {
                    var e= {
                        1: {
                            title: "Monthly", class: "m-badge--info"
                        }
                        , 2: {
                            title: "Weekly", class: " m-badge--primary"
                        }
                    }
                    ;
                    if(t.emi_type==1){
                        return'<span class="m-badge '+e[t.emi_type].class+' m-badge--wide">'+e[t.emi_type].title+"</span>"
                    }else{
                        return'<span class="m-badge '+e[t.emi_type].class+' m-badge--wide">'+e[t.emi_type].title+"</span>"
                    } 
                }
            }
            , {
                field:"emi_day", title:"Emi Day", width: 80, template:function(u) {
                    if(u.emi_day==null){
                        return '-'
                    }else{
                        return u.emi_day
                    } 
                }
            }
            , {
                field: "amount", title: "Amount", width: 60
            }
            , {
                field: "processing_charges", title: "Processing charges", width: 60
            }
            , {
                field: "emi_amount", title: "Emi Amount", width: 60
            }
            , {
                field: "emi_interest", title: "Emi Interest", width: 60
            }
            , {
                field: "total_emi", title: "Total Emi", width: 60
            }
            , {
                field: "emi_month", title: "Emi Count", width: 60
            }
            , {
                field: "closing_balance", title: "Closing Balance", width: 60
            }
            , {
                field:"loan_closed", title:"Loan Closed", template:function(t) {
                    var e= {
                        0: {
                            title: "Open", class: "m-badge--info"
                        }
                        , 1: {
                            title: "Closed", class: " m-badge--primary"
                        }
                    }
                    ;
                    if(t.loan_closed==1){
                        return'<span class="m-badge '+e[t.loan_closed].class+' m-badge--wide">'+e[t.loan_closed].title+"</span>"
                    }else{
                        return'<span class="m-badge '+e[t.loan_closed].class+' m-badge--wide">'+e[t.loan_closed].title+"</span>"
                    } 
                }
            }
            , {
                field:"loan_closed_date", title:"Closed Date", width: 80, template:function(u) {
                    if(u.loan_closed_date=="0000-00-00" || u.loan_closed_date==null){
                        return '-'
                    }else{
                        return u.loan_closed_date
                    } 
                }
            }
            , {
                field: "created_at", title: "Created Date", width: 80
            }
            , {
                field:"updated_at", title:"Updated Date", width: 80, template:function(u) {
                    if(u.updated_at=="0000-00-00 00:00:00"){
                        return '-'
                    }else{
                        return u.updated_at
                    } 
                }
            }
            , {
                field:"Actions", width:110, title:"Actions", sortable:!1, overflow:"visible", template:function(t, e, a) {
                    return'\t\t\t\t\t\t<a href="'+edit_url+t.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="javascript:void(0);" data-toggle="modal" data-target="#delModal" data-id="'+t.id+'" onclick="request_delete_record(this);" id="customer_id_'+t.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t'
                }
            }
            ]
        }
        )
    }
}

;
jQuery(document).ready(function() {
    Customer_Datatable.init()
});

function request_delete_record(e){
      $("#del_id").val($(e).data('id'));
}

function delete_record(){
    var id = $("#del_id").val();
    $.ajax({
        url: BASE_URL+"customer/delete/"+id,
        type: 'POST',
        data: { },
        success: function (data){
            $('#delModal').modal('toggle');
            $('#customer_id_'+id).closest('tr').remove();
        }
    });
}

