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
    $(".btn-allow-all, .btn-disallow-all").bind('focus, click', function () {
        var id = this.id.split('-');
        if ($(this).hasClass('btn-allow-all')) {
            myUpdateAll(id[1], 'allowall');
        } else {
            myUpdateAll(id[1], 'disallowall');
        }
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
                if (r.status == 'allow') {
                    $('#id-' + r.id).html('<span aria-hidden="true" class="glyphicon glyphicon-ok"></span>');
                } else {
                    $('#id-' + r.id).html('<span aria-hidden="true" class="glyphicon glyphicon-remove"></span>');
                }
            }
        });
    }
    function myUpdateAll(id, status) {
        jQuery.ajax({
            url: site_url + 'index.php/permissions/ajax_permissionall',
            type: 'post',
            dataType: 'json',
            data: {
                'id': id,
                'status': status
            },
            success: function (r) {

                if (r.status == 'allowall') {
                    $(".btn-allow, .btn-disallow").each(function (index) {//list all element with class ".btn-allow, .btn-disallow"
                        var idBtn = $(this).attr('id').split('-');
                        if (idBtn[2] == r.id) { //filter only element id equal to id roles                  
                            $(this).html('<span aria-hidden="true" class="glyphicon glyphicon-ok"></span>');
                            $(this).removeClass('btn-disallow').addClass('btn-allow');
                        }
                    });
                } else {
                    $(".btn-allow, .btn-disallow").each(function (index) {//list all element with class ".btn-allow, .btn-disallow"
                        var idBtn = $(this).attr('id').split('-');
                        if (idBtn[2] == r.id) {//filter only element id equal to id roles
                            $(this).html('<span aria-hidden="true" class="glyphicon glyphicon-remove"></span>');
                            $(this).removeClass('btn-allow').addClass('btn-disallow');
                        }
                    });
                }

            }
        });
    }
});