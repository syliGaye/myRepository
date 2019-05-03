$(window).load(function(){
    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;

    var valChecked = 0;
    var idBtnModifSup = 0;
    var nbre = 0;

    $(document).on('click', '.voirConsultant', function(e){
        e.preventDefault();
        idBtnModifSup = $(this).attr('id');

        $.ajax({
            url: 'php/consultant/afficheConsultantParId.php',
            data: {seeConsultant: idBtnModifSup},
            method: 'GET',
            dataType: 'JSON',
            success: function(response){
                if(response.message === 'ok'){
                    $('#consultantBtnModalNon').text('Annuler');
                    $('#consultantBtnModalOui').hide();
                    $('#consultantModalBody').text('blababla');
                    $('#consultantModalTitle').html('<strong>Details - Consultant</strong>');
                    $('#consultantModal').modal('show');
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


    $(document).on('click', '.suppConsultant', function(e){
        e.preventDefault();
        idBtnModifSup = $(this).attr('id');
        $('#consultantBtnModalNon').text('Annuler');
        $('#consultantBtnModalOui').text('Supprimer');
        $('#consultantModalBody').text('Voulez-vous supprimer la formation ?');
        $('#consultantModalTitle').html('<strong>Suppression - Consultant</strong>');
        $('#consultantModal').modal('show');
    });

    $('#consultantBtnModalOui').on('click', function(e){
        e.preventDefault();

        if($(this).text() === 'Supprimer'){
            $.ajax({
                url: 'php/consultant/supprimeConsultant.php',
                method: 'GET',
                data: {supConsultant: idBtnModifSup},
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){location.href = './consultant.php';}
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

    $('#newConsultant').on('click', function(){
        $('#listConsultant').hide('slow');
        $('#createConsultant').show('slow');
    });

    $('#retourListConsultant').on('click', function(){
        $('#listConsultant').show('slow');
        $('#createConsultant').hide('slow');
    });

    $('#agreeConsultant').on('change', function(){
        if($(this).is(':checked')){$(this).val("on");}
        else{$(this).val('off');}
    });

    $('#step1Consultant').on('submit', function(e){
        e.preventDefault();

        $this = $(this);


        $.ajax({
            url: 'php/tablesupport/insererTableSupport.php',
            method: 'post',
            data: $this.serialize(),
            dataType: 'json',
            success: function(reponse){
                if(reponse.message === 'ok'){
                    $('#idForm2').val(reponse.id);
                    $('#step2Consultant').submit();
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

    $('#step2Consultant').on('submit', function(e){
        e.preventDefault();

        $this = $(this);
        $lieuHabitation = $('#lieuHabitation').val();

        if($lieuHabitation === ''){
            $.ajax({
                url: 'php/consultant/insererConsultant.php',
                method: 'post',
                data: {idForm2: $('#idForm2').val()},
                dataType: 'json',
                success: function(reponse){
                    shortCutFunction = 'error' ;
                    title = "Erreur" ;
                    msg = reponse.message ;

                    $('#showtoast').click() ;
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
        else{
            $.ajax({
                url: 'php/consultant/insererConsultant.php',
                method: 'post',
                data: $this.serialize(),
                dataType: 'json',
                success: function(reponse){
                    if(reponse.message === 'ok'){
                        $('#idForm3').val(reponse.id);
                        $('#idForm4').val(reponse.id);
                        $('#step3Consultant').submit();
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
        }
    });

    $('#step3Consultant').on('submit', function(e){
        e.preventDefault();

        $this = $(this);

        if($('input:checkbox:checked').length < 2){
            $.ajax({
                url: 'php/specialite/insererSpecialite.php',
                method: 'post',
                data: {idForm3Sup: $('#idForm3').val()},
                dataType: 'json',
                success: function(reponse){
                    shortCutFunction = 'error' ;
                    title = "Erreur" ;
                    msg = reponse.message ;

                    $('#showtoast').click() ;
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
        else{
            $.ajax({
                url: 'php/specialite/insererSpecialite.php',
                method: 'post',
                data: $this.serialize(),
                dataType: 'json',
                success: function(reponse){
                    if(reponse.message === 'ok'){$('#step4Consultant').submit();}
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
    });

    $('#step4Consultant').on('submit', function(e){
        e.preventDefault();

        $this = $(this);
        var lesCheckbox = $('#step4Consultant input:checkbox');

        if(lesCheckbox.is(':checked')){alert('bien');}

        $.ajax({
            url: 'php/disponibilite/insererDisponibilite.php',
            data: $this.serialize(),
            method: 'POST',
            dataType: 'JSON',
            success: function(reponse){
                if(reponse.message === 'ok'){
                    location.href = './consultant.php';
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


    $.ajax({
        url: 'php/formation/getFormation.php',
        method: 'get',
        data: null,
        dataType: 'json',
        success: function(data){
            for($i = 0; $i<data.data.length; $i++){
                var valeur = ' <label class="checkbox-inline checkbox-custom">';
                valeur += '<input type="checkbox" name="checkFormationConsultant[]" id="consultantCheckbox" value="'+data.data[$i].id+'"><i></i> '+data.data[$i].titre;
                valeur += '</label>';
                $('#consultantDivCheckbox').append(valeur);
                //alert(valeur)
            }
        },
        error: function(){alert('ERREUR NETWORK');}
    });


    $('#rootwizard').bootstrapWizard({
        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#rootwizard').find('.pager .finish').show();
                $('#rootwizard').find('.pager .finish').removeClass('disabled');
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }

        },

        onNext: function(tab, navigation, index) {

            var form = $('form[name="step'+ index +'"]');

            form.parsley().validate();

            if (!form.parsley().isValid()) {
                return false;
            }

        },

        onTabClick: function(tab, navigation, index) {

            var form = $('form[name="step'+ (index+1) +'"]');
            form.parsley().validate();

            if (!form.parsley().isValid()) {
                return false;
            }

        }
    });

    $('#validerConsultant').on('click', function(){
        $agree = $('#agreeConsultant').val();
        $dateDebut = new Date($('#debutDispoConsultant').val());
        $dateFin = new Date($('#finDispoConsultant').val());
        $today = new Date();

        //alert($dateDebut - $today+' et date fin = '+$dateFin) ;

        if($agree === 'off'){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "chochez que vous etes sûr des entrées." ;

            $('#showtoast').click() ;
        }
        else if(($today - $dateDebut) >= 0){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Entrer une date de début supérieure à Aujourd'hui." ;

            $('#showtoast').click() ;
        }
        else if(($dateFin - $dateDebut) <= 0){
            shortCutFunction = 'error' ;
            title = "Erreur" ;
            msg = "Entrer une date de Fin supérieure à la date de Début." ;

            $('#showtoast').click() ;
        }
        else{
            //alert($dateDebut - $dateFin);
            $('#step1Consultant').submit() ;
        }
    });


    $('#lunConsult1').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#lunConsult2').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#lunConsult3').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#lunConsult4').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#marConsult1').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#marConsult2').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#marConsult3').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#marConsult4').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#merConsult1').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#merConsult2').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#merConsult3').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#merConsult4').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#jeuConsult1').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#jeuConsult2').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#jeuConsult3').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#jeuConsult4').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#venConsult1').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#venConsult2').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#venConsult3').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#venConsult4').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#samConsult1').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#samConsult2').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#samConsult3').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    $('#samConsult4').on('change', function(){
        nbre = $(this).is(':checked')? (nbre + 1):(nbre - 1);
        $('#consultJrsHrsCpte').val(nbre);
    });

    if($('#openAddConsultant').val() === 'add'){$('#newConsultant').click();
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

    $('#datetimepicker1').datetimepicker();
});