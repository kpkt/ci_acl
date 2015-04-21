$(document).ready(function () {
    $('#menu li a').on('click', function () {
        $(this).addClass('current');
        $(this).parent().siblings().find('a').removeClass('current');
    });
    $("#acls .allow").click(function () {
        var id = this.id.split('-');
        myUpdate(id[1], 'allow');
        $(this).addClass('disallow');
        $(this).removeClass('allow');
        $(this).text('disallow');
          console.log($(this));
        //$(this).removeClass('btn-success');
        //$(this).removeClass('allow');
        //$(this).addClass('btn-danger');
        //$(this).addClass('disallow');
        //console.log($(this).addClass('btn-danger disallow'));
        //$('#id-' + id[1]).addClass('btn-danger');

    });
    $('#acls .disallow').click(function () {
        var id = this.id.split('-');
        myUpdate(id[1], 'disallow');
        $(this).addClass('allow');
        $(this).removeClass('disallow');
        $(this).text('allow');
        //$(this).removeClass('btn-danger');
        //$(this).removeClass('disallow');
        //$(this).addClass('btn-success');
        //$(this).addClass('allow');
        console.log($(this));
        //$('#id-' + id[1]).addClass('btn-success');

    });

    function myUpdate(id, status) {
        jQuery.ajax({
            url: site_url + 'index.php/permissions/ajax_permission',
            type: 'post',
            dataType: 'json',
            data: {
                'id': id,
                'status': status
            },
            success: function (r) {
                if (r.status == 'disallow') {
                    //$('#id-' + r.id).addClass('btn-success');
                } else {
                    //$('#id-' + r.id).addClass('btn-danger');
                }

            }
        });
    }
});