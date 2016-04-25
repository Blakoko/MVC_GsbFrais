/**
 * Created by albert on 08/04/16.
 */
$( "#datepicker" ).datepicker({
    yearRange: '-1:+0',
    minDate:'-1Y',
    maxDate:'+0',
    firstDay: 1,
    altField: "#datepicker",
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

$(function(){

    $('.number-only').keyup(function(e) {
            if(this.value!='-')
                while(isNaN(this.value))
                    this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
                        .split('').reverse().join('');
        })
        .on("cut copy paste",function(e){
            e.preventDefault();
        });

});



