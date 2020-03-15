
jQuery(document).ready(function() {

    /*
        Login form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });

    $('.login-form').on('submit', function(e) {

    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});

    });

    $('.profile-form').on('submit', function(e) {

        $(this).find('input[type="password"]').each(function(){
            if( $('#form-password').val() != "" && $('#form-password-confirmation').val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
            }
            else {
                $(this).removeClass('input-error');
            }
        });

    });

    /*
        Registration form validation
    */
    $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });

    $('.registration-form').on('submit', function(e) {

    	$(this).find('input[type="text"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});

    });

$("#lecturer").click(function(){
    $("#login-lecturer").fadeIn("slow");
    $("#register-lecturer").fadeOut(0);
    $("#login-student").fadeOut(0);
    $("#register-student").fadeOut(0);
    $("#password-reset-lecturer").fadeOut(0);
    $("#password-reset-student").fadeOut(0);
});

$("#student").click(function(){
    $("#login-student").fadeIn("slow");
    $("#register-student").fadeOut(0);
    $("#login-lecturer").fadeOut(0);
    $("#register-lecturer").fadeOut(0);
    $("#password-reset-student").fadeOut(0);
    $("#password-reset-lecturer").fadeOut(0);
});

$("#register-lecturer-login").click(function(){
    $("#login-lecturer").fadeOut(0);
    $("#register-lecturer").fadeIn("slow");
});


$("#register-student-login").click(function(){
    $("#login-student").fadeOut(0);
    $("#register-student").fadeIn("slow");
});

$("#forgot-password-student").click(function(){
    $("#login-student").fadeOut(0);
    $("#password-reset-student").fadeIn("slow");
});

$("#forgot-password-lecturer").click(function(){
    $("#login-lecturer").fadeOut(0);
    $("#password-reset-lecturer").fadeIn("slow");
});

});



$(window).resize(function() {
    var path = $(this);
    var contW = path.width();
    if(contW >= 1024){
        document.getElementsByClassName("sidebar-toggle")[0].style.left="200px";
    }else{
        document.getElementsByClassName("sidebar-toggle")[0].style.left="-200px";
    }
});
$(document).ready(function() {
    $('.dropdown').on('show.bs.dropdown', function(e){
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
    });
    $('.dropdown').on('hide.bs.dropdown', function(e){
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(300);
    });


        $("#menu-toggle").click(function(e) {
        e.preventDefault();
        var elem = document.getElementById("sidebar-wrapper");
        left = window.getComputedStyle(elem,null).getPropertyValue("left");
        if(left == "200px"){
             document.getElementsByClassName("sidebar-toggle")[0].style.left="-200px";
         }
        else if(left == "-200px"){
            document.getElementsByClassName("sidebar-toggle")[0].style.left="200px";
        }
    });
});



$(document).ready(function(){
    $('.student-click').click(function(){
        $(this).prev('.settings-open').slideToggle("slow");
    });
    $('.click-show-modal').click(function(){
        $('.settings-open').slideUp("slow");
        var studentId = $(this).data('id');
        $(this).prev('#settingopen-'+studentId).slideDown("slow");
        $('#myModal').modal('show')
    });
    // $('.settings-open').click(function(){
    //     $(this).slideToggle("slow");
    // // });
    // $('.search-input-group').click(function(){
    //   $("input.live-search-box").css("width", "300px");
    // });
});



$("#sidebar-wrapper").scroll(function() {

 $(".sidebar-toggle").addClass("topheight");

});
