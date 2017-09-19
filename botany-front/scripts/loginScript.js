$(document).ready(function () {
    /*
        Cambiar los nombres de las variables de acuerdo a lo hecho en la capa de presentacion
    */
    $("#botonLogin").on("click", loginUser);
});

function loginUser() {
    var jsonToSend = {
        "action"      : "LOGIN",
        "username"    : $("#userLogin").val(),
        "userPassword": $("#passwordLogin").val(),
        "rememberMe"  : $("#cookieLogin").is(":checked")
    };

    $.ajax({
        url: "data/applicationLayer.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (jsonReceived) {

            /*
                En jsonReceived llega un parametro type con el cual se sabe si se ingreso correctamente como
                admin, cliente o proveedor. El jsonRecieved contiene: jsonRecived.username jsonRecived.passwrd jsonRecived.type
                para admin y para cliente/proveedor contiene esos mismos, ademas de: jsonRecived.name, jsonRecived.description,
                jsonReceived.phone, jsonReceived.address y jsonReceived.email.
                EX:
                if (jsonReceived.type == "provider") {
                    // ir a otra pagina
                }
                ...
                etc.
            */
        },
        error: function (errorMessage) {
            /*
                Aviso de error en ingresar datos vacios, incorrectos, no creados o falta de coneccion a la BD.
                EX:
                $("#textoAvisoLogin").text(errorMessage.responseText);
                $("#textoAvisoLogin").css("color", "#9c1341");
                $("#avisoLogin").show(300);
            */
        }
    });
}
