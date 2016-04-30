/**
 * Created by albert on 08/04/16.
 */

var $Confirmation = 'Êtes-vous sûr?';
var $Datedata = {
    yearRange: '-1:+0',
    minDate:'-1Y',
    maxDate:'+0',
    firstDay: 1,
    altField: ".datepicker",
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',
    dateFormat: 'yy-mm-dd'
};

/**
 * Demarrer au Chargement de la page
 *
 * */
$(document).ready(function(){


//------//
    $("button#btn2").click(function () {

        //EMPECHER VALEUR VIDE
        if ($(".montant").val() =="" || $(".datepicker").val() =="" || $(".desc").val()=="")
            $("div#ack").html("Remplissez les champs");

            //XHR poster le formulaire
        else
            $.post($("#myform").attr("action"),
                $("#myform :input").serializeArray(),
                function (data) {
                    $("div#ack").html(data);
                    if(data==''){
                        alert('Ajouté'),
                        window.location ='saisir';
                    }

                });

        $("#myform").submit( function(){
            return false;

        });

    });
    //----//

//--//
    $("button#btn1").click(function () {

        //EMPECHER VALEUR VIDE
        if ($(".type").val() =="" || $(".quantite").val() =="")
            $("div#atk").html("Remplissez les champs");

        //XHR poster le formulaire
        else
            $.post($("#formff").attr("action"),
                $("#formff :input").serializeArray(),

                function (data) {
                    $("div#atk").html(data);
                    if(data=='ajouté'){
                        alert('Ajouté'),
                        window.location ='saisir';
                    }

                });

        $("#formff").submit( function(){
            return false;

        });

    });
//--//

    /*$('#formhf').submit(function() {
        if ($.trim($(".montant").val()) === "" || $.trim($(".datepicker").val()) === "" || $.trim($(".desc").val()) === "" ) {
            alert('Remplissez Les champs');
            return false;
        }
    });*/

    //NE RENTRER QUE DES CHIFFRES
    $('.number-only').keyup(function(e) {
            if(this.value!='-')
                while(isNaN(this.value))
                    this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
                        .split('').reverse().join('');
        })
        .on("cut copy paste",function(e){
            e.preventDefault();
        });

    //POPUP CONFIRMATION LIEN
    $("a.delete").click(function(e){
        if(!confirm($Confirmation)){
            e.preventDefault();
            return false;
        }
        return true;
    });

    //POPUP CONFIRMATION BOUTON
    /*
    $("button#btn2").click(function (e) {
        if(!confirm($Confirmation)){
            e.preventDefault();
            return false;
        }

    });*/
});
/***
 * Fin Chargement page
 */


$(function ladate(){
    $( ".datepicker" ).datepicker($Datedata);
});

//repetition
$(function repet(){
    $('.repeat').click(function(){

        var $clone = $('.repeat2:last').clone();
        $clone.find('input').val('').end();
        //$clone.find('.datepicker').removeAttr('id').removeClass('hasDatepicker');
        $clone.appendTo('#repetition:last');
    });
});


///
$(function repet2(){
    $('.repeatx').click(function(){

        var $clone = $('.repeat1:last').clone();
        $clone.find('input').val('').end();
        //$clone.find('.datepicker').removeAttr('id').removeClass('hasDatepicker');
        $clone.appendTo('#repetition1:last');
    });
});


///
function getMois(val) {
    $.ajax({
        type: "POST",
        url: "test3",
        data:'id_user='+val,
        success: function(data){
            $("#list_mois").html(data);
        }
    });
}

