$(window).load(function(){

    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;

    var idBtnModif = 0;


    $('#newSession').on('click', function(){
        $('#listSession').hide('slow') ;
        $('#saveSession').show('slow') ;
    }) ;

    $('#retourListeSession').on('click', function(){location.href = './session.php';}) ;

    $(document).on('click', '.voirSession', function(e){
        e.preventDefault();
        idBtnModif = $(this).attr("id");

        $.ajax({
            url: 'php/session/getSessionById.php',
            method: 'GET',
            data: {idModifier: idBtnModif},
            dataType: 'JSON',
            success: function(reponse){
                if(reponse.message === 'ok'){
                    $('#sessionBtnModalNon').text('Quitter');
                    $('#sessionBtnModalOui').hide();
                    $('#sessionModalTitle').html('<strong>Détails - Session</strong>');
                    $('#sessionModalBody').text('bldshsdjdshjdsqhdbsdsqjqdsbq');
                    $('#sessionModal').modal('show');
                }
                else{
                    shortCutFunction = 'error' ;
                    title = "Erreur" ;
                    msg = reponse.message ;

                    $('#showtoast').click() ;
                }
            },
            error: function(){alert('ERREUR NETWORK');}
        });
    });

    $(document).on('click', '.suppSession', function(e){
        e.preventDefault();
        idBtnModif = $(this).attr("id");

        $('#sessionBtnModalNon').text('Annuler');
        $('#sessionBtnModalOui').show();
        $('#sessionBtnModalOui').text('Supprimer');
        $('#sessionModalTitle').html('<strong>Suppression - Session</strong>');
        $('#sessionModalBody').text('Voulez-vous supprimer l\'entrée ?');
        $('#sessionModal').modal('show');
    });

    $(document).on('click', '.editSession', function (e){
        e.preventDefault();
        idBtnModif = $(this).attr("id");

        $.ajax({
            url: 'php/session/getSessionById.php',
            method: 'GET',
            data: {idModifier: idBtnModif},
            dataType: 'JSON',
            success: function(reponse){
                if(reponse.message === 'ok'){
                    $('#selectFormationSession').val(reponse.data['idFormation']);
                    $('#selectConsultantSession').val(reponse.data['consultant']);
                    $('#selectTypeSessionSession').val(reponse.data['typeSession']);
                    $('#nbreHeureSessionCache').val(reponse.data['dureeSession']);
                    $('#prixSession').val(reponse.data['prix']);
                    $('#nbreHeureSession').text(reponse.data['dureeSession']);
                    $('#placesPrevueSession').val(reponse.data['nbrePlaces']);
                    $('#idSessionCache').val(reponse.data['id']);
                    $('#idPP').val(reponse.data['idPlaces']);

                    $('#titreSaveSession').text('Modification Session');
                    $('#newSession').click();
                }
                else{
                    shortCutFunction = 'error' ;
                    title = "Erreur" ;
                    msg = reponse.message ;

                    $('#showtoast').click() ;
                }
            },
            error: function(){alert('ERREUR NETWORK');}
        });
    });

    $('#sessionBtnModalOui').on('click', function(){
        if($(this).text() === 'Supprimer'){
            $.ajax({
                url:'php/session/supprimerSession.php',
                method:'GET',
                data:{supSession: idBtnModif},
                dataType:'JSON',
                success: function(reponse){
                    if(reponse.message === 'ok'){location.href = './session.php';}
                    else{
                        $('#sessionBtnModalNon').click();

                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = reponse.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
        else{$('#formSession').submit();}
    });

    $('#validerSession').on('click', function(e){
        e.preventDefault();
        $idCache = $('#idSessionCache').val();

        if($idCache === ''){$('#formSession').submit();}
        else{
            $('#sessionBtnModalNon').text('Annuler');
            $('#sessionBtnModalOui').show();
            $('#sessionBtnModalOui').text('Modifier');
            $('#sessionModalTitle').html('<strong>Modification - Session</strong>');
            $('#sessionModalBody').text('Voulez-vous modifier l\'entrée ?');
            $('#sessionModal').modal('show');
        }
    });

    $('#formSession').on('submit', function(e){
        e.preventDefault();
        $this = $(this);
        $selectFormationSession = $('#selectFormationSession').val();
        $selectConsultantSession = $('#selectConsultantSession').val();
        $selectTypeSessionSession = $('#selectTypeSessionSession').val();
        $prixSession = $('#prixSession').val();
        $idSessionCache = $('#idSessionCache').val();


        if($selectFormationSession === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Sélectionner une formation" ;

            $('#showtoast').click() ;
        }
        else if($selectTypeSessionSession === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Sélectionner un Type de Session" ;

            $('#showtoast').click() ;
        }
        else if($selectConsultantSession === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Sélectionner un Consultant" ;

            $('#showtoast').click() ;
        }
        else if($prixSession === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Donner le montant de la Session de Formation" ;

            $('#showtoast').click() ;
        }
        else{
            if($idSessionCache === ''){
                $.ajax({
                    url: 'php/session/insererSession.php',
                    method: 'POST',
                    data: $this.serialize(),
                    dataType: 'JSON',
                    success: function(reponse){
                        if(reponse.message === 'ok'){location.href = './session.php';}
                        else{
                            shortCutFunction = 'error' ;
                            title = "Erreur" ;
                            msg = reponse.message ;

                            $('#showtoast').click() ;
                        }
                    },
                    error: function(){alert('ERREUR NETWORK');}
                });
            }
            else{
                $.ajax({
                    url: 'php/session/modifierSession.php',
                    method: 'POST',
                    data: $this.serialize(),
                    dataType: 'JSON',
                    success: function(reponse){
                        if(reponse.message === 'ok'){location.href = './session.php';}
                        else{
                            shortCutFunction = 'error' ;
                            title = "Erreur" ;
                            msg = reponse.message ;

                            $('#showtoast').click() ;
                        }
                    },
                    error: function(){alert('ERREUR NETWORK');}
                });
            }
        }
    });

    $('#nbreDeSemaine').on('change', function(){
        var valNbreSemaine = $(this).val();
        var idTypeSession = $('#selectTypeSessionSession').val();

        $.ajax({
            url: 'php/typeSession/calculerNbreHeure.php',
            data: {
                semaine: valNbreSemaine,
                typeSession: idTypeSession
            },
            method: 'GET',
            dataType: 'JSON',
            success: function(reponse){
                $('#nbreHeureSession').text(reponse.nbreHeure);
                $('#nbreHeureSessionCache').val(reponse.nbreHeure);
            },
            error: function(){alert('ERREUR NETWORK');}
        });
    }).change();

    $('#selectTypeSessionSession').on('change', function(){
        var valNbreSemaine = $('#nbreDeSemaine').val();
        var idTypeSession = $(this).val();

        $.ajax({
            url: 'php/typeSession/calculerNbreHeure.php',
            data: {
                semaine: valNbreSemaine,
                typeSession: idTypeSession
            },
            method: 'GET',
            dataType: 'JSON',
            success: function(reponse){
                $('#nbreHeureSession').text(reponse.nbreHeure);
                $('#nbreHeureSessionCache').val(reponse.nbreHeure);
            },
            error: function(){alert('ERREUR NETWORK');}
        });
    });

    if($('#openAddSession').val() === 'add'){
        $('#newSession').click();
    }

    $('#showtoast').click(function () {

        var $showDuration = $('#showDuration');
        var $hideDuration = $('#hideDuration');
        var $timeOut = $('#timeOut');
        var $extendedTimeOut = $('#extendedTimeOut');
        var $showEasing = $('#showEasing');
        var $hideEasing = $('#hideEasing');
        var $showMethod = $('#showMethod');
        var $hideMethod = $('#hideMethod');
        var toastIndex = toastCount++;
        var addClear = $('#addClear').prop('checked');

        toastr.options = {
            closeButton: $('#closeButton').prop('checked'),
            debug: $('#debugInfo').prop('checked'),
            newestOnTop: $('#newestOnTop').prop('checked'),
            progressBar: $('#progressBar').prop('checked'),
            positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
            preventDuplicates: $('#preventDuplicates').prop('checked')
        };

        if ($('#addBehaviorOnToastClick').prop('checked')) {
            toastr.options.onclick = function () {
                alert('You can perform some custom action after a toast goes away');
            };
        }


        if ($showDuration.val().length) {
            toastr.options.showDuration = $showDuration.val();
        }

        if ($hideDuration.val().length) {
            toastr.options.hideDuration = $hideDuration.val();
        }

        if ($timeOut.val().length) {
            toastr.options.timeOut = addClear ? 0 : $timeOut.val();
        }

        if ($extendedTimeOut.val().length) {
            toastr.options.extendedTimeOut = addClear ? 0 : $extendedTimeOut.val();
        }


        if ($showEasing.val().length) {
            toastr.options.showEasing = $showEasing.val();
        }

        if ($hideEasing.val().length) {
            toastr.options.hideEasing = $hideEasing.val();
        }

        if ($showMethod.val().length) {
            toastr.options.showMethod = $showMethod.val();
        }

        if ($hideMethod.val().length) {
            toastr.options.hideMethod = $hideMethod.val();
        }

        if (addClear) {
            msg = getMessageWithClearButton(msg);
            toastr.options.tapToDismiss = false;
        }

        if (!msg) {
            msg = getMessage();
        }

        var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;

        if(typeof $toast === 'undefined'){
            return;
        }

        if ($toast.find('#okBtn').length) {
            $toast.delegate('#okBtn', 'click', function () {
                alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                $toast.remove();
            });
        }

        if ($toast.find('#surpriseBtn').length) {
            $toast.delegate('#surpriseBtn', 'click', function () {
                alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
            });
        }

        if ($toast.find('.clear').length) {
            $toast.delegate('.clear', 'click', function () {
                toastr.clear($toast, { force: true });
            });
        }
    });

    $('.footable').footable();
});