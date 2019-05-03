$(window).load(function(){
    var toastCount = 0;   var $toastlast;
    var shortCutFunction = '' ;   var msg = '' ;   var title = '' ;

    //alert($('#idDeLaSession').val()) ;
    $.ajax({
        url: 'php/compteUser/afficherProfil.php',
        method: 'GET' ,
        data: {idSession: $('#idDeLaSession').val()},
        dataType: 'JSON',
        success: function(response){
            if(response.message === 'ok'){
                var donnee = response.data ;

                $('#profilFirstName').val(donnee['nom']) ;  $('#profilEmail').val(donnee['email']) ;
                $('#profilLastName').val(donnee['prenom']) ;   $('#profilPhone').val(donnee['tel']) ;
                $('#profilPhoneSpan').html(donnee['tel']) ;   $('#profilUsername').val(donnee['user']) ;
                $('#nomEtPrenoms').html('<strong>'+donnee['nom']+'</strong>  '+donnee['prenom']) ;
                $('#profilFonction').html(donnee['fonction']);
            }
            else{window.history.back();}
        },
        error: function(){window.history.back();}
    });


    $('#profilBtnModalOui').on('click', function(e){
        e.preventDefault() ;
        $this = $('#formProfilChange') ;

        $.ajax({
            url: 'php/compteUser/modifierProfil.php',
            method: 'POST',
            data: $this.serialize(),
            dataType: 'JSON',
            success: function(response){
                if(response.message === 'okNew'){location.href = './';}
                else if(response.message === 'ok'){location.href = './pageProfil.php';}
                else{shortCutFunction = 'error' ;
                    title = "Erreur" ;
                    msg = 'Erreur dans la modification.' ;

                    $('#showtoast').click() ;}
            },
            error: function(){alert('ERREUR NETWORK');}
        });
    });


    $('#profilEmail').on('change', function(){$('#modifierProfil').prop("disabled", false);});


    $('#profilFirstName').on('change', function(){$('#modifierProfil').prop("disabled", false);});


    $('#profilLastName').on('change', function(){$('#modifierProfil').prop("disabled", false);});


    $('#profilPhone').on('change', function(){$('#modifierProfil').prop("disabled", false);});


    $('#profilNewPasswordRepeat').on('change', function(){$('#modifierProfil').prop("disabled", false);});


    $('#profilNewPassword').on('change', function(){$('#modifierProfil').prop("disabled", false);});


    $('#modifierProfil').on('click', function(e){
        e.preventDefault() ;

        $nom = $('#profilFirstName').val();   $prenom = $('#profilLastName').val();
        $tel = $('#profilPhone').val();   $email = $('#profilEmail').val();
        $newPass = $('#profilNewPassword').val();   $newPassRepeat = $('#profilNewPasswordRepeat').val();

        if($newPass !== '' && $newPassRepeat === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = 'Vérifier le nouveau mot de passe.' ;

            $('#showtoast').click() ;
        }
        else if($newPass === '' && $newPassRepeat !== ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = 'Entrer un nouveau mot de passe.' ;

            $('#showtoast').click() ;
        }
        else if($newPass === '' && $newPassRepeat === ''){
            if($nom === ''){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Entrer un nom.' ;

                $('#showtoast').click() ;
            }
            else if($prenom === ''){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Entrer un prenom.' ;

                $('#showtoast').click() ;
            }
            else if($email === ''){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Entrer une adresse email.' ;

                $('#showtoast').click() ;
            }
            else if($tel === ''){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Entrer un numéro de téléphone.' ;

                $('#showtoast').click() ;
            }
            else{
                $('#profilBtnModalNon').text('Annuler');
                $('#profilBtnModalOui').text('Modifier');
                $('#profilModalBody').text('Etes-vous sûr de proceder à la modification ?');
                $('#profilModalTitle').html('<strong>Modification - Profil</strong>');
                $('#profilModal').modal('show');
            }
        }
        else if($newPass !== '' && $newPassRepeat !== ''){
            if($newPass !== $newPassRepeat){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Vérification de mot de passe incorrecte.' ;

                $('#showtoast').click() ;
            }
            else if($nom === ''){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Entrer un nom.' ;

                $('#showtoast').click() ;
            }
            else if($prenom === ''){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Entrer un prenom.' ;

                $('#showtoast').click() ;
            }
            else if($email === ''){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Entrer une adresse email.' ;

                $('#showtoast').click() ;
            }
            else if($tel === ''){
                shortCutFunction = 'error' ;
                title = "Erreur" ;
                msg = 'Entrer un numéro de téléphone.' ;

                $('#showtoast').click() ;
            }
            else{
                $('#profilBtnModalNon').text('Annuler');
                $('#profilBtnModalOui').text('Modifier');
                $('#profilModalBody').text('Etes-vous sûr de proceder à la modification ?');
                $('#profilModalTitle').html('<strong>Modification - Profil</strong>');
                $('#profilModal').modal('show');
                /*$.ajax({
                    url: '',
                    method: 'POST',
                    data: $this.serialize(),
                    dataType: 'JSON',
                    success: function(response){},
                    error: function(){}
                });*/
            }
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
}) ;
