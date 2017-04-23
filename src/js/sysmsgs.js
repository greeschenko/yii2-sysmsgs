let removeActive = function() {
    $('.sysmsgs').each(function(index) {
        $(this).removeClass('active');
    });
};

$('.sysmsgs').each(function(index) {
    let mel = $(this);
    $(mel.data('res')).addClass('sysmsgsres');
    mel.addClass(mel.data('group'));
    $.ajax({
        url: '/sysmsgs/my/get-count',
        type: 'GET',
        dataType: 'json',
        data: 'group=' + mel.data('group'),
        success: function(data, textStatus, jqXHR) {
            let a = new Hata('#' + mel.attr('id'));
            if (data.count == 0) {
                a.el.addClass('hidden');
            }
            a.dom = `
                    <div class="icon">
                        <i class="fa ${mel.data('icon')}" aria-hidden="true"></i>
                    </div>
                    <div class="title">${mel.data('title')}</div>
                    <div class="count">${data.count}</div>
                `;
            a.data = {};
            a.events = function() {
                a.el.bind('click', function() {
                    if (a.el.hasClass('active')) {
                        $(mel.data('res')).removeClass('active');
                        $(mel.data('res')).html('');
                        a.el.removeClass('active')
                    } else {
                        removeActive();
                        $.ajax({
                            url: '/sysmsgs/my/get-all',
                            type: 'GET',
                            dataType: 'json',
                            data: 'group=' + mel.data('group'),
                            success: function(data, textStatus, jqXHR) {
                                $(mel.data('res')).addClass('active');
                                a.el.addClass('active')
                                a.active = 1;
                                let b = new Hata(mel.data('res'));
                                b.dom = `
                                        <div class="sysmsgsitem {{type}}" data-id="{{id}}">
                                            <div class="date">{{date}}</div>
                                            <div class="content">{{content}}</div>
                                            <div class="closebtn">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    `;
                                b.data = data.items;
                                b.events = function() {
                                    b.el.find('.closebtn').each(function(index) {
                                        let el = $(this);
                                        el.bind('click', function() {
                                            $.ajax({
                                                url: '/sysmsgs/my/check-read',
                                                type: 'GET',
                                                dataType: 'json',
                                                data: 'id=' + el.parent().data('id'),
                                                success: function(data, textStatus, jqXHR) {
                                                    el.parent().remove();
                                                },
                                            });
                                        });
                                    });
                                };
                                b.render();
                            },
                        });
                    }
                });
            };
            a.render();
            setInterval(function() {
                $.ajax({
                    url: '/sysmsgs/my/get-count',
                    type: 'GET',
                    dataType: 'json',
                    data: 'group=' + mel.data('group'),
                    success: function(data, textStatus, jqXHR) {
                        if (data.count > 0) {
                            a.el.removeClass('hidden');
                        } else {
                            a.el.addClass('hidden');
                        }
                        a.el.find('.count').html(data.count);
                    },
                });
            }, 2000);
        }
    });
});
