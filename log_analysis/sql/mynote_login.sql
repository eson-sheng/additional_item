-- 登录记录表
DROP TABLE IF EXISTS `mynote_login`;
CREATE TABLE IF NOT EXISTS `mynote_login` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `datetime` varchar(30) DEFAULT NULL,
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