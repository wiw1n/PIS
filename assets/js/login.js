$(document).ready(function(){   
    $('#formLogin').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "../User/login",
            data: $("#formLogin").serialize(),
            type: "POST",
            success: function(data){
                let dd = JSON.parse(data);
                if (dd.message == "Success!") {
                    window.location.replace("../Main/dashboard");
                }else{
                    alert("Incorrect username or password!");
                }
            }
        });
    });
});
