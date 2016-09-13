-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 13 2016 г., 12:46
-- Версия сервера: 5.5.48
-- Версия PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `new_test2_tests`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;