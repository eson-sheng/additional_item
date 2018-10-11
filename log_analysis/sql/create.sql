-- 日志查看行数存储
DROP TABLE IF EXISTS `mynote_indexfile`;
CREATE TABLE IF NOT EXISTS `mynote_indexfile` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `indexfile_path` varchar(128) NOT NULL COMMENT '日志绝对路径',
  `last_end_index` varchar(128) NOT NULL COMMENT '日志读取行数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='日志查看行数存储';

ALTER TABLE `mynote_indexfile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `indexfile_path` (`indexfile_path`);

ALTER TABLE `mynote_indexfile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';COMMIT;

-- mynote日志表
DROP TABLE IF EXISTS `mynote_log`;
CREATE TABLE IF NOT EXISTS `mynote_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `datetime` varchar(15) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `reqnum` varchar(20) DEFAULT NULL,
  `message` text,
  `logger` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `mynote_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reqnum` (`reqnum`),
  ADD KEY `id` (`id`);

ALTER TABLE `mynote_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

-- 登录记录表
DROP TABLE IF EXISTS `mynote_login`;
CREATE TABLE IF NOT EXISTS `mynote_login` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `datetime` varchar(15) DEFAULT NULL,
  `reqid` varchar(100) DEFAULT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `sessionid` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `mynote_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reqid` (`reqid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `id` (`id`);

ALTER TABLE `mynote_login`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

-- 请求记录表
DROP TABLE IF EXISTS `mynote_request`;
CREATE TABLE IF NOT EXISTS `mynote_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reqnum` varchar(20) DEFAULT NULL,
  `uri` varchar(1024) DEFAULT NULL,
  `sessionid` varchar(40) DEFAULT NULL,
  `params` text,
  `time` varchar(20) DEFAULT NULL,
  `req_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `mynote_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reqnum` (`reqnum`),
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `uri` (`uri`(255)),
  ADD KEY `id` (`id`);

ALTER TABLE `mynote_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;