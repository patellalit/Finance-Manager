var Cash_Datatable= {
    init:function() {
        var t;
        var cash_data = $("#cash_datatableurl").val();
        var edit_url = $("#cash_edit_url").val();
        var delete_url = $("#cash_delete_url").val();
        t=$(".cash_table").mDatatable( {
            data: {
                type:"remote", source: {
                    read: {
                        url:cash_data, map:function(t) {
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
                field: "title", title: "Title", width: 80
            }
            , {
                field:"cash_date", title:"Cash Date", width: 80, template:function(u) {
                    if(u.cash_date=="0000-00-00" || u.cash_date==null){
                        return '-'
                    }else{
                        return u.cash_date
                    } 
                }
            }
            , {
                field: "amount", title: "Amount", width: 60
            }
            , {
                field:"description", title:"Description", width: 200, template:function(q) {
                    var str=q.description;
                    if(str.length >= 30){
                        str = unescape(str);
                        return str.replace(/(<([^>]+)>)/ig,"").substring(0,30);
                    }else{
                        return str
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
                    return'\t\t\t\t\t\t<a href="'+edit_url+t.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="javascript:void(0);" data-toggle="modal" data-target="#delModal" data-id="'+t.id+'" onclick="request_delete_record(this);" id="cash_id_'+t.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t'
                }
            }
            ]
        }
        )
    }
}

;
jQuery(document).ready(function() {
    Cash_Datatable.init()
});

function request_delete_record(e){
      $("#del_id").val($(e).data('id'));
}

function delete_record(){
    var id = $("#del_id").val();
    $.ajax({
        url: BASE_URL+"cash/delete/"+id,
        type: 'POST',
        data: { },
        success: function (data){
            $('#delModal').modal('toggle');
            $('#cash_id_'+id).closest('tr').remove();
        }
    });
}
