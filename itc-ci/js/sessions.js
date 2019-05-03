$(window).load(function(){
    var toastCount = 0;
    var $toastlast;
    var shortCutFunction = '' ;
    var msg = '' ;
    var title = '' ;
    var idDeLaSession = 0;

    $('#selectGenreFormation').on('change', function(e){
        if($(this).val() === '1'){
            $('#sessionPrgm').hide();
            $('#sessionNonPrgm').show();
        }
        else{
            $('#sessionNonPrgm').hide();
            $('#sessionPrgm').show();
        }
    });

    $('#participeBtnModalOui').on('click', function(e){
        e.preventDefault();

        var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        $nom = $('#nomSouscrire').val();
        $prenoms = $('#prenomSouscrire').val();
        $email = $('#emailSouscrire').val();
        $tel = $('#phoneSouscrire').val();
        $idSession = $('#idSessionSouscrire').val();

        if($nom === '' | $prenoms === '' | $email === '' | $tel === ''){
            shortCutFunction = 'error' ;
            title = "RESERVATION" ;
            msg = "Un champ est resté vide." ;

            $('#showtoast').click() ;
        }
        else if(!regex.test($email)){
            shortCutFunction = 'error' ;
            title = "RESERVATION" ;
            msg = "Veillez entré une adresse email correcte." ;

            $('#showtoast').click() ;
        }
        else{
            $.ajax({
                url: 'admin/php/reservation/faireReservation.php',
                method: 'GET',
                beforeSend: function () {
                    $('#participeBtnModalNon').click();
                    $('#btSessionCloseModal').hide();
                    $('#sessionsModalLoader').modal({ backdrop: 'static', keyboard: false});
                    $('#sessionsModalLoader').modal('show', 'slow');
                },
                data: {
                    nom: $nom,
                    prenoms: $prenoms,
                    mail: $email,
                    phone: $tel,
                    idSession: $idSession
                },
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){
                        $('#nomSouscrire').val("");
                        $('#prenomSouscrire').val("");
                        $('#emailSouscrire').val("");
                        $('#phoneSouscrire').val("");
                        $('#btSessionCloseModal').click();

                        shortCutFunction = 'success' ;
                        title = "RESERVATION" ;
                        msg = "reservation effectuée avec succès.\nUn mail de confirmation est envoyé." ;

                        $('#showtoast').click() ;
                    }
                    else{
                        $('#btSessionCloseModal').click();

                        shortCutFunction = 'error' ;
                        title = "RESERVATION" ;
                        msg = response.message ;

                        $('#showtoast').click() ;
                        $('#participeModalLong').modal('show', 'slow');
                    }
                },
                error: function(){
                    $('#btSessionCloseModal').click();
                    alert('ERREUR NETWORK');
                }
            });
        }
    });

    $(document).on('click', '.plusInfoSession', function(e){
        e.preventDefault();

        idDeLaSession = $(this).attr('id');
        if(idDeLaSession === null){alert('impossible d\'afficher les information');}
        else{
            $.ajax({
                url: 'admin/php/session/affichParId.php',
                method: 'GET',
                data: {envoiId: idDeLaSession},
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'ok'){
                        var $lun08001300 = "";  var $lun08301430 = "";  var $lun13301830 = "";  var $lun18302030 = "";
                        var $mar08001300 = "";  var $mar08301430 = "";  var $mar13301830 = "";  var $mar18302030 = "";
                        var $mer08001300 = "";  var $mer08301430 = "";  var $mer13301830 = "";  var $mer18302030 = "";
                        var $jeu08001300 = "";  var $jeu08301430 = "";  var $jeu13301830 = "";  var $jeu18302030 = "";
                        var $ven08001300 = "";  var $ven08301430 = "";  var $ven13301830 = "";  var $ven18302030 = "";
                        var $sam08001300 = "";  var $sam08301430 = "";  var $sam13301830 = "";  var $sam18302030 = "";

                        var joursHeurs = response.data[0]['jrsHrs'];   var decouperJrsHrs = joursHeurs.split(',');
                        for(var i = 0; i < decouperJrsHrs.length; i++){
                            var decoupePlus = decouperJrsHrs[i].split('_');
                            for(var j = 0; j < decoupePlus.length; j++){
                                if(decoupePlus[0] === 'LUN'){
                                    if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$lun08001300 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$lun08301430 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$lun13301830 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$lun18302030 = '<i class="fa fa-check text-greensea">';}
                                }
                                else if(decoupePlus[0] === 'MAR'){
                                    if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$mar08001300 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$mar08301430 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$mar13301830 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$mar18302030 = '<i class="fa fa-check text-greensea">';}
                                }
                                else if(decoupePlus[0] === 'MER'){
                                    if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$mer08001300 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$mer08301430 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$mer13301830 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$mer18302030 = '<i class="fa fa-check text-greensea">';}
                                }
                                else if(decoupePlus[0] === 'JEU'){
                                    if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$jeu08001300 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$jeu08301430 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$jeu13301830 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$jeu18302030 = '<i class="fa fa-check text-greensea">';}
                                }
                                else if(decoupePlus[0] === 'VEN'){
                                    if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$ven08001300 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$ven08301430 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$ven13301830 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$ven18302030 = '<i class="fa fa-check text-greensea">';}
                                }
                                else{
                                    if((decoupePlus[1] === '0800') && (decoupePlus[2] === '1300')){$sam08001300 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '0830') && (decoupePlus[2] === '1430')){$sam08301430 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1330') && (decoupePlus[2] === '1830')){$sam13301830 = '<i class="fa fa-check text-greensea">';}
                                    else if((decoupePlus[1] === '1830') && (decoupePlus[2] === '2030')){$sam18302030 = '<i class="fa fa-check text-greensea">';}
                                }

                            }
                        }

                        var aficher = '<div><address> <strong>Technologie &agrave; utilis&eacute;:</strong> '+response.data[0]['techno']+'<br>';
                        aficher += '<strong>Domaine de Formation:</strong> '+response.data[0]['domaine']+'<br> <strong>Certification li&eacute;e:</strong> '+response.data[0]['certif']+'<br>';
                        aficher += '<strong>Dur&eacute;e du cours:</strong> '+response.data[0]['dureeSession']+' heures</address><br><br>';
                        aficher += '<strong class="text-center">Emploi du temps de la semaine</strong><br>';
                        aficher += '<div><table class="table table-striped" id="tblGrid"><thead><tr><th></th><th class="text-center">8H00 – 13H00</th><th class="text-center">8H30 – 14H30</th><th class="text-center">13H30 – 18H30</th><th class="text-center">18H30 – 20H30</th></tr></thead>';
                        aficher += '<tbody><tr><td><strong>Lundi</strong></td><td class="text-center">'+$lun08001300+'</td><td class="text-center">'+$lun08301430+'</td><td class="text-center">'+$lun13301830+'</td><td class="text-center">'+$lun18302030+'</td></tr>';
                        aficher += '<tr><td><strong>Mardi</strong></td><td class="text-center">'+$mar08001300+'</td><td class="text-center">'+$mar08301430+'</td><td class="text-center">'+$mar13301830+'</td><td class="text-center">'+$mar18302030+'</td></tr>';
                        aficher += '<tr><td><strong>Mercredi</strong></td><td class="text-center">'+$mer08001300+'</td><td class="text-center">'+$mer08301430+'</td><td class="text-center"></td><td class="text-center">'+$mer13301830+'</td></tr>';
                        aficher += '<tr><td><strong>Jeudi</strong></td><td class="text-center">'+$jeu08001300+'</td><td class="text-center">'+$jeu08301430+'</td><td class="text-center">'+$jeu13301830+'</td><td class="text-center">'+$jeu18302030+'</td></tr>';
                        aficher += '<tr><td><strong>Vendredi</strong></td><td class="text-center">'+$ven08001300+'</td><td class="text-center">'+$ven08301430+'</td><td class="text-center">'+$ven13301830+'</td><td class="text-center">'+$ven18302030+'</td></tr>';
                        aficher += '<tr><td><strong>Samedi</strong></td><td class="text-center">'+$sam08001300+'</td><td class="text-center">'+$sam08301430+'</td><td class="text-center">'+$sam13301830+'</td><td class="text-center">'+$sam18302030+'</td></tr></tbody></table></div></div>';

                        $('#souscrireBtnModalNon').text('Retour');
                        $('#souscrireBtnModalOui').text('Reserver');
                        $('#souscrireModalLongTitle').html('<h3 class="text-center"><strong>'+response.data[0]['titre']+'</strong></h3>');
                        $('#souscrireModalLongBody').html(aficher);
                        $('#souscrireModalLong').modal('show', 'slow');
                    }
                },
                error: function(){alert('ERREUR NETWORK');}
            });
        }
    });


    $(document).on('click', '.sInscrireSession', function(e){
        e.preventDefault();

        idDeLaSession = $(this).attr("id");
        $('#idSessionSouscrire').val(idDeLaSession);
        $('#participeModalLong').modal('show', 'slow');
    }).click();


    $(document).on('click', '#souscrireBtnModalOui', function(e){
        e.preventDefault();

        $('#souscrireBtnModalNon').click();
        $('#idSessionSouscrire').val(idDeLaSession);
        $('#participeModalLong').modal('show', 'slow');

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