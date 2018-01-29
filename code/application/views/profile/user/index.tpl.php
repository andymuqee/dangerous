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
            <a href="/profile/user/edit" class="btn btn-primary"><i class="fa fa-plus"></i> 新建</a>
            <a id="frmBatch" href="javascript:void(0);" class="btn btn-primary" data-url="/profile/user/delete_batch"><i
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
                            <div class="col-sm-4 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="team_id">
                                    <option value="">选择班组</option>
                                    <?php foreach ($team as $v): ?>
                                        <option value="<?php e($v->team_id); ?>"><?php e($v->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" name="kw" placeholder="请输入真实名称" class="input-sm form-control">
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
                                <th><?php e(用户名); ?></th>
                                <th><?php e(类型); ?></th>
                                <th><?php e(真实姓名); ?></th>
                                <th><?php e(性别); ?></th>
                                <th><?php e(班组名称); ?></th>
                                <!--                                <th>--><?php //e(所属角色); ?><!--</th>-->
                                <!--                                <th>--><?php //e(所属岗位); ?><!--</th>-->
                                <!--                                <th>--><?php //e(照片); ?><!--</th>-->
                                <th><?php e(身份证号); ?></th>
                                <th><?php e(民族); ?></th>
                                <th><?php e(出生日期); ?></th>
                                <th><?php e(备注); ?></th>
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
                                                                        value="<?php e($v->user_id); ?>"></label>
                                    </div>
                                </td>
                                <td><?php e($v->username); ?></td>
                                <td><?php e($v->type == 1 ? '普通用户' : '管理员'); ?></td>
                                <td><?php e($v->realname); ?></td>
                                <td><?php e($v->sexy == 1 ? '男' : '女'); ?></td>
                                <td><?php e($v->team_name); ?></td>
                                <!--                                <td>--><?php //e($v->role_name); ?><!--</td>-->
                                <!--                                <td>--><?php //e($v->post_name); ?><!--</td>-->
                                <!--                                <td><img src="-->
                                <?php //e($v->avatar); ?><!--"/></td>-->
                                <td><?php e($v->ID); ?></td>
                                <td><?php e($v->nation); ?></td>
                                <td><?php e($v->birthday); ?></td>
                                <td><?php e($v->remark); ?></td>
                                <td>
                                    <a href="/profile/user/edit?user_id=<?php e($v->user_id); ?>">查看</a> |
                                    <a href="/profile/password/update?user_id=<?php e($v->user_id); ?>">设置密码</a><?php if ($v->username != "admin"): ?> |
                                    <a href="javascript:MQC.Dialog.alertUrl('是否删除该用户','/profile/user/delete?ajax=true&user_id=<?php e($v->user_id); ?>');">
                                            删除</a><?php endif ?>
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
                <h4 class="modal-title">新建用户</h4>
                <small class="font-bold">
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>用户名称</label> <input id="name" type="text" placeholder="请输入用户名称" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button id="btnSave" type="button" data-id="" class="btn btn-primary">保存</button>
                <input id="user_id" type="hidden" value=""/>
            </div>
        </div>
    </div>
</div>


<?php e($base_js); ?>

<script>
    $(document).ready(function () {
    });
</script>
</body>
</html>
