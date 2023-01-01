'use strict';

//Enable tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

//Get and set current year in the footer
var d = new Date();
var n = d.getFullYear();
var currentYear = document.getElementById('currentYear');
currentYear.textContent = n + '. ';

//Smooth scrolling. Bootstrap 4's jQuery 3.1.1 slim.min does not work with this.
$(document).ready(function () {
    $('a').on('click', function (event) {
        if (this.hash !== '') {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate(
                {
                    scrollTop: $(hash).offset().top
                },
                800,
                function () {
                    window.location.hash = hash;
                }
            );
        }
    });
});

jQuery(document).ready(function ($) {
    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.cd-top');

    //hide or show the "back to top" link
    $(window).scroll(function () {
        $(this).scrollTop() > offset
            ? $back_to_top.addClass('cd-is-visible')
            : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if ($(this).scrollTop() > offset_opacity) {
            $back_to_top.addClass('cd-fade-out');
        }
    });

    //Smooth scroll to top
    $back_to_top.on('click', function (event) {
        event.preventDefault();
        $('body,html').animate(
            {
                scrollTop: 0
            },
            scroll_top_duration
        );
    });
});
