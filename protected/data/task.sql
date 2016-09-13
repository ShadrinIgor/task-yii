-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `deffer` datetime DEFAULT NULL,
  `type` tinyint(2) DEFAULT NULL,
  `task` varchar(45) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `data` text,
  `status` tinyint(2) DEFAULT NULL,
  `retries` tinyint(2) DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `result` text
) ENGINE=InnoDB AUTO_INCREMENT=2971221 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `account_id`, `created`, `deffer`, `type`, `task`, `action`, `data`, `status`, `retries`, `finished`, `result`) VALUES
(2971107, 83992, '0000-00-00 00:00:00', NULL, NULL, 'domain', 'addzone', '{"domain":"mydomain.ru"}', 0, 0, NULL, ''),
(2971122, 9608, '0000-00-00 00:00:00', NULL, NULL, 'integration', 'process', '{"integration_id":2987,"lead_id":"2999570"}', 0, 0, NULL, ''),
(2971123, 9608, '0000-00-00 00:00:00', NULL, NULL, 'integration', 'process', '{"integration_id":2845,"lead_id":"2999571"}', 0, 0, NULL, ''),
(2971187, 81259, '0000-00-00 00:00:00', NULL, NULL, 'account', 'bill', '{"bill_id":"82029"}', 0, 0, NULL, ''),
(2971206, 80034, '0000-00-00 00:00:00', NULL, NULL, 'message', 'sms', '{"number":"89111111119","message":"Заявка с ru.ru\\nвячеслав \\n"}', 0, 0, NULL, ''),
(2971220, 70748, '0000-00-00 00:00:00', NULL, NULL, 'integration', 'process', '{"integration_id":3312,"lead_id":"2999670"}', 0, 0, NULL, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `deffer` (`deffer`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2971221;