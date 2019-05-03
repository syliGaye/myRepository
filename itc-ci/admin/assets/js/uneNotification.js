$(window).load(function(){
    if($('#voirNotification').val() === null){location.href = './index.php';}
    else{
        $.ajax({
            url: 'php/notification/afficherUneNotification.php',
            method: 'GET',
            data: {idUneNotif: $('#voirNotification').val()},
            dataType: 'JSON',
            success: function(response){
                if(response.message === 'ok'){
                    $('#titreNotif').text(response.data[0]['titre']);
                    $('#corpsNotif').html('<p>'+response.data[0]['corps']+'</p>');
                }
            },
            error: function(){alert('ERREUR NETWORK');}
        });
    }

    $('#uneNotifRetour').on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: 'php/notification/afficherUneNotification.php',
            data: {dataRetour: 'monnaie'},
            method: 'GET',
            dataType: 'JSON',
            success: function(response){
                if(response.message === 'annuler'){window.history.back();}
            },
            error: function(){alert('ERREUR NETWORK');}
        });
    });

    $(document).on('click', '#uneNotifAller', function(){
        if($('#titreNotif').text() === 'EXEMPLE 1'){
            $.ajax({
                url: 'php/notification/afficherUneNotification.php',
                method: 'GET',
                data: {continue1: $('#titreNotif').text()},
                dataType: 'JSON',
                success: function(response){
                    if(response.message === 'continuer'){location.href = './souscripteur.php';}
                },
                error: function(){alert('ERREUR NETWORK');}
            });
            //alert('bon');
        }
        else if($('#titreNotif').text() === 'EXEMPLE 2'){location.href = './sendMail.php';}
    });
});
