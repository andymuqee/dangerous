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

<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php e($page_subtitle); ?></h5>
                    <div class="ibox-tools">
                        <a href="javascript:window.location.reload();" class="btn btn-primary btn-xs">刷新本页</a>
                        <a data-id=0 data-keyboard="true" data-toggle="modal"
                           data-target="#myModal" class="btn btn-primary btn-xs">新建检查文件</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-sm-4 m-b-xs">
                            <select class="input-sm form-control input-s-sm inline">
                                <option value="0">选择部门</option>
                                <option value="1">选项1</option>
                                <option value="2">选项2</option>
                                <option value="3">选项3</option>
                            </select>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            <div data-toggle="buttons" class="btn-group">
                                <label class="btn btn-sm btn-white">
                                    <input type="radio" id="option1" name="options">天</label>
                                <label class="btn btn-sm btn-white active">
                                    <input type="radio" id="option2" name="options">周</label>
                                <label class="btn btn-sm btn-white">
                                    <input type="radio" id="option3" name="options">月</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="请输入checklog" class="input-sm form-control"> <span
                                        class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                    </div>
                    <div class="project-list m-b-sm m-t-sm">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th><input type="checkbox"/></th>
                                <th><?php e(地点名称); ?></th>
                                <th><?php e(危险品名称); ?></th>
                                <th><?php e(照片); ?></th>
                                <th><?php e(数量); ?></th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $k => $v): ?>
                                <tr index="0">
                                <td><input type="checkbox" name="checklog_id" value="<?php e($v->checklog_id); ?>"/>
                                </td>
                                <td><?php e($v->place_name); ?></td>
                                <td><?php e($v->item_name); ?></td>
                                <td><?php e($v->img_url); ?></td>
                                <td><?php e($v->nums); ?></td>
                                <td>
                                    <a data-id=<?php e($v->checklog_id); ?> data-keyboard="true" data-toggle="modal"
                                       data-target="#myModal">查看</a> |
                                    <a href="javascript:MQC.Dialog.alertUrl('是否删除该检查文件','checklog/delete?ajax=true&checklog_id=<?php e($v->checklog_id); ?>');">删除</a>
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
                <h4 class="modal-title">新建检查文件</h4>
                <small class="font-bold">
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>检查文件名称</label> <input id="name" type="text" placeholder="请输入检查文件名称" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button id="btnSave" type="button" data-id="" class="btn btn-primary">保存</button>
                <input id="floor_id" type="hidden" value=""/>
            </div>
        </div>
    </div>
</div>


<?php e($base_js); ?>

<script>
    $(document).ready(function () {
        var fields = ['checklog_id', 'name'];

        MQC.Dialog.save('myModal', 'btnSave', '/checklog/save?ajax=true', fields);

        $('#myModal').on('show.bs.modal', function (e) {
            o = $(e.relatedTarget);
            if (o.data('id') > 0) {
                $('#checklog_id').val(o.data('id'));
                MQC.Dialog.data('/checklog/detail?ajax=true&checklog_id=' + o.data('id'), fields);
            }
        });

        $('#loading-example-btn').click(function () {
            btn = $(this);
            simpleLoad(btn, true)
            simpleLoad(btn, false)
        });
    });

    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Refresh");
            }, 2000);
        }
    }
</script>
<?php e($test); ?>
</body>
</html>
