<div class="panel-footer">
    <!-- 设置显示 -->
    <?= $func_html; ?>
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