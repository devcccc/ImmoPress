var toggler = jQuery('.group-head');

toggler.each(function () {
    jQuery(this).click(function () {
        jQuery(this).next('.field-table').slideToggle('slow');
        var togglebtn = jQuery(this).children('.toggle-btn');
        var toggletext = togglebtn.text();
        if(toggletext == '+') {
            togglebtn.text('-');
        } else {
            togglebtn.text('+');
        }
    }).children('.term-trans').click(function () {
        return false;
    })
});

(function($) {

    $('.new-group').click(function () {
       var name = $(this).parent().find('#groupname').val();
       if(name == '') {
           alert('Es fehlt ein Gruppenname');
           return false;
       }
    });

    $('.delete-link').click(function () {
        var name = $(this).parent().parent().find('.groupname p strong').html();
        var result = confirm('Möchten Sie "' + name + '" wirklich löschen?');
        if (result) {
            return true;
        }
        return false;
    })


    $(function () {
       $('.keys-table').sortable({
           items: ".row:not(.first-row)"
       });
       $('.keys-table').disableSelection();
    });

    $( "#immo-tabs" ).tabs();
})(jQuery);
