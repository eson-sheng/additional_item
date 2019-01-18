-- mynote日志表
DROP TABLE IF EXISTS `mynote_log`;
CREATE TABLE IF NOT EXISTS `mynote_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `datetime` varchar(30) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `reqnum` varchar(20) DEFAULT NULL,
  `message` text,
  `logger` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `mynote_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reqnum` (`reqnum`),
  ADD KEY `id` (`id`);

ALTER TABLE `mynote_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;