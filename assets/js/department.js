$(document).ready(function(){
    var department_tbl = $('#department_tbl').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        ajax:{
            url: "../Main/get_department",
            dataType: "json",
            type: "POST",
            data:{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
                },
            columns: [
                    { data: "id" },
                    { data: "department_name" },
                    { data: "department_code" },
                    { data: "action" }
                ]	 

    });

    $('#departmentInsert').on('click', function(e){
        e.preventDefault();
        $('#department_modal').modal('show');
        
    });

    $('#departmentForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../Department/insertDepartment",
            data: $('#departmentForm').serializeArray(),
            type: "POST",
            success: function(data){
                $('#department_modal').modal('hide');
                department_tbl.draw();
            }
        });
    });

    $("#department_tbl").on('click', '#departmentUpdate', function(e){
        e.preventDefault();
        let datas = department_tbl.row($(this).parents('tr')).data();
        console.log(datas);
        $('#updateDepartmentID').val(datas.id);
        $('#updateDepartmentName').val(datas.department_name);
        $('#updateDepartmentCode').val(datas.department_code);


        $('#updateDepartment_modal').modal('show');
    });

    $('#updateDepartmentForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../Department/updateDepartment",
            data: $('#updateDepartmentForm').serializeArray(),
            type: "POST",
            success: function(data){
                $('#updateDepartment_modal').modal('hide');
                department_tbl.draw();
            }
        });
    });



    $("#department_tbl").on('click', '#departmentDelete', function(e){
        e.preventDefault();
        let datas = department_tbl.row($(this).parents('tr')).data();
        let id = datas.id;
        if (confirm("Press a button!") == true) {
            $.ajax({
                url: "../Department/deleteDepartment",
                data: {"id":id},
                type: "POST",
                success: function(data){
                    // var dd = json.parse()
                    department_tbl.draw();
                    // location.reload();
                }
            });
        }
    });
});