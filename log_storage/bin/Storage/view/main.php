<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户轨迹日志查看</title>
    <link rel="stylesheet" type="text/css" href="./link/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./link/css/page.css">
    <link rel="stylesheet" type="text/css" href="./link/css/style.css">
</head>
<body>
<!-- 标题 -->
<div class="page-header">
    <h1 class="text-center">
        用户轨迹
        <small>日志查看</small>
    </h1>
</div>
<div class="panel panel-default" style="width: 90%;margin:0 auto;">
    <?= $panel_html; ?>
</div>
<pre id="data_for_sql" style="display: none;"><?= $data_for_sql; ?></pre>
</body>
<script type="text/javascript">
    var request_id_value = '<?= $this->request_max_id; ?>';
    var log_url = '<?= $this->config['log_url']; ?>';
    var default_time = "<?= date("Y-m-d\TH:i",intval($this->default_time)); ?>";
</script>
<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
<script type="text/javascript" src="./link/js/jquery.min.js"></script>
<!-- 包括所有已编译的插件 -->
<script type="text/javascript" src="./link/js/bootstrap.min.js"></script>
<!-- js -->
<script type="text/javascript" src="./link/js/index.js"></script>
</html>
