$(document).ready(function () {

    $(".btn-allow, .btn-disallow").bind('focus, click', function () {
        var id = this.id.split('-');
        if ($("#id-" + id[1]).hasClass('btn-allow')) {
            $("#id-" + id[1]).removeClass('btn-allow').addClass('btn-disallow');
            myUpdate(id[1], 'disallow');
        } else {
            $("#id-" + id[1]).removeClass('btn-disallow').addClass('btn-allow');
            myUpdate(id[1], 'allow');
        }
    });
    /*$(".btn-allow .btn-disallow").focus(function () {
     $('.btn-allow').click(function () {
     //console.log($(this).hasClass('btn-allow'));
     $("#id-" + id[1]).hasClass('btn-allow')
     disallow(id);
     }
     });
     
     $('.btn-disallow').click(function () {
     //console.log($(this).hasClass('btn-disallow'));
     var id = this.id.split('-');
     if ($("#id-" + id[1]).hasClass('btn-disallow')) {
     allow(id);
     }
     });
     });
     
     function allow(id) {
     $("#id-" + id[1]).addClass('btn-allow');
     $("#id-" + id[1]).removeClass('btn-disallow');
     myUpdate(id[1], 'allow');
     //console.log(id[1] + '-allow');
     }
     function disallow(id) {
     $("#id-" + id[1]).addClass('btn-disallow');
     $("#id-" + id[1]).removeClass('btn-allow');
     myUpdate(id[1], 'disallow');
     //console.log(id[1] + '-disallow');
     }*/

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
                if (r.status == 'allow') {
                    $('#id-' + r.id).html('<span aria-hidden="true" class="glyphicon glyphicon-ok"></span>');
                } else {
                    $('#id-' + r.id).html('<span aria-hidden="true" class="glyphicon glyphicon-remove"></span>');
                }

            }
        });
    }
});