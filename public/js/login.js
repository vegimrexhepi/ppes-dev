jQuery(document).ready(function() {
    /*
        Fullscreen background
    */
    // $.backstretch("/images/backgrounds/1.jpg");

    /**
     * Check user's role
     */
    var wrongRoleProvided = typeof $("#wrong-role-provided")[0] !== 'undefined' ? true : false;

    if (wrongRoleProvided) {
        document.location.assign('/');
    }

    $('.registration-form').on('submit',function(){
        var form_password = $(this).find('input#form-password').val();
        var form_password_confirmation = $(this).find('input#form-password-confirmation').val();
        console.log(form_password);
        console.log(form_password_confirmation);
        if(form_password != form_password_confirmation){
            $(this).find('input#form-password-confirmation').closest('div.form-group').addClass('has-error');
            $(this).find('input#form-password').closest('div.form-group').addClass('has-error');
            $(this).find('input#form-password-confirmation').after( "<span class='help-block'><strong>The provided passwords do not match!</strong></span>" );
            return false;
        }else{
            $(this).find('input#form-password-confirmation').closest('div.form-group').removeClass('has-error');
            $(this).find('input#form-password').closest('div.form-group').removeClass('has-error');
            $(this).find('input#form-password-confirmation').closest('span.help-block').text('');
        }
    });

});