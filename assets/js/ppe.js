$(document).ready(function(){

    var ppe_tbl = $('#ppe_tbl').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        ajax:{
            url: "../Main/get_ppe",
            dataType: "json",
            type: "POST",
            data:{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
                },
            columns: [
                    { data: "id" },
                    { data: "ppe_name" },
                    { data: "ppe_code" },
                    { data: "action" }
                ]	 

    });

    $('#ppeInsert').on('click', function(e){
        e.preventDefault();
        $('#ppe_modal').modal('show');
        
    });

    $('#ppForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../Ppe/insertPpe",
            data: $('#ppForm').serializeArray(),
            type: "POST",
            success: function(data){
                $('#ppe_modal').modal('hide');
                ppe_tbl.draw();
            }
        });
    });

    $("#ppe_tbl").on('click', '#ppeUpdate', function(e){
        e.preventDefault();
        let datas = ppe_tbl.row($(this).parents('tr')).data();
        console.log(datas);
        $('#updatePpeID').val(datas.id);
        $('#updatePpeName').val(datas.ppe_name);
        $('#updatePpeCode').val(datas.ppe_code);


        $('#updatePpe_modal').modal('show');
    });

    $('#updatePpeForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../Ppe/updatePpe",
            data: $('#updatePpeForm').serializeArray(),
            type: "POST",
            success: function(data){
                $('#updatePpe_modal').modal('hide');
                ppe_tbl.draw();
            }
        });
    });

    $("#ppe_tbl").on('click', '#ppeDelete', function(e){
        e.preventDefault();
        let datas = ppe_tbl.row($(this).parents('tr')).data();
        let id = datas.id;
        if (confirm("Press a button!") == true) {
            $.ajax({
                url: "../Ppe/deletePpe",
                data: {"id":id},
                type: "POST",
                success: function(data){
                    // var dd = json.parse()
                    ppe_tbl.draw();
                    // location.reload();
                }
            });
        }
    });

    var ppeID = 1;

    var ppe_sub_tbl = $('#ppe_sub_tbl').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        ajax:{
            url: "../Main/get_ppe_sub",
            dataType: "json",
            type: "POST",
            data: function(d){
                d.ppe_id = ppeID;
            }
                },
            columns: [
                    { data: "id" },
                    { data: "ppe_sub_name" },
                    { data: "ppe_sub_code" },
                    { data: "action" }
                ]	 

    });

    $('#ppe_tbl').on('click', '#viewPpeSub', function(e){
        e.preventDefault();        
        let datas = ppe_tbl.row($(this).parents('tr')).data();
        ppeID = datas.id;
        ppe_sub_tbl.draw();


        $('#ppeSub_modal').modal('show');
    });

    $('#ppeSubInsert').on('click', function(e){
        e.preventDefault();
        $('#txtPpeIdforSub').val(ppeID)
        $('#ppe_sub_modal').modal('show');
    });

    $('#ppeSubForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../Ppe/insertPpeSub",
            data: $('#ppeSubForm').serializeArray(),
            type: "POST",
            success: function(data){
                ppe_sub_tbl.draw();
                $('#ppe_sub_modal').modal('hide');
            }
        });
    });

    $('#ppe_sub_tbl').on('click', '#ppeSubUpdate', function(e){
        e.preventDefault();
        let datas = ppe_sub_tbl.row($(this).parents('tr')).data();
        $('#updatePpeSubID').val(datas.id);
        $('#updatePpeIdforSub').val(datas.ppe_id);
        $('#updatePpeSubName').val(datas.ppe_sub_name);
        $('#updatePpeSubCode').val(datas.ppe_sub_code);
        
        $('#updatePpe_sub_modal').modal('show');
    });

    $('#updatePpeSubForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../Ppe/updatePpeSub",
            data: $('#updatePpeSubForm').serializeArray(),
            type: "POST",
            success: function(data){
                ppe_sub_tbl.draw();
                $('#updatePpe_sub_modal').modal('hide');
            }
        });
    });

    $('#ppe_sub_tbl').on('click', '#ppeSubDelete', function(e){
        e.preventDefault();
        let datas = ppe_sub_tbl.row($(this).parents('tr')).data();
        let id = datas.id
        if (confirm("Press a button!") == true) {
            $.ajax({
                url: "../Ppe/deletePpeSub",
                data: {"id":id},
                type: "POST",
                success: function(data){
                    // var dd = json.parse()
                    ppe_sub_tbl.draw();
                    // location.reload();
                }
            });
        }
    });

});