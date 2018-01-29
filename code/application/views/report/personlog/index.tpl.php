<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php e($page_title); ?> - <?php e($page_subtitle); ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php e($base_css); ?>

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
                                <div class="input-group">
                                    <input type="text" id="check_user_id" placeholder="选择用户"
                                           class="input-sm form-control input-s-sm inline">
                                    <input type="hidden" id="check_user_id_val" name="check_user_id"/>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-white dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
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
                                <th><?php e(工资号); ?></th>
                                <th><?php e(姓名); ?></th>
                                <th><?php e(品名); ?></th>
                                <th><?php e(数量); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $k => $v): ?>
                                <tr index="0">
                                    <td><?php e($v->user->salary_no); ?></td>
                                    <td><?php e($v->user->realname); ?></td>
                                    <td><?php e($v->item_name); ?></td>
                                    <td><?php e($v->nums); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr index="0">
                                <td>总计</td>
                                <td></td>
                                <td></td>
                                <td><?php e($total); ?></td>
                            </tr>
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
        var user = $('#check_user_id').bsSuggest('init', {
            getDataMethod: "url",
            url: "/profile/user/?ajax=true",
            effectiveFields: ["realname", "salary_no"],
            searchFields: ["realname"],
            effectiveFieldsAlias: {realname: "姓名", salary_no: "工资号"},
            ignorecase: true,
            showHeader: true,
            showBtn: false,     //
            delayUntilKeyup: true, //
            idField: "check_user_id",
            keyField: "realname",
            clearable: true,
            listStyle: {
                "border-radius": "1px"
            },
            fnProcessData: function (json) {    // url 获取数据时，对数据的处理，作为 fnGetData 的回调函数
                console.log(json.data);

                var index, len, data = {value: []};
                if (!json || !json.data || json.data.length === 0) {
                    return false;
                }
                len = json.data.length;

                for (index = 0; index < len; index++) {
                    data.value.push(json.data[index]);
                }

                //字符串转化为 js 对象
                return data;
            }
        }).on('onDataRequestSuccess', function (e, result) {
            // console.log('onDataRequestSuccess: ', result);
        }).on('onSetSelectValue', function (e, keyword, data) {
            $('#check_user_id_val').val(keyword.id);
        }).on('onUnsetSelectValue', function () {
            console.log("onUnsetSelectValue");
        });

        // laydate.render({
        //     elem: '#date_range'
        //     , range: ','
        //     , format: 'yyyy-MM-dd'
        //     , theme: '#1890fe'
        //     , trigger: 'click'
        //     , done: function (value, date) {
        //         if (value == "") {
        //             $("#option4").attr("checked", true);
        //         } else {
        //             $("input[name='date']").attr("checked", false);
        //             $("input[name='date']").parent().removeClass("active");
        //         }
        //
        //     }
        // });
        // $("input[name='date']").parent().click(function () {
        //     $('#date_range').val('');
        // });
        //
        // $('#frmCheck').on('ifClicked', function (event) {
        //     if($(this).is(':checked')) {
        //         $('.checkbox').iCheck('uncheck');
        //     }else{
        //         $('.checkbox').iCheck('check');
        //     }
        // });

    });
</script>
</body>
</html>
