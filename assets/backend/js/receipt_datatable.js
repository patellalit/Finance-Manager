var Receipt_Datatable= {
    init:function() {
        var t;
        var receipt_data = $("#receipt_datatableurl").val();
        var edit_url = $("#receipt_edit_url").val();
        var delete_url = $("#receipt_delete_url").val();
        t=$(".receipt_table").mDatatable( {
            data: {
                type:"remote", source: {
                    read: {
                        url:receipt_data, map:function(t) {
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
                field: "customer_name", title: "Name", width: 60
            }
            , {
                field:"receipt_date", title:"Receipt Date", width: 80, template:function(u) {
                    if(u.receipt_date=="0000-00-00" || u.receipt_date==null){
                        return '-'
                    }else{
                        return u.receipt_date
                    } 
                }
            }
            , {
                field: "emi", title: "Emi", width: 60
            }
            , {
                field: "interest_income", title: "Interest Income", width: 60
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
                    return'\t\t\t\t\t\t<a href="'+edit_url+t.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="javascript:void(0);" data-toggle="modal" data-target="#delModal" data-id="'+t.id+'" onclick="request_delete_record(this);" id="receipt_id_'+t.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t'
                }
            }
            ]
        }
        )
    }
}

;
jQuery(document).ready(function() {
    Receipt_Datatable.init()
});

function request_delete_record(e){
      $("#del_id").val($(e).data('id'));
}

function delete_record(){
    var id = $("#del_id").val();
    $.ajax({
        url: BASE_URL+"receipt/delete/"+id,
        type: 'POST',
        data: { },
        success: function (data){
            $('#delModal').modal('toggle');
            $('#receipt_id_'+id).closest('tr').remove();
        }
    });
}

