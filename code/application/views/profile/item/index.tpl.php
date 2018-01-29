<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php e($page_title); ?> - <?php e($page_subtitle); ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php e($base_css); ?>
    <!-- Data Tables -->
    <link href="/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?php e($page_subtitle); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a>主页</a>
            </li>
            <li>
                <strong><?php e($page_subtitle); ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="javascript:window.location.reload();" class="btn btn-primary"><i class="fa fa-refresh"></i>
                刷新本页</a>
            <a data-id=0 data-keyboard="true" data-toggle="modal"
               data-target="#myModal" class="btn btn-primary"><i class="fa fa-plus"></i> 新建</a>
            <a id="frmBatch" href="javascript:void(0);" class="btn btn-primary" data-url="/profile/item/delete_batch"><i
                        class="fa fa-trash"></i> 批量删除</a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form id="frm" method="get" action="">
                        <div class="row m-b-sm m-t-sm">
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" name="kw" placeholder="请输入名称" class="input-sm form-control">
                                    <span
                                            class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"
                                                onclick="javascript:$('#frm').submit();"><i class="fa fa-search"></i> 搜索</button> </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="project-list m-b-sm m-t-sm">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <div class="checkbox"><label><input type="checkbox" id="frmCheck" value=""></label>
                                    </div>
                                </th>
                                <th>名称</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($data as $k => $v): ?>
                            <tr index="<?php e($i++); ?>">
                                <td>
                                    <div class="checkbox"><label><input type="checkbox" class="ids"
                                                                        value="<?php e($v->item_id); ?>"></label>
                                    </div>
                                </td>
                                <td><?php e($v->name); ?></td>
                                <td>
                                    <a data-id=<?php e($v->item_id); ?> data-keyboard="true" data-toggle="modal"
                                       data-target="#myModal">查看</a> |
                                    <a href="javascript:MQC.Dialog.alertUrl('是否删除该危险品名','/profile/item/delete?ajax=true&item_id=<?php e($v->item_id); ?>');">删除</a>
                                </td></tr><?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php e($page_tpl) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">关闭</span>
                </button>
                <i class="fa fa-laptop modal-icon"></i>
                <h4 class="modal-title">新建危险品名称</h4>
                <small class="font-bold">
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>危险品名称</label> <input id="name" type="text" placeholder="请输入危险品名称" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button id="btnSave" type="button" data-id="" class="btn btn-primary">保存</button>
                <input id="item_id" type="hidden" value=""/>
            </div>
        </div>
    </div>
</div>


<?php e($base_js); ?>

<script>
    $(document).ready(function () {

        var fields = ['item_id', 'name'];

        MQC.Dialog.save('myModal', 'btnSave', '/profile/item/save?ajax=true', fields);

        $('#myModal').on('show.bs.modal', function (e) {
            o = $(e.relatedTarget);
            if (o.data('id') > 0) {
                $('#item_id').val(o.data('id'));
                MQC.Dialog.data('/profile/item/detail?ajax=true&item_id=' + o.data('id'), fields);
            }
        });

    });

</script>
<?php e($test); ?>
</body>
</html>
