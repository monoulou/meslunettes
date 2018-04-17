/**
 * Created by PC on 14/12/2017.
 */
$(document).ready(function() {
    /***************************/
    /*Mask pour input telephone*/
    /***************************/
    $(".phone").mask('00.00.00.00.00');

    /***************************/
    /*Mask pour input prix*/
    /***************************/
    $('.money').mask("#.##0,00 €", {reverse: true});

    /***************************/
    /***************************/
    /***************************/
    $('#ma_mainbundle_annonce_imagePrincipale').fileinput({
        language: "fr",
        maxFileSize: 500,
        uploadUrl: false,
        showUpload: false,
        dropZoneTitle: "Glissez et déposez le fichier ici&hellip;",
        msgPlaceholder: 'Sélectionner un {files}...',
        minImageWidth: 600,
        minImageHeight: 300,
        fileActionSettings : {
            // Disable
            showUpload : false,
        },

    });

    $('#ma_mainbundle_annonce_imageBis').fileinput({
        language: "fr",
        maxFileSize: 500,
        uploadUrl: false,
        showUpload:  false,
        dropZoneTitle: "Glissez et déposez le fichier ici&hellip;",
        msgPlaceholder: 'Sélectionner un {files}...',
        minImageWidth: 600,
        minImageHeight: 300,
        fileActionSettings : {
            // Disable
            showUpload : false,
        },
    });

    $('#ma_mainbundle_annonce_imageTer').fileinput({
        language: "fr",
        maxFileSize: 500,
        uploadUrl: false,
        showUpload:  false,
        dropZoneTitle: "Glissez et déposez le fichier ici&hellip;",
        msgPlaceholder: 'Sélectionner un {files}...',
        minImageWidth: 600,
        minImageHeight: 300,
        fileActionSettings : {
            // Disable
            showUpload : false,
        },
    });

    /**********************************************/
    /*Compteur nbre caracteres description annonce*/
    /**********************************************/
    $('#ma_mainbundle_annonce_description').keyup(function() {

        var nombreCaractere = $(this).val().length;

        var nombreMots = jQuery.trim($(this).val()).split(' ').length;
        if($(this).val() === '') {
            nombreMots = 0;
        }

        var msg = ' ' + nombreMots + ' mot(s) | ' + nombreCaractere + ' Caractere(s) / 2000';
        $('#compteur').text(msg);
        if (nombreCaractere > 2000) { $('#compteur').addClass("mauvais"); } else { $('#compteur').removeClass("mauvais"); }

    })

    /**********************************************/
    /* ****************js dataTable************** */
    /**********************************************/
    $('#dashboard').DataTable({
        destroy: true,

        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnée disponible dans le tableau",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        },
        /*"scrollX": true,*/
    });
});





