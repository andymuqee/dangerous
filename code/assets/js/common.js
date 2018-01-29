// checkbox样式
$('.checkbox').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue',
});

$('#frmCheck').on('ifClicked', function (event) {
    if ($(this).is(':checked')) {
        $('.checkbox').iCheck('uncheck');
    } else {
        $('.checkbox').iCheck('check');
    }
});

// 批量删除
$('#frmBatch').click(function (e) {
    var ids = [];
    $('.ids:checked').each(function () {
        ids.push($(this).val());
    });
    if (ids.length < 1) {
        layer.msg("请选择记录");
    } else {
        MQC.Dialog.alertUrl('是否批量删除？', $(this).data('url') + '?ajax=true&ids=' + ids.join(','));
    }
});