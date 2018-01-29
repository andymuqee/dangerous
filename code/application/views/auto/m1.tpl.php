<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>模型创建第一步</title>
</head>

<body>
<form id="form1" name="form1" method="post"
      action="/auto/mqmake/m2">
    <div>
        <h1>建立模型第一步</h1>
        <div>
            <label for="table_name">选择数据表：</label> <select name="table_name">
                <option value="0" selected="selected">选择表名</option>
                <?php foreach ($tbls as $k => $v): ?>
                    <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div>
        <input type="button" value="返回"
               onclick="javascript:window.location.href='/auto/mqmake'"/><input
                type="submit" value="下一步"/>
    </div>
</form>
</body>
</html>
