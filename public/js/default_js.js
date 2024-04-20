$(document).ready(function() {
    console.log('jquery is on fire')

    setTimeout(function(){
        $('#success-message').fadeOut('slow');
    }, 3000);

    $("#flexCheckChecked").change(function() {
        var passwordInput = $('input[name="password"]');
        var icInput = $('input[name="icnumber"], input[name="icnumber"]');
        
        if ($(this).is(":checked")) {
            passwordInput.val(icInput.val());
        } else {
            passwordInput.val("");
        }
    });
});