
$(function (){ 

    'use strict';

    // Switch Between Login & Signup

    $('.login-page h1 span').click(function(){

        $(this).addClass('selected').siblings().removeClass('selected');
        $('.login-page form').hide();
        $('.' + $(this).data('class')).fadeIn('100');

    });

    // Hide Placeholder On From Foucs

    $('[placeholder]').focus(function (){

        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder', '');

    }).blur(function(){

        $(this).attr('placeholder', $(this).attr('data-text'));
        
    });

    // Add Asterisk On Required Field

    $('.form-control').each(function(){
        if($(this).attr('required') == 'required'){
            $(this).after('<span class="asterisk">*</span>');
        }
    });

    
    $('.live').keyup(function (){

        $($(this).data('class')).text($(this).val());

    });

    
});