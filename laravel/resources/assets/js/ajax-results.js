// /*
//  *    Description:    Ajax script to load more results
//  *    File:            more-results.js
//  *    Version:        1.0 - 16/08/2017
//  *    Author :        Mucht - claessens.mathieu@gmail.com
// */
$(function() {
    $('body').on('click', '.resultCard-wrap .pagination a', function(e) {
        e.preventDefault();
        $('.resultCard').css('opacity', '0');
        $('.resultCard-wrap').append('<div class="pagination-loading"><img class="pagination-loading-icon" src="/img/icons/loading-icon.gif" alt=""></div>');

        var url = $(this).attr('href');  
        getResults(url);
        window.history.pushState("", "", url);
    });

    function getResults(url) {
        $.ajax({
            url : url  
        }).done(function (data) {
            $('.resultCard-wrap').html(data);
            $(".resultCard-wrap a[rel='prev']").html('Résultat plus récent').addClass('button button-more button-more-prev');
            $(".resultCard-wrap a[rel='next']").html('Anciens résultats').addClass('button button-more button-more-next');
            if ($(".resultCard-wrap a[rel='prev']").hasClass('button-more-prev')) {
                $('.resultCard-wrap').css('padding-top', '10rem');
            } else {
                $('.resultCard-wrap').css('padding-top', '4rem');
            }
        }).fail(function () {
            alert('Impossible de charger les résultats.');
        });
    }
});