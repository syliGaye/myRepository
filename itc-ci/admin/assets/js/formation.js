$(window).load(function(){
    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;

    var addFormation = $('#openAddFormation').val();
    var idBtnModifSup = 0;

    $(document).on('click', '.suppFormation', function(e){
        e.preventDefault();
        idBtnModifSup = $(this).attr('id');
        $('#formationBtnModalNon').text('Annuler');
        $('#formationBtnModalOui').text('Supprimer');
        $('#formationModalBody').text('Voulez-vous supprimer la formation ?');
        $('#formationModalTitle').html('<strong>Suppression - Formation</strong>');
        $('#formationModal').modal('show');
    });

    $(document).on('click', '.editFormation', function(e){
        e.preventDefault();
        idBtnModifSup = $(this).attr('id');

        $.ajax({
            url: 'php/formation/getFormationById.php',
            method: 'GET',
            data: {modifFormation: idBtnModifSup},
            dataType: 'json',
            success: function(data){
                if(data.message === 'ok'){
                    $('#cacheIdFormation').val(data.data[0]['id']);
                    $('#inputTitre').val(data.data[0]['titre']);
                    $('#inputCertif').val(data.data[0]['certifDeFormation']);
                    $('#selectLibTechno').val(data.data[0]['idTechnologie']);
                    $('#newFormation').click();
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
    });

    $('#formationBtnModalOui').on('click', function(e){
        e.preventDefault();

        if($(this).text() === 'Supprimer'){
            $.ajax({
                url: 'php/formation/supprimeFormation.php',
                method: 'GET',
                data: {supFormation: idBtnModifSup},
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){location.href = './formation.php';}
                    else{
                        $('#formationBtnModalNon').click();
                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
        else{$('#formFormation').submit();}
    });


    $('#newFormation').on('click', function(){
        $('#listeFormation').hide('slow') ;
        $('#saveFormation').show('slow') ;
    }) ;

    $('#retourListeFormation').on('click', function(){location.href = './formation.php';}) ;

    $('#validerFormation').on('click', function(e){
        e.preventDefault();
        $cacheId = $('#cacheIdFormation').val();

        if($cacheId === ''){$('#formFormation').submit();}
        else{
            $('#formationBtnModalNon').text('Annuler');
            $('#formationBtnModalOui').text('Modifier');
            $('#formationModalBody').text('Voulez-vous modifier la formation ?');
            $('#formationModalTitle').html('<strong>Modification - Formation</strong>');
            $('#formationModal').modal('show');
        }
    });

    $('#formFormation').on('submit', function(e){
        e.preventDefault() ;

        $this = $(this) ;
        $titre = $('#inputTitre').val() ;
        $certif = $('#inputCertif').val() ;
        $selectDom = $('#selectLibTechno').val() ;
        $idCache = $('#cacheIdFormation').val();

        if($titre === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Titre vide !!" ;

            $('#showtoast').click() ;
            $('#inputTitre').focus();
        }
        else if($certif === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Selectionner la certification !!" ;

            $('#showtoast').click() ;
        }
        else if($selectDom === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Selectionner un domaine de formation !!" ;

            $('#showtoast').click() ;
        }
        else{
            if($idCache === ''){
                $.ajax({
                    url: 'php/formation/insererFormation.php',
                    method: 'post',
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.message === 'ok'){location.href = "./formation.php" ;}
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
                    url: 'php/formation/modifierFormation.php',
                    method: 'post',
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.message === 'ok'){location.href = "./formation.php" ;}
                        else{
                            $('#formationBtnModalNon').click();

                            shortCutFunction = 'error' ;
                            title = "Erreur" ;
                            msg = data.message;

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

    if(addFormation === 'add'){
        $('#newFormation').click();
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