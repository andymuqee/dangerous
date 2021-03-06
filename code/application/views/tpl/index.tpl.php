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
                        <a href="/sysconfig/user/edit" class="btn btn-primary btn-xs">新建员工</a>
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
                        <!--                        <div class="col-sm-4 m-b-xs">-->
                        <!--                            <div data-toggle="buttons" class="btn-group">-->
                        <!--                                <label class="btn btn-sm btn-white">-->
                        <!--                                    <input type="radio" id="option1" name="options">天</label>-->
                        <!--                                <label class="btn btn-sm btn-white active">-->
                        <!--                                    <input type="radio" id="option2" name="options">周</label>-->
                        <!--                                <label class="btn btn-sm btn-white">-->
                        <!--                                    <input type="radio" id="option3" name="options">月</label>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="请输入姓名" class="input-sm form-control"> <span
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
                                <!--                                <th>用户名</th>-->
                                <th>真实姓名</th>
                                <th>所属部门</th>
                                <th>角色</th>
                                <th>岗位</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $k => $v): ?>
                                <tr index="0">
                                    <td><input type="checkbox"/></td>
                                    <!--                                    <td>-->
                                    <?php //e($v->username); ?><!--</td>-->
                                    <td><?php e($v->realname); ?></td>
                                    <td><?php e($v->department); ?></td>
                                    <td><?php e($v->role); ?></td>
                                    <td><?php e($v->post); ?></td>
                                    <td>
                                        <a href="/sysconfig/user/edit?user_id=<?php e($v->user_id); ?>">查看</a> |
                                        <a href="javascript:MQC.Dialog.alertUrl('是否删除该职工信息','/sysconfig/user/delete?user_id=<?php e($v->user_id); ?>');">删除</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php e($page_tpl) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php e($base_js); ?>

<script>
    $(document).ready(function () {

        $('#loading-example-btn').click(function () {
            btn = $(this);
            simpleLoad(btn, true)

            // Ajax example
//                $.ajax().always(function () {
//                    simpleLoad($(this), false)
//                });

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
</body>
</html>
