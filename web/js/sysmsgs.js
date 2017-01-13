function makeFromTemplate(obj, html) {
    for (var i in obj) {
        html = html.replace(new RegExp('{{' + i + '}}', 'g'), obj[i]);
    }
    return html;
}

$(window).ready(function() {
    setInterval(function() {
        $.ajax({
            method: "GET",
            url: '/sysmsgs/my/get-count',
            dataType: "json",
            success: function(data, textStatus, xhr) {
                var el = $('#msgcount');
                if (data.count > 0) {
                    el.parent().addClass('blink');
                } else {
                    el.parent().removeClass('blink');
                }
                el.html(data.count);
            },
        });
    }, 1000);

    $('.msgbtn').bind('click', function() {
        $.ajax({
            method: "GET",
            url: '/sysmsgs/my/get-all',
            dataType: "json",
            success: function(data, textStatus, xhr) {
                var res = '';
                for (var i in data.items) {
                    res += makeFromTemplate(data.items[i], $('.sysmsgsors').html());
                }
                $('.sysmsgsres').html(res);
                $('.sysmsgsres').slideToggle();
                $('.sysmsgsshowall').toggle();

                $('.sysmsgsres').find('.close').each(function(i) {
                    var el = $(this);
                    $(this).bind('click', {}, function(ev) {
                        $.ajax({
                            method: "GET",
                            url: '/sysmsgs/my/check-read',
                            data: 'id=' + el.data('id'),
                        });
                    });
                });
            },
        });
    });
});
