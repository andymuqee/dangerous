<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php e($page_title); ?> - <?php e($page_subtitle); ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php e($base_css); ?>
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
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
                                <select class="input-sm form-control input-s-sm inline" name="item_id">
                                    <option value="">选择危险品名称</option>
                                    <?php foreach ($item as $v): ?>
                                        <option value="<?php e($v->item_id); ?>"><?php e($v->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="team_id">
                                    <option value="">选择班组</option>
                                    <?php foreach ($team as $v): ?>
                                        <option value="<?php e($v->team_id); ?>"><?php e($v->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="place_id">
                                    <option value="">选择发现地点</option>
                                    <?php foreach ($place as $v): ?>
                                        <option value="<?php e($v->place_id); ?>"><?php e($v->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row m-b-sm m-t-sm">
                            <div class="col-sm-4 m-b-xs">
                                <div class="form-group mg-r" style="position:relative;">
                                    <input type="text" placeholder="请输入发现人姓名"
                                           class="input-sm form-control input-s-sm inline"> <span
                                            class="input-group-btn">
                                </div>
                            </div>
                            <div class="col-sm-8 m-b-xs">
                                <div class="form-group mg-r" style="position:relative;">
                                    <div data-toggle="buttons" class="btn-group">
                                        <label class="btn btn-sm btn-white">
                                            <input type="radio" id="option4" name="date" value="4">不限</label>
                                        <label class="btn btn-sm btn-white">
                                            <input type="radio" id="option1" name="date" value="1">天</label>
                                        <label class="btn btn-sm btn-white">
                                            <input type="radio" id="option2" name="date" value="2">周</label>
                                        <label class="btn btn-sm btn-white">
                                            <input type="radio" id="option3" name="date" value="3">月</label>
                                    </div>
                                    <div style="float: left;width: 74%">
                                        <input id="date_range" name="date_range" type="text" placeholder="时间段选择"
                                               class="input-sm form-control input-s-sm inline"> <span
                                                class="input-group-btn" disabled="disabled">
                                    </div>
                                    <!--                                    <div class="form-inline" style="width:400px;display:inline-block;margin-left:2px">-->
                                    <!--                                           <span class="input-daterange input-group">-->
                                    <!--                                               <input value="" class="input-sm form-control" name="start_date"-->
                                    <!--                                                      id="qBeginTime" data-date-format="yyyy-mm-dd"-->
                                    <!--                                                      style="border-radius:0px;" type="text">-->
                                    <!--                                               <span class="input-group-addon">至</span>-->
                                    <!--                                               <input value="" class="input-sm form-control" name="end_date"-->
                                    <!--                                                      id="qEndTime" data-date-format="yyyy-mm-dd"-->
                                    <!--                                                      style="border-radius:0px;" type="text">-->
                                    <!--                                           </span>-->
                                    <!--                                    </div>-->
                                    <div class="form-group mg-r" style="position:relative;">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 m-b-xs text-center">
                                <a href="javascript:$('#frm').submit();" class="btn btn-primary"><i
                                            class="fa fa-search"></i> 搜　索</a>
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
                                <th><?php e(日期); ?></th>
                                <th><?php e(照片); ?></th>
                                <th><?php e(危险品名称); ?></th>
                                <th><?php e(数量); ?></th>
                                <th><?php e(发现人); ?></th>
                                <th><?php e(发现地点); ?></th>
                                <th><?php e(班别); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($data as $k => $v): ?>
                                <tr index="<?php e($i++); ?>">
                                    <td>
                                        <div class="checkbox"><label><input type="checkbox" name="id[]"
                                                                            value="<?php e($v->check_log_id); ?>"></label>
                                        </div>
                                    </td>
                                    <td><?php e(u2d($v->created)); ?></td>
                                    <td><a href="<?php e($v->img_url); ?>" target="_blank"><img
                                                    src="<?php e($v->img_url); ?>"
                                                    style="width:100px;height: 100px"/></a></td>
                                    <td><?php e($v->item_name); ?></td>
                                    <td><?php e($v->nums); ?></td>
                                    <td><?php e($v->realname); ?></td>
                                    <td><?php e($v->place_name); ?></td>
                                    <td><?php e($v->team_name); ?></td>
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
F
<script>
    $(document).ready(function () {
        laydate.render({
            elem: '#date_range'
            , range: ','
            , format: 'yyyy-MM-dd'
            , theme: '#1890fe'
            , trigger: 'click'
            , done: function (value, date) {
                if (value == "") {
                    $("#option4").attr("checked", true);
                } else {
                    $("input[name='date']").attr("checked", false);
                    $("input[name='date']").parent().removeClass("active");
                }

            }
        });
        $("input[name='date']").parent().click(function () {
            $('#date_range').val('');
        });

        $('#frmCheck').on('ifClicked', function (event) {
            if ($(this).is(':checked')) {
                $('.checkbox').iCheck('uncheck');
            } else {
                $('.checkbox').iCheck('check');
            }
        });

    });
</script>
</body>
</html>
