<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>控制器创建第一步</title>
</head>

<body>
<form id="form1" name="form1" method="post"
      action="/auto/mqmake/c2">
    <div>
        <h1>建立视图完成</h1>
    </div>
    <div>
        <input type="button" value="返回首页"
               onclick="javascript:window.location.href='/auto/mqmake'"/> <input
                type="button" value="创建新视图"
                onclick="javascript:window.location.href='/auto/mqmake/v1'"/> <input
                type="submit" value="返回上一步" onclick="javascript:history.go(-1);"/>
    </div>
</form>
</body>
</html>