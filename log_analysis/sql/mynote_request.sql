-- 请求记录表
DROP TABLE IF EXISTS `mynote_request`;
CREATE TABLE IF NOT EXISTS `mynote_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reqnum` varchar(20) DEFAULT NULL,
  `uri` varchar(1024) DEFAULT NULL,
  `sessionid` varchar(40) DEFAULT NULL,
  `params` longtext,
  `time` varchar(30) DEFAULT NULL,
  `req_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `mynote_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reqnum` (`reqnum`),
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `uri` (`uri`(255)),
  ADD KEY `id` (`id`);

ALTER TABLE `mynote_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;