$(window).load(function(){
    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;

    var idBtnModifSup = 0;


    $('#newTechnologie').on('click', function(){
        $('#listTechnologie').slideToggle('slow') ;
        $('#saveTechnologie').show('slow') ;
    }) ;

    $('#retourListeTechnologie').on('click', function(){location.href = "./technologie.php" ;}) ;

    $(document).on('click', '.editTechnologie', function(e){
        e.preventDefault();
        idBtnModifSup = $(this).attr('id');

        $.ajax({
            url: 'php/technologie/getTechnologyById.php',
            method: 'GET',
            data: {idTechnologieModif: idBtnModifSup},
            dataType: 'JSON',
            success: function(response){
                if(response.message === 'ok'){
                    $('#cacheIdTechnologie').val(response.data[0].id);
                    $('#inputLibTechnologie').val(response.data[0].libelle);
                    $('#selectIntituleDomaine').val(response.data[0].idDomaine);

                    $('#newTechnologie').click();
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
    });

    $('#validerTechnologie').on('click', function(e){
        e.preventDefault();
        $idCache = $('#cacheIdTechnologie').val();

        if($idCache === ''){$('#formTechnologie').submit();}
        else{
            $('#technologieModalTitle').html('<strong>Modification - Technologie</strong>');
            $('#technologieModalBody').text('Voulez-vous modifier la Technologie ?');
            $('#technologieBtnModalNon').text('Annuler');
            $('#technologieBtnModalOui').text('Modifier');
            $('#technologieModal').modal('show');
        }
    });

    $(document).on('click', '#technologieBtnModalOui', function(e){
        e.preventDefault();

        var $textVerif = $(this).text();
        if($textVerif === 'Supprimer'){
            $.ajax({
                url: 'php/technologie/supprimeTechnologie.php',
                method: 'GET',
                data: {supTechnologie: idBtnModifSup},
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){location.href = './technologie.php'}
                    else{
                        $('#technologieBtnModalNon').click();

                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
        else{$('#formTechnologie').submit();}
    });

    $(document).on('click', '.suppTechnologie', function(e){
        e.preventDefault();
        idBtnModifSup = $(this).attr('id');

        $('#technologieModalTitle').html('<strong>Suppression - Technologie</strong>');
        $('#technologieModalBody').text('Voulez-vous supprimer la Technologie ?');
        $('#technologieBtnModalNon').text('Annuler');
        $('#technologieBtnModalOui').text('Supprimer');
        $('#technologieModal').modal('show');
    });

    $('#formTechnologie').on('submit', function(e){
        e.preventDefault() ;

        $this = $('#formTechnologie') ;
        $libelle = $('#inputLibTechnologie').val() ;
        $selectTech = $('#selectIntituleDomaine').val() ;
        $caheId = $('#cacheIdTechnologie').val();

        if($libelle === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Libellé vide !!" ;

            $('#showtoast').click() ;
            $('#inputLibTechnologie').focus();
        }
        else if($selectTech === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Selectionner un domaine de technologie !!" ;

            $('#showtoast').click() ;
        }
        else{
            if($caheId === ''){
                $.ajax({
                    url: 'php/technologie/insererTechnologie.php',
                    method: 'POST',
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.message === 'ok'){
                            location.href = "./technologie.php" ;
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
                    url: 'php/technologie/modifierTechnologie.php',
                    method: 'POST',
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.message === 'ok'){
                            location.href = "./technologie.php" ;
                        }
                        else{
                            $('#technologieBtnModalNon').click();

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

    if($('#openAddTechnologie').val() === 'add'){$('#newTechnologie').click();}

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