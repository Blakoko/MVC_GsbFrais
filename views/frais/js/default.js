/**
 * Created by albert on 08/04/16.
 */

//SELECTION DE LA DATE

$(function ladate(){
    $( ".datepicker" ).datepicker({
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
    });
});

//ne mettre que des chiffres
$(function number(){

    $('.number-only').keyup(function(e) {
        if(this.value!='-')Bienvenue
            while(isNaN(this.value))
                this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
                    .split('').reverse().join('');
    })
        .on("cut copy paste",function(e){
            e.preventDefault();
        });

});


//Empecher des valeures vides
$(function empty(){
    $('#formhf').submit(function() {
        if ($.trim($("#montant").val()) === "" || $.trim($(".datepicker").val()) === "" || $.trim($("#desc").val()) === "" ) {
            alert('Remplissez Les champs');
            return false;
        }
    });
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

$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('Etes Vous Sur?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});