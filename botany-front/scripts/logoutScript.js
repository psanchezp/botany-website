$(document).ready(function () {
    /*
        Cambiar los nombres de las variables de acuerdo a lo hecho en la capa de presentacion
    */
    $("#logoutButton").on("click", logoutUser);
});

function logoutUser() {
    var jsonToSend = {
        "action": "LOGOUT"
    };

    $.ajax({
        url: "data/applicationLayer.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (jsonReceived) {
            /*
                El jsonReceived contiene el parametro jsonReceived.status con el string SUCCCESS
                indicando que se hizo logout
            */
        },
        error: function (errorMessage) {
            /*
                Aviso si la sesion no se habia creado con anterioridad o ha expirado cuando
                intento hacer logout
                
                 $("#textoAvisoLogin").text(errorMessage.responseText);
                 $("#textoAvisoLogin").css("color", "#9c1341");
                 $("#avisoLogin").show(300);
            */
        }
    });
}
