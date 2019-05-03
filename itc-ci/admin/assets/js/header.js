$(window).load(function(){
    $('#afficherNotif').on('click', function(){
        if($('#lesNotifs').is(':hidden')){
            $.ajax({
                url: 'php/notification/mettreaOuver.php',
                method: 'GET',
                data: null,
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'bien'){$('#nbreNotification').hide();}
                },
                error: function(msg){
                    alert('ERREUR NETWORK');
                    console.log(msg);
                }
            });
            $('#lesNotifs').show('slow');
            $('#leProfil').hide('slow');
        }
        else{
            $('#lesNotifs').hide('slow');
        }
    });

    $('#afficherProfil').on('click', function(){
        if($('#leProfil').is(':hidden')){
            $('#leProfil').show('slow');
            $('#lesNotifs').hide('slow');
        }
        else{
            $('#leProfil').hide('slow');
        }
    });

    $(document).on('click', function(){
        if($('#afficherNotif').prop('clicked', false)){
            $('#lesNotifs').hide();
            $('#leProfil').hide();
        }
    });

    $('#profilLogout').on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: 'php/compteConsultant/deconnexionCompte.php',
            method: 'get',
            data: null,
            success: function(data){
                if(data.message === 'ok'){
                    location.href = './login.php';
                }
                else{
                    location.href = './index.php';
                }
            },
            error: function(){
                location.href = './index.php';
            }
        });
    });

    $(document).on('click', '.titreNotif', function(e){
        e.preventDefault();

        var $this = $(this) ;
        $.ajax({
            url: 'php/notification/afficherUneNotification.php',
            method: 'GET',
            data: {idNotif: $this.attr('id')},
            dataType: 'JSON',
            success: function(response){
                if(response.leId !== 0){location.href = './uneNotification.php';}
            },
            error: function(){alert('ERREUR NETWORK');}
        });
    });
});