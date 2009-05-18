-- phpMyAdmin SQL Dump
-- version 2.11.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2009 at 03:55 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `edduddiee`
--

-- --------------------------------------------------------

--
-- Table structure for table `todo_lists`
--

CREATE TABLE IF NOT EXISTS `todo_lists` (
  `ListID` int(20) NOT NULL auto_increment,
  `Title` varchar(255) NOT NULL,
  `Archive` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`ListID`),
  KEY `Archive` (`Archive`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `todo_tasks`
--

CREATE TABLE IF NOT EXISTS `todo_tasks` (
  `TaskID` int(255) NOT NULL auto_increment,
  `Text` varchar(255) NOT NULL,
  `Done` smallint(2) NOT NULL default '0',
  `Archive` smallint(1) NOT NULL default '0',
  `ListID` int(20) NOT NULL,
  PRIMARY KEY  (`TaskID`),
  KEY `Done` (`Done`,`Archive`,`ListID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
