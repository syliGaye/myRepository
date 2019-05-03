$(window).load(function(){
    $('#contSelect').on('click', function(){
        $('#descSelect').html('<span class="fa fa-angle-right"></span> Description');
        $('#contSelect').html('<span class="fa fa-angle-down"></span> Contenu');
        $('#descView').hide('slideUp');
        $('#contView').show('slideDown');
    });

    $('#descSelect').on('click', function(){
        $('#descSelect').html('<span class="fa fa-angle-down"></span> Description');
        $('#contSelect').html('<span class="fa fa-angle-right"></span> Contenu');
        $('#contView').hide('slideDown');
        $('#descView').show('slideUp');
    });
});