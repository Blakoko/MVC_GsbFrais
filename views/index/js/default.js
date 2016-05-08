


$("button#submit").click(function () {


if ($("#login").val() =="" || $("#password").val() =="")
    $("div#ack").addClass("alert").html("Nom d'utilisateur et mot de passe obligatoire");

else
    $.post($("#myform").attr("action"),
        $("#myform :input").serializeArray(),
    function (data) {
        $("div#ack").addClass("alert").html(data)
        if(data=='Succes'){
            $("div#ack").removeClass("alert").addClass("done")
            window.location ='dashboard';
        }

    });

$("#myform").submit( function(){

    return false;

});

});