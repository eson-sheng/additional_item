<div class="panel-footer">
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
        <small><?= $this->r_url ? "<span class='tip'>{$this->mod} - " . $_GET['r_url'] . "</span>" : '未设置'; ?></small>
        &nbsp;&nbsp;
    </p>
    <!-- 设置按钮 -->
    <a id="modal-474415" href="#modal-container-474415" role="button" class="btn btn-warning" data-toggle="modal"><i
                class="glyphicon glyphicon-cog"></i></a>
    <button class="update_log btn btn-warning"><i class="glyphicon glyphicon-refresh"></i></button>
    <!-- 搜索框 -->
    <div class="navbar-form navbar-right">
        <div class="form-group">
            <input type="text" class="form-control" name="log_message_bottom" id="log_message_bottom"
                   placeholder="日志内容搜索查询" style="height: 20px;">
            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
        </div>
        </form>
    </div>
    <!-- 分页 -->
    <?= $page_html; ?>
</div>