$("button#submit").click(function () {


if ($("#login").val() =="" || $("#password").val() =="")
    $("div#ack").html("Nom d'utilisateur et mot de passe obligatoire");

else
    $.post($("#myform").attr("action"),
        $("#myform :input").serializeArray(),
    function (data) {
        $("div#ack").html(data);
        if(data=='Succes'){
            window.location ='dashboard';
        }

    });

$("#myform").submit( function(){

    return false;

});

});