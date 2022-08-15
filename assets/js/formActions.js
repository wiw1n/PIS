
function loadModal(modal_id, btn_id) {
    $('#'+btn_id).on('click', function(e){
        e.preventDefault();
        $('#'+modal_id).modal('show');
    });
}

function submitFormAction(form_id, stringUrl, modal_id, datatable) {
    $('#'+form_id).on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: stringUrl,
            data: $('#'+form_id).serializeArray(),
            type: 'POST',
            success: function(e){
                datatable.draw();
                $('#'+modal_id).modal('hide');
            }
        });
    });
}

function deleteRowTable(tbl_id_string, stringUrl, datatable) {
    $('#'+tbl_id_string).on('click', '#delete', function(e){
        e.preventDefault();
        let datas = datatable.row($(this).parents('tr')).data();
        let id = datas.id;
        if (confirm("Press OK to confirm delete!") == true) {
            $.ajax({
                url: stringUrl,
                data: {"id":id},
                type: "POST",
                success: function(data){
                    // var dd = json.parse()
                    datatable.draw();
                    // location.reload();
                }
            });
        }
    });
}

function updateRowTableStatus(tbl_id_string, stringUrl, datatable) {
    $('#'+tbl_id_string).on('click', '#status', function(e){
        e.preventDefault();
        let datas = datatable.row($(this).parents('tr')).data();
        let id = datas.id;
        let status = datas.active;
        if (confirm("Press OK to confirm action!") == true) {
            $.ajax({
                url: stringUrl,
                data: {"id":id, "status":status},
                type: "POST",
                success: function(data){
                    // var dd = json.parse()
                    datatable.draw();
                    // location.reload();
                }
            });
        }
    });
}

