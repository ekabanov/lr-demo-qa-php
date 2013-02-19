$(document).ready(function () {
    $('.vote-up a, .vote-down a').on('click', function () {
        var el = $(this);
        var up = el.parents('.row').first().find('.vote-up');
        var down = el.parents('.row').first().find('.vote-down');
        $.getJSON(el.attr('href'), function (response) {
            up.removeClass('label-success');
            down.removeClass('label-inverse');
            if (response.type == -1) {
                down.addClass('label-inverse');
            } else if (response.type == 1) {
                up.addClass('label-success');
            }
            el.parents('.row').first().find('.votes').html(response.count);
        });
        return false;
    });
});