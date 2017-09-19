$(document).ready(function () {
    /*
        Cambiar los nombres de las variables de acuerdo a lo hecho en la capa de presentacion
    */
    $("#registerButton").on("click", registerClient);
});

function registerClient() {
    var jsonToSend = {
        "username"       : $("#registerUsername").val(),
        "userPassword"   : $("#registerPassword").val(),
        "name"           : $("#registerName").val(),
        "userDescription": $("#registerDescription").val(),
        "userPhone"      : $("#registerPhone").val(),
        "userAddress"    : $("#registerAddress").val(),
        "userEmail"      : $("#registerEmail").val(),
        "action"         : "REGISTER_CLIENT"
    };

    $.ajax({
        url: "data/applicationLayer.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (jsonReceived) {
            /*
                En jsonReceived llega un parametro 'type' con el cual se sabe si se ingreso correctamente como
                admin, cliente o proveedor. El jsonReceived contiene: jsonRecived.username, jsonRecived.passwrd, jsonRecived.type (que es 'client'),
                jsonRecived.name, jsonRecived.description, jsonRecived.phone, jsonRecived.address, jsonRecived.email 
            */
        },
        error: function (errorMessage) {
            /*
                 Aviso de error en ingresar datos vacios, si se creo a un cliente con el mismo username antes,
                 no poder entrar a la base de datos a crear la entrada o falta de conexion a la BD.
                 EX:
                 $("#textoAvisoLogin").text(errorMessage.responseText);
                 $("#textoAvisoLogin").css("color", "#9c1341");
                 $("#avisoLogin").show(300);
             */
        }
    });
}
