<div class="panel-body" style="padding: 0">
    <!-- 表格 -->
    <?php if (!empty($data)): ?>
        <table class="table table-bordered table-hover table-condensed">
            <thead style="width: 90%;margin: 0 auto;">
            <tr>
                <!-- /*定义字段个数*/ -->
                <?php $field_num = 0; ?>
                <?php foreach ($data[0] as $key => $value): ?>
                    <?php if (!is_int($key) && !in_array($key, $this->field_arr)): ?>
                        <th>
                            <!-- /*增量字段个数*/ -->
                            <?php $field_num++; ?>
                            <!-- /*表头输出*/ -->
                            <?= $key; ?>
                        </th>
                    <?php endif ?>
                <?php endforeach ?>
            </tr>
            </thead>
            <tbody>
            <!-- /*数组升序处理*/ -->
            <?php $data = array_reverse($data); ?>
            <?php foreach ($data as $key => $value): ?>
                <?php if ($key != 0 && $data[$key]['请求编号'] == $data[$key - 1]['请求编号']): ?>

                    <?php if (!empty($value['log主键ID'])): ?>
                        <tr class="success">
                            <?php foreach ($value as $k => $v): ?>
                                <?php if (!is_int($k) && !in_array($k, $this->field_arr)): ?>
                                    <!-- 毫秒时间戳显示 -->
                                    <?php if ($k === '记录时间' && $v): ?>
                                        <td>
                                            <?php date("Y-m-d H:i:s", intval($v)); ?>
                                            <?php substr($v, 11, 15); ?>
                                            <?= $v; ?>
                                        </td>
                                    <?php else: ?>
                                        <td>
                                            <!-- /*请求消耗时间超标红色显示*/ -->
                                            <?php if ($k === '请求消耗时间'): ?>
                                                <?php if (floatval($v) > $this->key_time_out_value): ?>
                                                    <span style="color:red;"><?= floatval($v); ?>s</span>
                                                <?php else: ?>
                                                    <span><?= floatval($v); ?>s</span>
                                                <?php endif ?>
                                            <?php else: ?>
                                                <?= $v ?>
                                            <?php endif ?>
                                        </td>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tr>
                        <tr class="info">
                            <?php foreach ($value as $k => $v): ?>
                                <?php if ($k === '记录内容'): ?>
                                    <td colspan="<?= $field_num; ?>">
                                        <?php if ($this->message): ?>
                                            <?php $v = str_replace($this->message, "<span class='tip'>{$this->message}</span>", htmlspecialchars($v)); ?>
                                            <p class="rizhi"
                                               style="white-space: pre-line;"><?= str_replace("\\n", '<br>', $v); ?></p>
                                        <?php else: ?>
                                            <p class="rizhi"
                                               style="white-space: pre-line;"><?= str_replace("\\n", '<br>', htmlspecialchars($v)); ?></p>
                                        <?php endif ?>
                                    </td>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tr>
                    <?php endif ?>

                <?php else: ?>

                    <tr>
                        <td colspan="<?= $field_num; ?>"></td>
                    </tr>
                    <tr class="default" style="background-color:  #ffe5e5;">
                        <td colspan="<?= $field_num; ?>">
                            <?php foreach ($value as $k => $v): ?>
                                <?php if (in_array($k, $this->online_arr) && $k !== 0): ?>
                                    <!-- /*请求消耗时间超标红色显示*/ -->
                                    <?php if ($k === '请求消耗时间'): ?>
                                        <?php if (floatval($v) > $this->key_time_out_value): ?>
                                            <?= $k ?> : <span style="color:red;"><?= floatval($v); ?>s</span>
                                        <?php else: ?>
                                            <span><?= $k ?> : <?= floatval($v); ?>s</span> &nbsp;&nbsp;
                                        <?php endif ?>
                                    <?php else: ?>
                                        <?php if ($k === '请求时间'): ?>
                                            <br><?= $k ?> : <?= $v; ?>
                                        <?php else: ?>
                                            <span class="rizhi"><?= $k ?> : <?= $v ?></span> &nbsp;&nbsp;
                                        <?php endif ?>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </td>
                    </tr>

                    <?php if (!empty($value['GET参数'])): ?>
                        <tr class="warning">
                            <?php foreach ($value as $k => $v): ?>
                                <?php if ($k === 'GET参数'): ?>
                                    <td colspan="<?= $field_num; ?>">
                                        <p class="rizhi"
                                           style="white-space: pre;"><?= htmlentities(urldecode($v)); ?></p>
                                    </td>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tr>
                    <?php endif ?>

                    <?php if (!empty($value['log主键ID'])): ?>
                        <tr class="success">
                            <?php foreach ($value as $k => $v): ?>
                                <?php if (!is_int($k) && !in_array($k, $this->field_arr)): ?>
                                    <!-- 毫秒时间戳显示 -->
                                    <?php if ($k === '记录时间' && $v): ?>
                                        <td>
                                            <?= $v; ?>
                                        </td>
                                    <?php else: ?>
                                        <td>
                                            <!-- /*请求消耗时间超标红色显示*/ -->
                                            <?php if ($k === '请求消耗时间s'): ?>
                                                <?php if (floatval($v) > $this->key_time_out_value): ?>
                                                    <span style="color:red;"><?= floatval($v); ?></span>
                                                <?php else: ?>
                                                    <span><?= floatval($v); ?></span>
                                                <?php endif ?>
                                            <?php else: ?>
                                                <?= $v ?>
                                            <?php endif ?>
                                        </td>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tr>
                        <tr class="info">
                            <?php foreach ($value as $k => $v): ?>
                                <?php if ($k === '记录内容'): ?>
                                    <td colspan="<?= $field_num; ?>">
                                        <?php if ($this->message): ?>
                                            <?php $v = str_replace($this->message, "<span class='tip'>{$this->message}</span>", htmlspecialchars($v)); ?>
                                            <p class="rizhi"
                                               style="white-space: pre-line;"><?= str_replace("\\n", '<br>', $v); ?></p>
                                        <?php else: ?>
                                            <p class="rizhi"
                                               style="white-space: pre-line;"><?= str_replace("\\n", '<br>', htmlspecialchars($v)); ?></p>
                                        <?php endif ?>
                                    </td>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tr>
                    <?php endif ?>

                <?php endif ?>

            <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <h1>未查找到日志记录!</h1>
    <?php endif ?>
</div>