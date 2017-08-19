// /*
//  *    Description:    Ajax script to load more games
//  *    File:            more-games.js
//  *    Version:        1.0 - 13/08/2017
//  *    Author :        Mucht - claessens.mathieu@gmail.com
// */
$(function() {
    $('body').on('click', '.gameCard-wrap .pagination a', function(e) {
        e.preventDefault();
        $('.gameCard').css('opacity', '0');
        $('.gameCard-wrap').append('<div class="pagination-loading"><img class="pagination-loading-icon" src="/img/icons/loading-icon.gif" alt="Loading"></div>');

        var url = $(this).attr('href');  
        getGames(url);
        window.history.pushState("", "", url);
    });

    function getGames(url) {
        $.ajax({
            url : url  
        }).done(function (data) {
            $('.gameCard-wrap').html(data);
            $(".gameCard-wrap a[rel='prev']").html('Match précédent').addClass('button button-more button-more-prev');
            $(".gameCard-wrap a[rel='next']").html('Match suivant').addClass('button button-more button-more-next');
            if ($(".gameCard-wrap a[rel='prev']").hasClass('button-more-prev')) {
                $('.gameCard-wrap').css('padding-top', '10rem');
            } else {
                $('.gameCard-wrap').css('padding-top', '4rem');
            }
        }).fail(function () {
            alert('Impossible de charger les matchs.');
        });
    }
});