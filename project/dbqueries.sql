SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `practice_project_alldata`;
CREATE TABLE `practice_project_alldata` (
    `userid` int(11) NOT NULL,
    `sheetid` int(11) NOT NULL,
    `username` varchar(64) NOT NULL,
    `email` varchar(64) NOT NULL,
    `pword` text NOT NULL,
    `sheetname` varchar(64) NOT NULL,
    `description` text,
    `changes` enum('Y', 'N') NOT NULL,
    `duplicate` enum('D'),
    `start_date` datetime NOT NULL,
    `stop_date` datetime NOT NULL,
    `timezone` time NOT NULL,
    `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `practice_project_users`;
CREATE TABLE `practice_project_users` (
    `userid` int(11) NOT NULL,
    `username` varchar(64) NOT NULL,
    `email` varchar(64) NOT NULL,
    `pword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `practice_project_sheetdata`;
CREATE TABLE `practice_project_sheetdata` (
    `sheetid` int(11) NOT NULL,
    `sheetname` int(11) NOT NULL,
    `desription` text, 
    `changes` enum('Y', 'N') NOT NULL,
    `duplicate` enum('D'),
    `start_date` datetime NOT NULL,
    `stop_date` datetime NOT NULL,
    `timezone` time NOT NULL,
    `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `practice_project_users` 
    ADD PRIMARY KEY (`userid`),
    ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `practice_project_alldata`
    ADD PRIMARY KEY (`userid`),
    ADD KEY `fk_sheetID` (`sheetid`);

ALTER TABLE `practice_project_sheetdata`
    ADD PRIMARY KEY ('sheetid');

ALTER TABLE `practice_project_alldata`
    MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `practice_project_sheetdata`
    MODIFY `sheetid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `practice_project_users`
    MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;
-- DROP TABLE IF EXISTS `cois3420_project_timezones`;
-- CREATE TABLE `cois3420_project_timezones` (
--     `ID` int(11) NOT NULL,
--     `timezone` time NOT NULL,
--     `time` time NOT NULL
-- )ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERT INTO `cois3420_project_timezones` (`ID`, `timezone`, `time`) VALUES
-- ()
