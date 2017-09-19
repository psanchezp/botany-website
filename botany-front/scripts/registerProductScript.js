$(document).ready(function () {
    /*
        Cambiar los nombres de las variables de acuerdo a lo hecho en la capa de presentacion
    */
    $("#registerButton").on("click", registerProduct);
});

function registerProduct() {
    var jsonToSend = {
        "productName"    : $("#registerProductName").val(),
        "productCategory": $("#registerProductCategory").val(),
        "productMeasure" : $("#registerProductMeasure").val(),
        "productPrice"   : $("#registerProductPrice").val(),
        "action"         : "REGISTER_PRODUCT"
    };

    $.ajax({
        url: "data/applicationLayer.php",
        type: "POST",
        data: jsonToSend,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (jsonReceived) {
            /*
                El jsonRecieved contiene: jsonRecived.name, jsonRecived.category, jsonRecived.measure y
                jsonRecived.price, todos estos pertenecientes al producto que se registro
            */
        },
        error: function (errorMessage) {
            /*
                 Aviso de error en ingresar datos vacios,
                 no poder entrar a la base de datos a crear la entrada o falta de coneccion a la BD.
                 EX:
                 $("#textoAvisoLogin").text(errorMessage.responseText);
                 $("#textoAvisoLogin").css("color", "#9c1341");
                 $("#avisoLogin").show(300);
             */
        }
    });
}
