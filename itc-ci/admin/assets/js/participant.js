$(window).load(function(){
    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;

    var addParticipant = $('#openAddParticipant').val();
    var idBtnModifSup = 0;

    $(document).on('click', '.suppParticipant', function(e){
        e.preventDefault();
        idBtnModifSup = $(this).attr('id');
        $('#ParticipantBtnModalNon').text('Annuler');
        $('#ParticipantBtnModalOui').text('Supprimer');
        $('#ParticipantModalBody').text('Voulez-vous supprimer la Participant ?');
        $('#ParticipantModalTitle').html('<strong>Suppression - Participant</strong>');
        $('#ParticipantModal').modal('show');
    });

    $('#ParticipantBtnModalOui').on('click', function(e){
        e.preventDefault();

        if($(this).text() === 'Supprimer'){
            $.ajax({
                url: 'php/Participant/supprimeParticipant.php',
                method: 'GET',
                data: {supParticipant: idBtnModifSup},
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){location.href = './Participants.php';}
                    else{
                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
        else{}
    });


    $('#newParticipant').on('click', function(){
        $('#listeParticipant').hide('slow') ;
        $('#saveParticipant').show('slow') ;
    }) ;

    $('#radioParticipantNonSous').on('click', function(){
        $('#selectPartSouscrip').val('') ;
        $('#formParticipantSoucrit').hide('slow') ;
        $('#formParticipantNonSoucrit').show('slow') ;
    });

    $('#radioParticipantSous').on('click', function(){
        $('#nomPartNonSous').val('') ;
        $('#formParticipantNonSoucrit').hide('slow') ;
        $('#formParticipantSoucrit').show('slow') ;
    }) ;


    $('#retourListeParticipant').on('click', function(){
        $('#saveParticipant').hide('slow') ;
        $('#listeParticipant').show('slow') ;
    }) ;


    $('#selectPartFormation').on('change', function(){
        $formation = $(this).val() ;
        $session = $('#selectPartSession').val() ;

        if($formation !== '' && $session !== ''){
            $.ajax({
                url: 'php/souscripteur/afficherSouscripteurs.php',
                method: 'GET',
                data: {laSession: $session, laFormation: $formation},
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'bien'){

                        for(var i = 0 , j =  response.data.length ; i < j ; i++){
                            var valeur = response.data[i] ;
                            for(var k = 0, l = valeur.length ; k < l ; k++){
                                var option = '<option value="'+valeur[k]['id']+'">'+valeur[k]['nom']+' '+valeur[k]['prenoms']+', <"'+valeur[k]['email']+'"></option>' ;
                                $('#selectPartSouscrip').append(option);
                            }
                        }

                        $('#sessionPartSouscriptCache').val(response.data[0][0]['idSession']) ;
                    }
                    else{
                        var option = '<option value="">-----</option>' ;
                        $('#selectPartSouscrip').html(option);
                        $('#sessionPartSouscriptCache').val('') ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            }) ;
        }
        else{
            var option = '<option value="">-----</option>' ;
            $('#selectPartSouscrip').html(option);
            $('#sessionPartSouscriptCache').val('') ;
        }
    }) ;


    $('#selectPartSession').on('change', function(){
        $session = $(this).val() ;
        $formation = $('#selectPartFormation').val() ;

        if($formation !== '' && $session !== ''){
            $.ajax({
                url: 'php/souscripteur/afficherSouscripteurs.php',
                method: 'GET',
                data: {laSession: $session, laFormation: $formation},
                dataType: 'JSON',
                success: function(response){
                    //alert(response.message) ;
                    if(response.message === 'bien'){
                        /*$.each(response.data, function(key, value){
                         /*var option = '<option value="'+response.data[i]['id']+'">'+response.data[i]['nom']+' '+response.data[i]['prenoms']+', <"'+response.data[i]['email']+'"></option>' ;
                         $('#selectPartSouscrip').append(option);
                         alert(value['prenoms']);
                         });*/
                        for(var i = 0 , j =  response.data.length ; i < j ; i++){
                            var valeur = response.data[i] ;
                            for(var k = 0, l = valeur.length ; k < l ; k++){
                                var option = '<option value="'+valeur[k]['id']+'">'+valeur[k]['nom']+' '+valeur[k]['prenoms']+', <"'+valeur[k]['email']+'"></option>' ;
                                $('#selectPartSouscrip').append(option);
                            }
                        }

                        $('#sessionPartSouscriptCache').val(response.data[0][0]['idSession']) ;
                    }
                    else{
                        var option = '<option value="">-----</option>' ;
                        $('#selectPartSouscrip').html(option);
                        $('#sessionPartSouscriptCache').val('') ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            }) ;
        }
        else{
            var option = '<option value="">-----</option>' ;
            $('#selectPartSouscrip').html(option);
            $('#sessionPartSouscriptCache').val('') ;
        }
    }) ;

    $('#validerPartSous').on('click', function(e){
        e.preventDefault();

        $this = $('#formParticipantSoucrit') ;
        $souscripteur = $('#selectPartSouscrip').val() ;

        if($souscripteur === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Choisir un souscripteur" ;

            $('#showtoast').click() ;
        }
        else{
            $.ajax({
                url: 'php/participant/insererParticipant.php',
                method: 'POST',
                data: $this.serialize(),
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){
                        shortCutFunction = 'success' ;
                        title = "Enregistrement" ;
                        msg = "Enregistrement d'un participant réussie" ;

                        $('#showtoast').click() ;
                        location.href = './participants.php' ;
                    }
                    else{
                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
    });


    $('#validerPartNonSous').on('click', function(e){
        e.preventDefault() ;

        $this = $('#formParticipantNonSoucrit') ;
        $nom = $('#nomPartNonSous').val() ;
        $prenom = $('#prenomsPartNonSous').val() ;
        $email = $('#emailPartNonSous').val() ;
        $tel = $('#telPartNonSous').val() ;
        $selFormation = $('#selectPartFormationNonSous').val() ;
        $selSess = $('#selectPartSessionNonSous').val() ;

        if($nom === '' || $prenom === '' || $email === '' || $tel === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Un champ est resté vide." ;

            $('#showtoast').click() ;
        }
        else if($selFormation === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Choisir une formation" ;

            $('#showtoast').click() ;
        }
        else if($selSess === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Choisir une session" ;

            $('#showtoast').click() ;
        }
        else{
            $.ajax({
                url: 'php/participant/insererParticipant.php',
                method: 'POST',
                data: $this.serialize(),
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){
                        shortCutFunction = 'success' ;
                        title = "Enregistrement" ;
                        msg = "Enregistrement effectué avec succès." ;

                        $('#showtoast').click() ;
                        location.href = './participants.php' ;
                    }
                    else{
                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
    });


    if(addParticipant === 'add'){
        $('#newParticipant').click();
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