<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>控制器创建第一步</title>
</head>

<body>
<form id="form1" name="form1" method="post"
      action="/auto/mqmake/c3">
    <div>
        <h1>建立控制器第二步</h1>
        <div>
            <label for="class_name">资源名：</label> <input type="text"
                                                        id="class_name" name="class_name"
                                                        value="<?php echo $class_name; ?>"/>
            <label>模型名：<?php echo $model_name; ?></label> <input type="hidden"
                                                                 name="model_name" value="<?php echo $model_name; ?>"/>
        </div>
        <div>
            <label>POST必选：</label>
            <?php foreach ($property as $k => $k): ?>
                <input type="checkbox" name="POSTMUST[]" value="<?php echo $k; ?>"><?php echo $k; ?></input>
            <?php endforeach; ?>
        </div>
        <div>
            <label>POST可选：</label>
            <?php foreach ($property as $k => $k): ?>
                <input type="checkbox" name="POSTOPTIONAL[]"
                       value="<?php echo $k; ?>"><?php echo $k; ?></input>
            <?php endforeach; ?>
        </div>
        <div>
            <label>GET必选：</label>
            <?php foreach ($property as $k => $k): ?>
                <input type="checkbox" name="GETMUST[]" value="<?php echo $k; ?>"><?php echo $k; ?></input>
            <?php endforeach; ?>
        </div>
        <div>
            <label>GET可选：</label>
            <?php foreach ($property as $k => $k): ?>
                <input type="checkbox" name="GETOPTIONAL[]" value="<?php echo $k; ?>"><?php echo $k; ?></input>
            <?php endforeach; ?>
        </div>
        <div>
            <label>PUT必选：</label>
            <?php foreach ($property as $k => $k): ?>
                <input type="checkbox" name="PUTMUST[]" value="<?php echo $k; ?>"><?php echo $k; ?></input>
            <?php endforeach; ?>
        </div>
        <div>
            <label>PUT可选：</label>
            <?php foreach ($property as $k => $k): ?>
                <input type="checkbox" name="PUTOPTIONAL[]" value="<?php echo $k; ?>"><?php echo $k; ?></input>
            <?php endforeach; ?>
        </div>
        <div>
            <label for="DELETEMUST">DELETE：</label> <select id="DELETEMUST"
                                                            name="DELETEMUST">
                <option value="0" selected="selected">选择主键</option>
                <?php foreach ($property as $k => $k): ?>
                    <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div>
        <input type="button" value="返回" onclick="javascript:history.go(-1);"/><input
                type="submit" value="生成"/>
    </div>
</form>
</body>
</html>