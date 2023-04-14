<?php
// CREATE DATABASE board;

// USE board;

// CREATE TABLE board_info(
// 	board_no INT PRIMARY KEY AUTO_INCREMENT
// 	,board_title VARCHAR(100) NOT NULL
// 	,board_contents VARCHAR(1000) NOT NULL
// 	,board_write_date DATETIME NOT NULL
// 	,board_del_flg CHAR(1) DEFAULT('0') NOT NULL
// 	,board_del_date DATETIME
// );

// <<<<<<< HEAD
// DESC board_info;
// =======
// <<<<<<< HEAD
// DESC board_info;
// =======
// DESC board_info;


// ALTER TABLE board_info MODIFY board_del_flg CHAR(1) DEFAULT('0') NOT NULL;
// DELETE FROM table board_wirte_Date;

// ALTER TABLE board_info CHANGE board_wirte_date board_write_date DATETIME NOT NULL;


// INSERT INTO board_info (
// 	 board_title
// 	,board_contents
// 	,board_write_date
// )
// VALUES(
// 	'제목1'
// 	,'내용1'
// 	,NOW()
// )
// , (
// 	'제목2'
// 	,'내용2'
// 	,NOW()
// )
// , (
// 	'제목3'
// 	,'내용3'
// 	,NOW()
// )
// , (
// 	'제목4'
// 	,'내용4'
// 	,NOW()
// )
// , (
// 	'제목5'
// 	,'내용5'
// 	,NOW()
// )
// , (
// 	'제목6'
// 	,'내용6'
// 	,NOW()
// )
// , (
// 	'제목7'
// 	,'내용7'
// 	,NOW()
// )
// , (
// 	'제목8'
// 	,'내용8'
// 	,NOW()
// ), (
// 	'제목9'
// 	,'내용9'
// 	,NOW()
// ), (
// 	'제목10'
// 	,'내용10'
// 	,NOW()
// ), (
// 	'제목11'
// 	,'내용11'
// 	,NOW()
// ), (
// 	'제목12'
// 	,'내용12'
// 	,NOW()
// ), (
// 	'제목13'
// 	,'내용13'
// 	,NOW()
// ), (
// 	'제목14'
// 	,'내용14'
// 	,NOW()
// ), (
// 	'제목15'
// 	,'내용15'
// 	,NOW()
// ), (
// 	'제목16'
// 	,'내용16'
// 	,NOW()
// ), (
// 	'제목17'
// 	,'내용17'
// 	,NOW()
// ), (
// 	'제목18'
// 	,'내용18'
// 	,NOW()
// )
// , (
// 	'제목19'
// 	,'내용19'board_info
// 	,NOW()
// ), (
// 	'제목20'
// 	,'내용20'
// 	,NOW()
// );


// SELECT 
// 	 board_no
// 	,board_title
// 	,board_write_date
// FROM 
//  board_info
// WHERE 
//  board_del_flg  = 'o'
// ORDER BY 
//  board_no ASC 
// LIMIT 5 OFFSET 0
// ;
// UPDATE board_info 
// SET board_del_date = NULL;

// COMMIT;
// rollback;
// flush PRIVILEGES;

// UPDATE board_info
// SET board_del_flg = 0
// WHERE board_no = 24;
?>
