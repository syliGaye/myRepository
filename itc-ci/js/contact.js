$(window).load(function () {
    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;

    $('#btSendMail').on('click', function (e) {
        e.preventDefault();

        $nom = $('#nameContact').val();
        $email = $('#emailContact').val();
        $msg = $('#msgContact').val();

        if ($nom === ''){
            shortCutFunction = 'error' ;
            title = "ERREUR NOM" ;
            msg = "Entrez un nom complet !" ;

            $('#showtoast').click() ;
            $('#nameContact').focus();
        }
        else if ($email === ''){
            shortCutFunction = 'error' ;
            title = "ERREUR EMAIL" ;
            msg = "Entrez une adresse mail !" ;

            $('#showtoast').click() ;
            $('#emailContact').focus();
        }
        else if ($msg === ''){
            shortCutFunction = 'error' ;
            title = "ERREUR MESSAGE" ;
            msg = "Entrez un message !" ;

            $('#showtoast').click() ;
            $('#msgContact').focus();
        }
        else {
            $.ajax({
                url: 'admin/php/suggestions.php',
                data: {
                    nom: $nom,
                    email: $email,
                    msg: $msg
                },
                method: 'GET',
                beforeSend: function (){
                    $('#btCloseModal').hide();
                    $('#contactModalLoader').modal({ backdrop: 'static', keyboard: false});
                    $('#contactModalLoader').modal('show', 'slow');
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.message === "ok"){
                        $('#nameContact').val("");
                        $('#emailContact').val("");
                        $('#msgContact').val("");
                        $('#btCloseModal').click();

                        shortCutFunction = 'success' ;
                        title = "MESSAGE" ;
                        msg = "Le message est envoyé avec succès !" ;

                        $('#showtoast').click() ;
                    }
                    else{
                        $('#btCloseModal').click();

                        shortCutFunction = 'error' ;
                        title = "ERREUR" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function () {
                    $('#btCloseModal').click();
                    alert("ERREUR NETWORK !");
                }
            });
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
});