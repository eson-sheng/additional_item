<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>报警单元测试</title>
</head>
<body>
    <div style="width:1200px;margin:80px auto;">
        <h1><span style="color:red;">警告！警告！</span>单元测试报警！</h1>
        <p>以下是日志描述，请查看：</p>
        <hr>
            <pre><?= $ret; ?></pre>
        <hr>
        <p>警告时间：<?= date("Y-m-d H:i:s",time()); ?></p>
    </div>
</body>
</html>