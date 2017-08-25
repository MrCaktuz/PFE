/*
 *    Description:    Ajax script to load data with filters
 *    File:            more-games.js
 *    Version:        1.0 - 18/08/2017
 *    Author :        Mucht - claessens.mathieu@gmail.com
*/
$(function() {
    // ******** Get data from team filters ********
    var teamFilters = new Array();
    $('body').on('click', '.filters-teams-team', function(elt){
        teamFilters.length = 0;
        $(this).toggleClass('selected');
        $('.filters-teams-team.selected').each(function(elt){
            team = $(this).attr('data-teamID');
            teamFilters.push(team);
        })
    });
    // ******** Get data from date filters ********
    var dateFilters = new Array();
    $('body').on('click','.monthly-day-pick', function(elt){
        if (!$(this).hasClass('monthly-past-day')) {
            $(this).toggleClass('selected');
        } else {
            $(this).removeClass('selected');
        }
        date = $(this).data('date');
        // ******** Check if the date is already in the array ********
        dateCheck = $.inArray(date, dateFilters);
        if (dateCheck == -1) {
            // ******** store data in array ********
            dateFilters.push(date);
        } else {
            // ******** remove data from array ********
            if (!Array.prototype.remove) {
                Array.prototype.remove = function(val) {
                var i = this.indexOf(val);
                    return i>-1 ? this.splice(i, 1) : [];
                };
            }
            dateFilters.remove(date);
        }
        window.history.pushState('', '', '/?dates='+dateFilters);
    });
    
    // ******** Manage ajax ********
    $('body').on('click', '.filters-submit', function(e) {
        e.preventDefault();
        var data = { teams : teamFilters, dates : dateFilters };
            url = $(this).attr('href'),
            token = $("meta[name='csrf-token']").attr('content'),
            teamFiltersLength = teamFilters.length,
            dateFiltersLength = dateFilters.length;
        if (data == null) {
            $(this).after('<div class="feedback-error"<p>Choisissez des filters avant de valider...</p></div>');
        } else {
            $.ajax({
                type: "POST",
                url: url,
                data: { '_token': token, 'data': data },
                success: function(response) {
                    $('.gameCard-wrap').html(response.html);
                }
            })
        }
    });
});