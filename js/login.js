$(document).ready(function(){


    $('#loginButton').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: './controllers/indexController.php',
            type: 'POST',
            data: { username: username, password: password},
            success: function(response){
                try {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
                    if(response.status === 'success'){
                        window.location.href = response.redirect;
                    } else {
                        alert(response.message);
                    }
                } catch (e) {
                    alert("Error parsing server response: " + e.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert("Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });
});