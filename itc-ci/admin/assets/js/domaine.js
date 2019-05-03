$(window).load(function(){

    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;
    var idBtnModif = 0;
    var idBtnSup = 0;

    $('#newDomaine').on('click', function(){
        $('#listDomaine').hide('slow') ;
        $('#saveDomaine').show('slow') ;
    }) ;

    $('#retourListeDomaine').on('click', function(){location.href = './domaine.php';}) ;

    $('#validerDomaine').on('click', function(e){
        e.preventDefault();
        $idCache = $('#cacheIdDomaine').val();
        if($idCache === ''){$('#formDomaine').submit();}
        else{
            $('#domaineBtnModalNon').text('Annuler');
            $('#domaineBtnModalOui').text('Modifier');
            $('#domaineModalLongTitle').html('<strong>Modification - Domaine</strong>');
            $('#domaineModalLongBody').text('Voulez-vous modifier l\'entrée ?');
            $('#domaineModalLong').modal('show');
        }
    });

    $(document).on('click', '.editDomaine', function (e) {
        e.preventDefault();

        idBtnModif = $(this).attr("id")
        $.ajax({
            url: 'php/domaine/retournerDomaineParId.php',
            method: 'GET',
            data: {idPourModifDomaine: idBtnModif},
            dataType: 'JSON',
            success: function(reponse){
                if(reponse.message === 'ok'){
                    $('#cacheIdDomaine').val(reponse.data[0].id);
                    $('#inputIntitule').val(reponse.data[0].intitule);

                    $('#newDomaine').click() ;
                }
                else{
                    $('#domaineBtnModalNon').click();

                    shortCutFunction = 'error' ;
                    title = "Erreur" ;
                    msg = reponse.message ;

                    $('#showtoast').click() ;
                }
            },
            error: function(){alert('ERREUR NETWORK');}
        });

    });

    $(document).on('click', '.suppDomaine', function (e) {
        e.preventDefault();

        idBtnSup = $(this).attr("id")
        $('#domaineBtnModalNon').text('Annuler');
        $('#domaineBtnModalOui').text('Supprimer');
        $('#domaineModalLongTitle').html('<strong>Suppression - Domaine</strong>');
        $('#domaineModalLongBody').text('Voulez-vous supprimer l\'entrée ?');
        $('#domaineModalLong').modal('show');
    });

    $('#domaineBtnModalOui').on('click', function(e){
        if($(this).text() === 'Modifier'){$('#formDomaine').submit();}
        else{
            $.ajax({
                url: 'php/domaine/supprimeDomaine.php',
                method: 'GET',
                data:{idDomaineSup: idBtnSup},
                dataType: 'JSON',
                success: function(reponse){
                    if(reponse.message === 'ok'){location.href = './domaine.php';}
                    else{
                        $('#domaineBtnModalNon').click();

                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = reponse.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
    });

    $('#formDomaine').on('submit', function(e){
        e.preventDefault() ;

        $this = $(this) ;
        $intitule = $('#inputIntitule').val() ;
        $idCache = $('#cacheIdDomaine').val();

        if($intitule === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Intitulé vide !!" ;

            $('#showtoast').click() ;
        }
        else{
            if($idCache === ''){
                $.ajax({
                    url: 'php/domaine/insererDomaine.php',
                    method: 'POST',
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.message === 'ok'){
                            location.href = "./domaine.php" ;
                        }
                        else{
                            shortCutFunction = 'error' ;
                            title = "Erreur" ;
                            msg = data.message ;

                            $('#showtoast').click() ;
                        }
                    },
                    error: function(){
                        alert('ERROR NETWORK') ;
                    }
                });
            }
            else{
                $.ajax({
                    url: 'php/domaine/modifierDomaine.php',
                    method: 'POST',
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.message === 'ok'){
                            location.href = "./domaine.php" ;
                        }
                        else{
                            $('#domaineBtnModalNon').click();

                            shortCutFunction = 'error' ;
                            title = "Erreur" ;
                            msg = data.message ;

                            $('#showtoast').click() ;
                        }
                    },
                    error: function(){
                        alert('ERROR NETWORK') ;
                    }
                });
            }
        }
    }) ;

    if($('#openAddDomaine').val() === 'add'){$('#newDomaine').click();}

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