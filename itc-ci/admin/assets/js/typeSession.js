$(window).load(function(){
    var nbre = 0 ;

    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;
    var idBtnModifSup = 0;

    $(document).on('click', '.editTypeSession', function(e){
        idBtnModifSup = $(this).attr('id');

        $.ajax({
            url: 'php/typeSession/getTypeSessionById.php',
            method: 'GET',
            data: {editerTypeSession: idBtnModifSup},
            dataType: 'JSON',
            success: function(response){
                if(response.message === 'ok'){
                    var joursHeurs = response.data[0]['joursHeures'];   var decouperJrsHrs = joursHeurs.split(',');
                    for(var i = 0; i < decouperJrsHrs.length; i++){
                        var decoupePlus = decouperJrsHrs[i].split('_');

                        for(var j = 0; j < decoupePlus.length; j++){
                            if(decoupePlus[0] === 'LUN'){
                                if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$('#lunCheckbox1').prop({checked: true});}
                                else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$('#lunCheckbox2').prop({checked: true});}
                                else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$('#lunCheckbox3').prop({checked: true});}
                                else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$('#lunCheckbox4').prop({checked: true});}
                            }
                            else if(decoupePlus[0] === 'MAR'){
                                if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$('#marCheckbox1').prop({checked: true});}
                                else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$('#marCheckbox2').prop({checked: true});}
                                else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$('#marCheckbox3').prop({checked: true});}
                                else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$('#marCheckbox4').prop({checked: true});}
                            }
                            else if(decoupePlus[0] === 'MER'){
                                if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$('#merCheckbox1').prop({checked: true});}
                                else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$('#merCheckbox2').prop({checked: true});}
                                else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$('#merCheckbox3').prop({checked: true});}
                                else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$('#merCheckbox4').prop({checked: true});}
                            }
                            else if(decoupePlus[0] === 'JEU'){
                                if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$('#jeuCheckbox1').prop({checked: true});}
                                else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$('#jeuCheckbox2').prop({checked: true});}
                                else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$('#jeuCheckbox3').prop({checked: true});}
                                else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$('#jeuCheckbox4').prop({checked: true});}
                            }
                            else if(decoupePlus[0] === 'VEN'){
                                if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$('#venCheckbox1').prop({checked: true});}
                                else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$('#venCheckbox2').prop({checked: true});}
                                else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$('#venCheckbox3').prop({checked: true});}
                                else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$('#venCheckbox4').prop({checked: true});}
                            }
                            else{
                                if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$('#samCheckbox1').prop({checked: true});}
                                else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$('#samCheckbox2').prop({checked: true});}
                                else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$('#samCheckbox3').prop({checked: true});}
                                else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$('#samCheckbox4').prop({checked: true});}
                            }

                        }
                    }

                    $('#cacheIdTypeSession').val(response.data[0]['id']);
                    $('#newLibTypeSession').val(response.data[0]['libelle']);
                    $('#nbreHeureTypeSession').val(response.data[0]['dureeSession']);
                    $('#nbreHeureTypeSession').text(response.data[0]['dureeSession']) ;
                    nbre = parseInt(response.data[0]['dureeSession'], 10);
                    $('#newTypeSession').click();
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

    $(document).on('click', '.suppTypeSession', function(e){
        idBtnModifSup = $(this).attr('id');

        $('#typeSessionModalTitle').html('<strong>Suppression - type Session</strong>');
        $('#typeSessionModalBody').text('Voulez-vous supprimer le type de session ?');
        $('#typeSessionBtnModalNon').text('Annuler');
        $('#typeSessionBtnModalOui').text('Supprimer');
        $('#typeSessionModal').modal('show');
    });

    $(document).on('click', '#typeSessionBtnModalOui', function(e){
        e.preventDefault();

        if($(this).text() === 'Supprimer'){
            $.ajax({
                url: 'php/typeSession/supprimeTypeSession.php',
                method: 'GET',
                data: {supTypeSession: idBtnModifSup},
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){location.href = './typeSession.php';}
                    else{
                        $('#typeSessionBtnModalNon').click();

                        shortCutFunction = 'error' ;
                        title = "Erreur" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
        else{$('#formTypeSession').submit();}
    });

    $('#validerTypeSession').on('click', function(e){
        e.preventDefault();
        $cacheId = $('#cacheIdTypeSession').val();

        if($cacheId === ''){$('#formTypeSession').submit();}
        else{
            $('#typeSessionModalTitle').html('<strong>Modification - type Session</strong>');
            $('#typeSessionModalBody').text('Voulez-vous Modifier le type de session ?');
            $('#typeSessionBtnModalNon').text('Annuler');
            $('#typeSessionBtnModalOui').text('Modifier');
            $('#typeSessionModal').modal('show');
        }
    });

    $('#formTypeSession').on('submit', function(e){
        e.preventDefault();

        $this = $(this) ;
        $nbreHeure = $('#nbreHeureTypeSession').val();
        $libTypeSession = $('#newLibTypeSession').val();
        $idCache = $('#cacheIdTypeSession').val();

        if($libTypeSession === ''){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Libellé vide." ;

            $('#showtoast').click() ;
        }
        else if($nbreHeure === '0'){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Aucune heure selectionnée." ;

            $('#showtoast').click() ;
        }
        else{
            $('#nbreHeureCache').val($nbreHeure);
            if($idCache === ''){
                $.ajax({
                    url: 'php/typeSession/insererTypeSession.php',
                    method: 'post',
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.message === 'ok'){location.href = './typeSession.php';}
                        else{
                            shortCutFunction = 'error' ;
                            title = "Erreur" ;
                            msg = data.message ;

                            $('#showtoast').click() ;
                        }
                    },
                    error: function(){alert('ERREUR NETWORK !');}
                });
            }
            else{
                $.ajax({
                    url: 'php/typeSession/modifierTypeSession.php',
                    method: 'POST',
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.message === 'ok'){location.href = './typeSession.php';}
                        else{
                            $('#typeSessionBtnModalNon').click();

                            shortCutFunction = 'error' ;
                            title = "Erreur" ;
                            msg = data.message ;

                            $('#showtoast').click() ;
                        }
                    },
                    error: function(){alert('ERREUR NETWORK !');}
                });
            }
        }
    });

    $('#newTypeSession').on('click', function(){
        $('#listeTypeSession').hide('slow') ;
        $('#saveTypeSession').show('slow') ;
    }) ;

    $('#retourListeTypeSession').on('click', function(){location.href = './typeSession.php';}) ;

    $('#lunCheckbox1').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (13 - 8);}
        else{nbre = nbre - (13 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#lunCheckbox2').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (14 - 8);}
        else{nbre = nbre - (14 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#lunCheckbox3').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (18 - 13);}
        else{nbre = nbre - (18 - 13);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#lunCheckbox4').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (20 - 18);}
        else{nbre = nbre - (20 - 18);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#marCheckbox1').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (13 - 8);}
        else{nbre = nbre - (13 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#marCheckbox2').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (14 - 8);}
        else{nbre = nbre - (14 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#marCheckbox3').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (18 - 13);}
        else{nbre = nbre - (18 - 13);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#marCheckbox4').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (20 - 18);}
        else{nbre = nbre - (20 - 18);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#merCheckbox1').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (13 - 8);}
        else{nbre = nbre - (13 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#merCheckbox2').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (14 - 8);}
        else{nbre = nbre - (14 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#merCheckbox3').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (18 - 13);}
        else{nbre = nbre - (18 - 13);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#merCheckbox4').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (20 - 18);}
        else{nbre = nbre - (20 - 18);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#jeuCheckbox1').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (13 - 8);}
        else{nbre = nbre - (13 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#jeuCheckbox2').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (14 - 8);}
        else{nbre = nbre - (14 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#jeuCheckbox3').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (18 - 13);}
        else{nbre = nbre - (18 - 13);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#jeuCheckbox4').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (20 - 18);}
        else{nbre = nbre - (20 - 18);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#venCheckbox1').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (13 - 8);}
        else{nbre = nbre - (13 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#venCheckbox2').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (14 - 8);}
        else{nbre = nbre - (14 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#venCheckbox3').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (18 - 13);}
        else{nbre = nbre - (18 - 13);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#venCheckbox4').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (20 - 18);}
        else{nbre = nbre - (20 - 18);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#samCheckbox1').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (13 - 8);}
        else{nbre = nbre - (13 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#samCheckbox2').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (14 - 8);}
        else{nbre = nbre - (14 - 8);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#samCheckbox3').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (18 - 13);}
        else{nbre = nbre - (18 - 13);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    $('#samCheckbox4').on('change', function(){
        if($(this).is(':checked')){nbre = nbre + (20 - 18);}
        else{nbre = nbre - (20 - 18);}
        $('#nbreHeureTypeSession').val(nbre);
        $('#nbreHeureTypeSession').text(nbre) ;
    });

    if($('#openAddTypeSession').val() === 'add'){$('#newTypeSession').click();}

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