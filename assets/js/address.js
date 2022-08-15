
$(document).ready(function(){

    var address_tbl = $('#address_tbl').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        ajax:{
            url: "../Main/get_address",
            dataType: "json",
            type: "POST",
            data:{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
                },
            columns: [
                    { data: "id" },
                    { data: "ip_address" },
                    { data: "subnet" },
                    { data: "active" },
                    { data: "action" }
                ]	 

    });

    $('#address_tbl').on('click', '#update', function(e){
        e.preventDefault();
        // let datas = datatable.row($(this).parents('tr')).data();
        let data = address_tbl.row($(this).parents('tr')).data();

        $('#addressID').val(data.id);
        $('#txtIpAddress_update').val(data.ip_address);
        $('#txtSubnetMask_update').val(data.subnet);
        $('#txtStatus_update').val(data.status);

        $('#address_update_modal').modal('show');
    });


    loadModal('address_modal', 'addressInsert');
    submitFormAction('address_form', '../IP_Address/insertIPAddress', 'address_modal', address_tbl);
    submitFormAction('address_update_form', '../IP_Address/updateIPAddress', 'address_update_modal', address_tbl);
    deleteRowTable('address_tbl','../IP_Address/deleteIPAddress', address_tbl);

    $('#address_tbl').on('click', '#ping', function(e){
        e.preventDefault();
        let data = address_tbl.row($(this).parents('tr')).data();
        let ip_address = data.ip_address;
        let id = data.id;
        $.ajax({
            url: '../IP_Address/ping_idAddress',
            data: {'ip_address':ip_address, 'id':id},
            type: 'POST',
            beforeSend: function(){
                $('#loader_modal').modal('show');
            },  
            success: function(datas) {
                let data = JSON.parse(datas);
                alert(data[7]);
                $('#loader_modal').modal('hide');
            }
        });
        // alert(ip_address);
    });
});