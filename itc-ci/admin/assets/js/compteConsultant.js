$(window).load(function(){
    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;


    $('#newUtilisateur').on('click', function(){
        $('#listeUtilisateur').hide('slow') ;
        $('#saveUtilisateur').show('slow') ;
    });


    $('#retourListeUtilisateur').on('click', function(){
        //$('#formUtilisateur').a
        $('#saveUtilisateur').hide('slow');
        $('#listeUtilisateur').show('slow');
    });


    $('#jeSuisConsultantOui').on('click', function(){
        if($(this).prop('checked', true)){
            $('#userSelectConsult').val('oui');
            $('#autreUsers').hide('slow');
            $('#iAmConsultant').show('slow');
        }
        else{
            $('#userSelectConsult').val('non');
            $('#iAmConsultant').hide('slow');
            $('#autreUsers').show('slow');
        }
    });


    $('#jeSuisConsultantNon').on('click', function(){
        if($(this).prop('checked', true)){
            $('#userSelectConsult').val('non');
            $('#iAmConsultant').hide('slow');
            $('#autreUsers').show('slow');
        }
        else{
            $('#userSelectConsult').val('oui');
            $('#autreUsers').hide('slow');
            $('#iAmConsultant').show('slow');
        }
    });


    $('#validerUtilisateur').on('click', function(e){
        e.preventDefault();

        $this = $('#formUtilisateur') ;
        $username = $('#utilisateurUsername').val();
        $pass = $('#utilisateurPass').val();
        $verifPass = $('#utilisateurPassConfirm').val();
        $selectUser = $('#utilisateurSelectConsultant').val();
        $nom = $('#utilisateurNom').val();   $prenom = $('#utilisateurPrenom').val();
        $tel = $('#utilisateurPhone').val();   $email = $('#utilisateurEmail').val();

        if($username === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = 'Entrer un Nom Utilisateur.' ;

            $('#showtoast').click();   $('#utilisateurUsername').focus();
        }
        else if($pass === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = 'Entrer un Mot de Passe.' ;

            $('#showtoast').click();   $('#utilisateurPass').focus();
        }
        else if($verifPass !== $pass){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = 'Mot de Passe incorrect.' ;

            $('#showtoast').click();   $('#utilisateurPassConfirm').focus();
        }
        else if(!$('#jeSuisConsultantOui').is(':checked') && !$('#jeSuisConsultantNon').is(':checked')){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = 'Donner les information de l\'utilisateur.' ;

            $('#showtoast').click() ;
        }
        else if($('#jeSuisConsultantOui').is(':checked') && $selectUser === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = 'Selectionner un consultant.' ;

            $('#showtoast').click() ;
        }
        else if($('#jeSuisConsultantNon').is(':checked') && ($nom === '' || $prenom === '' || $tel === '' || $email === '')){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = 'Un champ est resté vide' ;

            $('#showtoast').click() ;
        }
        else{
            $.ajax({
                url: 'php/compteUser/creerUtilisateur.php',
                method: 'POST',
                data: $this.serialize(),
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){location.href = './compteConsultant.php';}
                    else{
                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
            //alert('bien') ;
        }
    });


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