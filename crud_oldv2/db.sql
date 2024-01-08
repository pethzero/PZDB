CREATE DATABASE IF NOT EXISTS testdb;

USE testdb;

CREATE TABLE `appointment` (
  `RECNO` int(11) NOT NULL,
  `CREATED` datetime DEFAULT NULL,
  `LASTUPD` datetime DEFAULT NULL,
  `STATUS` varchar(2) DEFAULT NULL,
  `CUST` int(11) DEFAULT NULL,
  `DOCNO` varchar(15) DEFAULT NULL,
  `CUSTNAME` varchar(250) DEFAULT NULL,
  `CONT` int(11) DEFAULT NULL,
  `CONTNAME` varchar(250) DEFAULT NULL,
  `EMAIL` varchar(200) DEFAULT NULL,
  `TEL` varchar(200) DEFAULT NULL,
  `ADDR` varchar(200) DEFAULT NULL,
  `LOCATION` varchar(3) DEFAULT NULL,
  `SUBJECT` varchar(150) DEFAULT NULL,
  `DETAIL` varchar(500) DEFAULT NULL,
  `REF` varchar(500) DEFAULT NULL,
  `PRIORITY` varchar(2) DEFAULT NULL,
  `TIMED` int(11) DEFAULT NULL,
  `TIMEH` int(11) DEFAULT NULL,
  `TIMEM` int(11) DEFAULT NULL,
  `STARTD` date DEFAULT NULL,
  `WARND` date DEFAULT NULL,
  `PRICECOST` decimal(18,2) DEFAULT NULL,
  `PRICEPWITHDRAW` decimal(18,2) DEFAULT NULL,
  `OWNER` int(11) DEFAULT NULL,
  `OWNERNAME` varchar(120) DEFAULT NULL,
  `REMARK` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`RECNO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `RECNO` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
