<div class="panel-heading">
    <!-- 搜索框 -->
    <form action="" method="GET" enctype="multipart/form-data" role="form">
        <div class="navbar-form navbar-right">
            <div class="form-group">
                <input type="text" class="form-control" name="log_message_top" id="log_message_top"
                       placeholder="日志内容搜索查询" style="height: 20px;">
                <button type="submit" class="btn btn-default">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
        <!-- 分页 -->
        <?= $page_html; ?>
        <!-- 设置按钮 -->
        <a id="modal-474415" href="#modal-container-474415" role="button" class="btn btn-warning" data-toggle="modal">
            <i class="glyphicon glyphicon-cog"></i>
        </a>
        <button class="update_log btn btn-warning">
            <i class="glyphicon glyphicon-refresh"></i>
        </button>
        <!-- 设置显示 -->
        <p class="text-right">
            <strong>request主键ID大于范围搜索：</strong>
            <small><?= $this->key_request_id_value ? "<span class='tip'>大于 {$_GET['key_request_id_value']}</span>" : '未设置'; ?></small>
            &nbsp;&nbsp;
            <strong>日志内容搜索查询：</strong>
            <small><?= $this->message ? "<span class='tip'>{$this->message}</span>" : '未设置'; ?></small> &nbsp;&nbsp;
            <strong>请求耗时超标设置：</strong>
            <small><span class='tip'><?= $this->key_time_out_value; ?>s</span></small> &nbsp;&nbsp;
            <strong>请求时间范围搜索：</strong> <em>开始 - </em>
            <small><?= !empty($_GET['log_datetime_start']) ? "<span class='tip'>" . date("Y-m-d H:i:s", strtotime($_GET['log_datetime_start'])) . "</span>" : "<span class='tip'>{$this->default_time_show}</span>"; ?></small>
            <em>结束 - </em>
            <small><?= $this->log_datetime_end ? "<span class='tip'>" . date("Y-m-d H:i:s", strtotime($_GET['log_datetime_end'])) . "</span>" : '未设置'; ?></small>
            &nbsp;&nbsp;
            <strong>筛选请求编号设置：</strong>
            <small><?= $this->reqnum ? "<span class='tip'>{$_GET['reqnum']}</span>" : '未设置'; ?></small> &nbsp;&nbsp;
            <strong>筛选用户账号设置：</strong>
            <small><?= $this->username ? "<span class='tip'>{$_GET['username']}</span>" : '未设置'; ?></small> &nbsp;&nbsp;
            <strong>筛选手机号设置：</strong>
            <small><?= $this->mobile ? "<span class='tip'>{$_GET['mobile']}</span>" : '未设置'; ?></small> &nbsp;&nbsp;
            <strong>筛选api请求URL设置：</strong>
            <small><?= $this->r_url ? "<span class='tip'>{$mod} - " . $_GET['r_url'] . "</span>" : '未设置'; ?></small>
            &nbsp;&nbsp;
        </p>
        <!-- 设置面板 -->
        <div class="modal fade" id="modal-container-474415" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">
                            设置操作选项
                        </h4>
                    </div>
                    <div class="form-horizontal">
                        <div class="modal-body">
                            <!-- 表单提交 -->
                            <div class="form-group">
                                <label for="key_request_id_value"
                                       class="col-sm-4 control-label">request主键ID大于范围搜索：</label>
                                <div class="col-sm-6">
                                    <input type="number" name="key_request_id_value" id="key_request_id_value"
                                           class="form-control" placeholder="请输入log主键ID或当前第一条log主键ID搜索"
                                           value="<?= !empty($_GET['key_request_id_value']) ? $_GET['key_request_id_value'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="key_time_out_value_label"
                                       class="col-sm-4 control-label">请求耗时超标设置(毫秒ms)：</label>
                                <div class="col-sm-6">
                                    <input type="number" name="key_time_out_value" id="key_time_out_value"
                                           class="form-control" placeholder="默认为200毫秒(ms) 200毫秒(ms)=0.2秒(s)"
                                           value="<?= !empty($_GET['key_time_out_value']) ? $_GET['key_time_out_value'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="log_datetime" class="col-sm-4 control-label">记录时间范围搜索：</label>
                                <div class="col-sm-6">
                                    开始
                                    <input type="datetime-local" name="log_datetime_start" id="log_datetime_start"
                                           class="form-control"
                                           value="<?= !empty($_GET['log_datetime_start']) ? $_GET['log_datetime_start'] : $this->default_time_show; ?>">
                                    截止
                                    <input type="datetime-local" name="log_datetime_end" id="log_datetime_end"
                                           class="form-control"
                                           value="<?= !empty($_GET['log_datetime_end']) ? $_GET['log_datetime_end'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reqnum" class="col-sm-4 control-label">
                                    筛选请求编号设置：
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="reqnum" id="reqnum" class="form-control"
                                           placeholder="请填写请求编号"
                                           value="<?= !empty($_GET['reqnum']) ? $_GET['reqnum'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-4 control-label">
                                    筛选用户账号设置：
                                </label>
                                <div class="col-sm-6">
                                    eg:1092917203
                                    <input type="number" name="username" id="username" class="form-control"
                                           placeholder="请填写用户账号,过滤其它用户。"
                                           value="<?= !empty($_GET['username']) ? $_GET['username'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="col-sm-4 control-label">筛选手机号设置：</label>
                                <div class="col-sm-6">
                                    <input type="number" name="mobile" id="mobile" class="form-control"
                                           placeholder="请填写手机号"
                                           value="<?= !empty($_GET['mobile']) ? $_GET['mobile'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="r_url" class="col-sm-4 control-label">
                                    筛选api请求URL设置：
                                </label>
                                <div class="col-sm-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="checked" name="mod" value="LIKE">
                                            模糊匹配
                                        </label>
                                        <label>
                                            <input type="radio" name="mod" value="WHERE">
                                            字段全文检索
                                        </label>
                                    </div>
                                    <input type="text" name="r_url" id="r_url" class="form-control"
                                           placeholder="api请求URL"
                                           value="<?= !empty($_GET['r_url']) ? $_GET['r_url'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-inverse" data-dismiss="modal">
                                关闭
                            </button>
                            <button id="reset" type="reset" class="btn btn-danger">重置</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>