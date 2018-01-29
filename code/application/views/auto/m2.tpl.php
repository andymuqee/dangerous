<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>控制器创建第一步</title>
</head>

<body>
<form id="form1" name="form1" method="post"
      action="/auto/mqmake/m3">
    <div>
        <h1>建立模型第二步</h1>
        <div>
            <label>模型名：<?php echo $table_name; ?></label> <input type="hidden"
                                                                 name="table_name" value="<?php echo $table_name; ?>"/>
        </div>
        <div>
            <label for="key_name">主键：</label> <select id="key_name"
                                                      name="key_name">
                <option value="0" selected="selected">选择主键</option>
                <?php foreach ($fields as $v): ?>
                    <option value="<?php echo $v['COLUMN_NAME']; ?>"><?php echo $v['COLUMN_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="primary_name">主名：</label> <select id="primary_name"
                                                          name="primary_name">
                <option value="0" selected="selected">选择主名</option>
                <?php foreach ($fields as $v): ?>
                    <option value="<?php echo $v['COLUMN_NAME']; ?>"><?php echo $v['COLUMN_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>字段：</label>
            <?php for ($i = 0; $i < count($fields); $i++): ?>
                <input type="checkbox"
                       name="property[<?php echo $i; ?>][COLUMN_NAME]" checked="checked"
                       value="<?php echo $fields[$i]['COLUMN_NAME']; ?>"><?php echo $fields[$i]['COLUMN_NAME']; ?></input>
                <input type="hidden"
                       name="property[<?php echo $i; ?>][COLUMN_COMMENT]" checked="checked"
                       value="<?php echo $fields[$i]['COLUMN_COMMENT']; ?>"/> <input
                        type="hidden" name="property[<?php echo $i; ?>][DATA_TYPE]"
                        checked="checked" value="<?php echo $fields[$i]['DATA_TYPE']; ?>"/>
            <?php endfor; ?>
        </div>
        <div>
            <input type="button" value="返回" onclick="javascript:history.go(-1);"/><input
                    type="submit" value="下一步"/>
        </div>

</form>
</body>
</html>