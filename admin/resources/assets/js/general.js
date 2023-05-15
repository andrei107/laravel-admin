import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {

    let location = window.location.href;
    $('.nav-link').each(function () {
        var link = $(this).attr('href');
        if (location == link || location == link) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });


    function showError(message) {
        var $alertWrapper = $(".alert-wrapper"),
            $errorWrapper = $(".alert--error"),
            $messageWrapper = $errorWrapper.find('.alert-message');

        $messageWrapper.text(message);

        $alertWrapper.show();
        $errorWrapper.show(500);
    }

    function hideError() {
        var  $alertWrapper = $(".alert-wrapper"),
        $errorWrapper = $(".alert--error");

        $errorWrapper.hide(500);
        $alertWrapper.hide();
    }


    function showSuccess(message) {
        var $alertWrapper = $(".alert-wrapper"),
            $successWrapper = $(".alert--success"),
            $messageWrapper = $successWrapper.find('.alert-message');

        $messageWrapper.text(message);

        $alertWrapper.show();
        $successWrapper.show(500);
    }

    function hideSuccess() {
        var $alertWrapper = $(".alert-wrapper"),
            $successWrapper = $(".alert--success");

        $successWrapper.hide(500);
        $alertWrapper.hide();
    }

})
