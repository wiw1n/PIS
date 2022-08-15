$(document).ready(function(){
    $('#txtUnitValue, #txtPropertyCard, #txtPhysicalCount, #updateUnitMeasure, #updateUnitValue, #updatePropertyCard, #updatePhysicalCount').keypress(function (evt) {    
    
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
        {
            evt.preventDefault();
        }                       

    });

    // $("input[type=text]").keyup(function () {  
    //     $(this).val($(this).val().toUpperCase());  
    // }); 
   

    // =========> USERS OR EMPLOYEE <=========
   

    $("#empInsert").on("click", function(){
        $("#employee_modal").modal("show");
    });    

    $("#employeeForm").on("submit", function(e){
        e.preventDefault();
        if ($("#txtPassword1").val() == $("#txtPassword2").val()){
            $.ajax({
                url: "../User/insertEmployee",
                data: $("#employeeForm").serialize(),
                type: "POST",
                success: function(data){
                    // var dd = json.parse()
                    location.reload();
                }
            });
        }else{
            alert("Mismatched Password!");
        }
        
    });    

    var employee_tbl = $('#employee_tbl').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        ajax:{
        url: "../Main/get_employee",
        dataType: "json",
        type: "POST",
        data:{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
        columns: [
                { data: "id" },
                { data: "id_number" },
                { data: "lastname" },
                { data: "firstname" },
                { data: "middlename" },
                { data: "email" },
                { data: "department" },
                { data: "position" },
                { data: "role" },
                { data: "action" }
            ]	 

    });


    $("#employee_tbl").on('click','#empUpdate',function(e){
        e.preventDefault();
        // get the current row
        let datas = employee_tbl.row($(this).parents('tr')).data();
        console.log(datas);
        $("#updateID").val(datas['id']);
        $("#updateIdNo").val(datas['id_number']);
        $("#updateLastname").val(datas['lastname']);
        $("#updateFirstname").val(datas['firstname']);
        $("#updateMiddlename").val(datas['middlename']);
        $("#updateEmail").val(datas['email']);
        $("#updateDepartment").val(datas['department_id']);
        $("#updatePosition").val(datas['position']);     
        $("#updateRole").val(datas['role_id']);     

        $("#updateEmployee_modal").modal("show");
   });

    $("#updateEmployeeForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../User/updateEmployee",
            data: $("#updateEmployeeForm").serialize(),
            type: "POST",
            success: function(data){
                // var dd = json.parse()
                employee_tbl.draw();
                $("#updateEmployee_modal").modal("hide");
            }
        });
    });

    $("#employee_tbl").on('click','#empDelete',function(e){
        // get the current row
        e.preventDefault();
        var currentRow=$(this).closest("tr"); 

        var id = currentRow.find("td:eq(0)").html();
      
        let text;
        if (confirm("Press a button!") == true) {
            $.ajax({
                url: "../User/deleteEmployee",
                data: {"id":id},
                type: "POST",
                success: function(data){
                    employee_tbl.draw();                    
                    $('#employee_modal').modal('hide');
                    // var dd = json.parse()
                    // location.reload();
                }
            });
        }
    });

    $('#employee_tbl').on('click', '#changePass', function(e){
        e.preventDefault();
        let datas = employee_tbl.row($(this).parents('tr')).data();
        var id = datas['id'];
        $('#changePassID').val(id);
        $('#changePass_modal').modal('show');        
    });

    $('#changePass_form').on('submit', function(e){
        e.preventDefault();
        var password = $('#updatePassword').val();
        var id = $('#changePassID').val();
        if ($("#updatePassword").val() == $("#updatePassword2").val()){
            $.ajax({
                url: "../User/changePassword",
                data: {"id":id, "password":password},
                type: "POST",
                success: function(data){
                    employee_tbl.draw();
                    alert("Change password successfully")
                    $('#changePass_modal').modal('hide');
                    // var dd = json.parse()
                    // location.reload();
                }
            });
        }else{
            alert("Mismatched Password!");
        }        

    })

    $('#txtPassword1, #txtPassword2').on('keyup', function () {
        if ($('#txtPassword1').val() == $('#txtPassword2').val()) {
            $('#message').html('Matching').css('color', 'green');            
        } else 
            $('#message').html('Not Matching').css('color', 'red');
    });

    $('#updatePassword, #updatePassword2').on('keyup', function () {
        if ($('#updatePassword').val() == $('#updatePassword2').val()) {
            $('#updateMessage').html('Matching').css('color', 'green');            
        } else 
            $('#updateMessage').html('Not Matching').css('color', 'red');
    });


    // ==========> PROPERTY FUNCTIONS <===========    

    $('#txtUnitMeasure, #txtUnitValue').on('keyup', function () {
        let totalCost = ($('#txtUnitMeasure').val() * $('#txtUnitValue').val());
        $('#txtTotalCost').val(totalCost);
    });


    $("#propertyInsert").on("click", function(e){
        e.preventDefault();
        resetProp();
        $('input, select').val('');
        $.ajax({
            url: "../Equipment/getMaxId",
            // data: $("#propertyForm").serialize(),
            type: "POST",
            success: function(data){
                let id = JSON.parse(data);
                console.log(id);
                // alert(getSerialNumber(parseInt(id.id) + 1));
                if (id.id == null) {
                    $('#propSerial').text("001");
                }else{
                    $('#propSerial').text(getSerialNumber((parseInt(id.id) + 1)));
                }                
                getNewProperty();
            }
        });

        $.ajax({
            url: "../Equipment/get_PPEAccount",
            type: "POST",
            success: function(data){
                let ppeAccount = JSON.parse(data);
                $('#txtPpe').empty().append($("<option disabled='disabled' SELECTED>").val("").text("-- Select PPE Group --"));
                $.each(ppeAccount, function(index, value) {
                    $('#txtPpe').append($('<option>').val(value.id).text(value.ppe_name + " (" + value.ppe_code + ")"));
                });    
            }
        });

        $('#txtNewProperty').val($('#newProp').text());
        $("#txtPpeSub").removeAttr("readonly");
        $('#txtPpeSub').prop('disabled', true);
        // $('#txtPpeSub').empty().append($("<option disabled='disabled' SELECTED>").val("").text("-- Select One --"));
        
        $("#property_modal").modal("show");
    });    

    var propertyTable = $('#property_tbl').DataTable( {
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax:{
            url: "../Main/get_property",
            dataType: "json",
            type: "POST",
            data:function ( d ) {
                d.filterByDate = $('#selectDateInsert').val();
                d.fiterByAccountable = $('#selectAccountable').val();
        }
                },
        columns: [
                { data: "id" },
                { data: "ppe_account_group" },
                { data: "ppe_sub_account_group" },
                { data: "item" },
                { data: "description" },
                { data: "purchase_date" },
                { data: "old_property" },
                { data: "property_no" },
                { data: "unit_measure" },
                { data: "unit_value" },
                { data: "qty_per_property_card" },
                { data: "qty_per_physical_count" },                
                { data: "accountable" },
                { data: "location" },
                { data: "user" },
                { data: "condition" },
                { data: "remarks" },
                { data: "action" }
            ]	       
    });

    $("#property_tbl").on('click','#propertyUpdate',function(e){
        e.preventDefault();
        // resetProp();
        let datas = propertyTable.row($(this).parents('tr')).data();
        const now = new Date(datas['purchase_date']);
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        setTimeout(function() {
            $.ajax({
                url: "../Equipment/get_PPESubAccount",
                type: "POST",
                data: {"id":datas['ppe_id']},
                success: function(data){
                    let ppeSubAccount = JSON.parse(data);
                    $('#updatePpeSub').empty().append($("<option disabled='disabled'>").val("").text("-- Select SUB PPE Group --"));
                    $.each(ppeSubAccount, function(index, value) {
                        $('#updatePpeSub').append($('<option>').val(value.id).text(value.ppe_sub_name + " (" + value.ppe_sub_code + ")"));
                    }); 
                    $("#updatePpeSub").val(datas['ppe_sub_id']);  
                    $('#updatePropSub').text(getLastNumber($("#updatePpeSub option:selected").text(), 2));
                    getNewPropertyUpdate();
                }
            });
        }, 1000);
        
        $("#updatePpeSub").removeAttr("readonly");
        $('#updatePpeSub').prop('disabled', true);
        
        
        $("#updateID").val(datas['id']);    
        $("#updatePpe").val(datas['ppe_id']);    
        $("#updatePpeSub").val(datas['ppe_sub_id']);    
        $("#updateItem").val(datas['item']);    
        $("#updateDescription").val(datas['description']);    
        $("#updatePurchaseDate").val(today);    
        $("#updateOldProperty").val(datas['old_property']);    
        $("#updateNewProperty").val(datas['property_no']);    
        $("#updateUnitMeasure").val(datas['unit_measure']);
        $("#updateUnitValue").val(datas['unit_value']);
        $("#updatePropertyCard").val(datas['qty_per_property_card']);    
        $("#updatePhysicalCount").val(datas['qty_per_physical_count']);    
        $("#updateAccountable").val(datas['accountable_id']);    
        $("#updateLocation").val(datas['location_id']);    
        $("#updateUser").val(datas['user_id']);    
        $("#updateCondition").val(datas['condition']);    
        $("#updateRemarks").val(datas['remarks']);



        
        $('#updatePropDate').text(now.getFullYear()); 
        $('#updatePropPpe').text(getLastNumber($("#updatePpe option:selected").text(), 2));
        $('#updatePropSub').text(getLastNumber($("#updatePpeSub option:selected").text(), 2));
        $('#updatePropSerial').text(getSerialNumber(datas['id']));
        $('#updatePropDepartment').text(getLastNumber($("#updateLocation option:selected").text(), 4));
        getNewPropertyUpdate();


        $("#updateProperty_modal").modal("show");
   });

    $("#propertyForm").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url: "../Equipment/insertProperty",
            data: $("#propertyForm").serialize(),
            type: "POST",
            success: function(data){
                propertyTable.row( this ).remove().draw( false );
                $("#property_modal").modal("hide");

            }
        });
    });

    $("#propertyFormUpdate").on("submit", function(e){
        e.preventDefault();
        // console.log($("#propertyFormUpdate").serialize());
        $('#updatePpeSub').prop('disabled', false);
        $.ajax({
            url: "../Equipment/updateProperty",
            data: $("#propertyFormUpdate").serialize(),
            type: "POST",
            success: function(data){
                // var dd = JSON.parse(data);
                // location.reload();
                // propertyTable.page(2).draw();
                propertyTable.row( this ).remove().draw( false );
                $("#updateProperty_modal").modal("hide");
            }
        });
    });

    $('#txtPurchaseDate').on('change', function(){
        const d1 = new Date($('#txtPurchaseDate').val());
        let thisYear1 = d1.getFullYear();
        $('#propDate').text(thisYear1);    
        getNewProperty();
    });

    $('#updatePurchaseDate').on('change', function(){
        const d2 = new Date($('#updatePurchaseDate').val());
        let thisYear2 = d2.getFullYear();
        $('#updatePropDate').text(thisYear2);    
        getNewPropertyUpdate();
    });

    $('#txtPpe').on('change', function() {
        let id = this.value;
        $('#propPpe').text(getLastNumber($("#txtPpe option:selected").text(), 2));
        $("#txtPpeSub").removeAttr("readonly");
        $.ajax({
            url: "../Equipment/get_PPESubAccount",
            data: {"id":id},
            type: "POST",
            success: function(data){
                let subAccount = JSON.parse(data);
                $('#txtPpeSub').prop('disabled', false);
                $('#txtPpeSub').empty().append($("<option disabled='disabled' SELECTED>").val("").text("-- Select One --"));
                $.each(subAccount, function(index, value) {
                    $('#txtPpeSub').append($('<option>').val(value.id).text(value.ppe_sub_name + " (" + value.ppe_sub_code + ")"));
                });               
            }
        });
        getNewProperty();
    });

    $('#updatePpe').on('change', function() {
        let id = this.value;
        $('#updatePropPpe').text(getLastNumber($("#updatePpe option:selected").text(), 2));
        $("#updatePpeSub").removeAttr("readonly");
        $.ajax({
            url: "../Equipment/get_PPESubAccount",
            data: {"id":id},
            type: "POST",
            success: function(data){
                let subAccount = JSON.parse(data);
                $('#updatePpeSub').prop('disabled', false);
                $('#updatePpeSub').empty().append($("<option disabled='disabled' SELECTED>").val("").text("-- Select One --"));
                $.each(subAccount, function(index, value) {
                    $('#updatePpeSub').append($('<option>').val(value.id).text(value.ppe_sub_name + " (" + value.ppe_sub_code + ")"));
                });               
            }
        });
        getNewPropertyUpdate();
    });

    $('#txtPpeSub').on('change', function(){
        $('#propSub').text(getLastNumber($("#txtPpeSub option:selected").text(), 2));
        getNewProperty();
    });

    $('#updatePpeSub').on('change', function(){
        $('#updatePropSub').text(getLastNumber($("#updatePpeSub option:selected").text(), 2));
        getNewPropertyUpdate();
    });

    $('#txtLocation').on('change', function(){
        $('#txtLocationHidden').val($("#txtLocation option:selected").text());
        $('#propDepartment').text(getLastNumber($("#txtLocation option:selected").text(), 4));
        getNewProperty();
    });

    $('#updateLocation').on('change', function(){
        $('#updateLocationHidden').val($("#updateLocation option:selected").text());
        $('#updatePropDepartment').text(getLastNumber($("#updateLocation option:selected").text(), 4));        
        getNewPropertyUpdate();
    });

    $('#txtAccountable').on('change', function(){
        $('#txtAccountableHidden').val($("#txtAccountable option:selected").text());
    });

    $('#updateAccountable').on('change', function(){
        $('#updateAccountableHidden').val($("#updateAccountable option:selected").text());
    });

    $("#property_tbl").on('click','#propertyDelete',function(e){
        e.preventDefault();
        // get the current row
        var currentRow=$(this).closest("tr"); 

        var id = currentRow.find("td:eq(0)").html();
       
        let text;
        if (confirm("Press a button!") == true) {
            $.ajax({
                url: "../Equipment/deleteProperty",
                data: {"id":id},
                type: "POST",
                success: function(data){
                    // var dd = json.parse()
                    propertyTable.draw();
                    // location.reload();
                }
            });
        }
    });

    $('#property_tbl').on('click', '#viewBarcode', function(e){
        e.preventDefault();
        var currentRow=$(this).closest("tr"); 
        var id = currentRow.find("td:eq(0)").html();
        $.ajax({
            url: "../Equipment/viewBarcode",
            data: {"id":id},
            type: "POST",
            success: function(data){
                let datas = JSON.parse(data);
                let string = datas[0].barcode;
                console.log(datas);
                console.log(string);
                // var encodedString = btoa(string);
                var decodedString = atob(string);
                console.log(decodedString);
                $("#imgBarcode").attr("href", '../'+decodedString)
                $('#imgBarcode2').attr('src', '../'+decodedString);
                $('#barcode_modal').modal('show');
            }
        });        
    });

    $('#property_tbl').on('click', '#downloadExcel', function(e){
        e.preventDefault();
        var currentRow=$(this).closest("tr"); 
        var id = currentRow.find("td:eq(0)").html();
        // window.open('../Main/exportReport?id='.id );
        $.ajax({
            url: "../Equipment/exportReport",
            data: {"id":id,"user_id":''},
            type: "POST",
            dataType: "json",
            beforeSend: function(){
                $('#loader_modal').modal('show');
            },
            success: function(data){
                $.each(data, function(i,e){
                    var $a = $("<a>");
                    $a.attr("href",e.file);
                    $("body").append($a);
                    $a.attr("download", e.op + ".xlsx");
                    $a[0].click();
                    $a.remove();
                });
                $('#loader_modal').modal('hide');
                // alert(data);
                // window.open('../Main/home','_blank' );
            }
        });
    });

    $('#exportProperty').on('click', function(e){
        let user_id = $('#selectAccountable').val();
        let date_added = $('#selectDateInsert').val();
        e.preventDefault();
        $.ajax({
            url: "../Equipment/exportReport",
            data: {"id":'', "user_id":user_id, "date_added":date_added},
            type: "POST",
            dataType: "json",
            // beforeSend: function(){
                // $('#loader_modal').modal('show');
            // },
            success: function(data){
                do_dl(data);                
                // $('#loader_modal').modal('hide');
            }
        });
        
    });

    $('#printBarcode').on('click', function(){
        var contents = $(".imgBarcode").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        // frame1.css({ "position": "absolute", "top": "-1000000px", "margin":"0"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        // frameDoc.document.write('<html><head><title>DIV Contents</title>');
        $(".imgBarcode").css("display","none");
		$(".imgBarcode").css("display","block");
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        // frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });    

    // $('#selectDepartment').on('change', function(){
    //     propertyTable.draw();
    // });

    $('#selectAccountable').on('change', function(e){
        e.preventDefault();
        // alert($('#selectAccountable').val());
        propertyTable.draw();
    });

    $('#selectDateInsert').on('change', function(e){
        e.preventDefault();
        // alert($('#selectAccountable').val());
        propertyTable.draw();
    });

    
    // ==========> IP ALLOCATION FUNCTIONS <=========== 

    var ip_tbl = $('#ip_tbl').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        ajax:{
            url: "../IpAllocation/get_allocation",
            dataType: "json",
            type: "POST",
            data:{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
        columns: [
                { data: "id" },
                { data: "subnet_address" },
                { data: "name" },
                { data: "description" },
                { data: "size" },
                { data: "used" },
            { data: "action" }
        ]	 

    });

    $('#IPInsert').on('click', function(e){
        e.preventDefault();
        $('#insertIP_modal').modal('show');
    });

    $('#insertIPForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../IpAllocation/insertIP",
            data: $('#insertIPForm').serialize(),
            type: "POST",
            success: function(data){
                console.log(data);
                ip_tbl.draw();
                $('#insertIP_modal').modal('hide');
            }
        })
    });

    $('#ip_tbl').on('click', '#ipUpdate', function(e){
        e.preventDefault();
        let datas = ip_tbl.row($(this).parents('tr')).data();
        $('#updateateAddressID').val(datas.id);
        $('#updateSubnetAddress').val(datas.subnet_address);
        $('#updateAddressName').val(datas.name);
        $('#updateAddressDescription').val(datas.description);
        $('#updateAddressSize').val(datas.size);
        $('#updateAddressUsage').val(datas.used);


        $('#updateIP_modal').modal('show');
    });

    $('#updateIPForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../IpAllocation/updateIP",
            data: $('#updateIPForm').serialize(),
            type: "POST",
            success: function(data){
                // console.log(data);
                ip_tbl.draw();
                $('#updateIP_modal').modal('hide');
            }
        })
    });

    $('#ip_tbl').on('click', '#viewAddresses', function(e){
        e.preventDefault();
        $('#viewAddresses_modal').modal('show');
    });

    $('#ip_tbl').on('click', '#ipDelete', function(e){
        e.preventDefault();

        var currentRow=$(this).closest("tr"); 
        var id = currentRow.find("td:eq(0)").html();
        
       
        let text;
        if (confirm("Press a button!") == true) {
            $.ajax({
                url: "../IpAllocation/deleteIP",
                data: {"id":id},
                type: "POST",
                success: function(data){
                    // var dd = json.parse()
                    ip_tbl.draw();
                }
            });
        }
    });
});

function getLastNumber(str, num){
    let result = str.substring(str.length - (num + 1));
    result = result.substring(0,num);

    return result;
}

function getNewProperty(){
    $('#txtNewProperty').val($('#newProp').text());
    // $('#updateNewProperty').val($('#updateNewProp').text());
}

function getNewPropertyUpdate(){
    $('#updateNewProperty').val($('#updateNewProp').text());
}

function resetProp(){
    $('#propDate').text("0000");
    $('#propPpe').text("00");
    $('#propSub').text("00");
    $('#propSerial').text("000");
    $('#propDepartment').text("0000");

    $('#updatePropDate').text("0000");
    $('#updatePropPpe').text("00");
    $('#updatePropSub').text("00");
    $('#updatePropSerial').text("000");
    $('#updatePropDepartment').text("0000");
}

function getSerialNumber(id){
    let idLength = id.toString().length;
    if  (idLength == 1){
        id = "00" + id;
    }else if (idLength == 2){
        id = "0" + id;
    }
    return id;
}


function download_files(files) {
    function download_next(i) {
        // alert(files.length);
        if (i >= files.length) {
            return;
        }
        var a = document.createElement('a');
        a.href = files[i].file;
        // a.attr = ("download", files[i].op + ".xlsx");
        a.target = a.op + ".xlsx";

        if ('appendix66' in a) {
            a.file = files[i].file;
        }

        (document.body || document.documentElement).appendChild(a);
        if (a.click) {
            a.download = files[i].op + ".xlsx";
            a.click(); // The click method is supported by most browsers.
        }
        else {
            window.open(files[i].file);
        }
        console.log('1');
        a.parentNode.removeChild(a);
        setTimeout(function() {
            download_next(i + 1);
        }, 1000);
    }
    // Initiate the first download.
    download_next(0);
}

function do_dl(files) {
 download_files(files);
};
