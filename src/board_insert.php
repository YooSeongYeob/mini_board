<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
define( "URL_HEADER", SRC_ROOT."board_header.php" );
include_once( URL_DB );

$http_method = $_SERVER["REQUEST_METHOD"];

if( $http_method === "POST")
{
    $arr_post = $_POST;
    $result_cnt = insert_board_info( $arr_post);
    header( "Location: board_list.php" );
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel='stylesheet' href='../src/css/common.css'>
    <title>게시글 작성</title>
    
</head>
<body>
<?php include_once( URL_HEADER ); ?>  
<!-- 인크루드를 하기 위한 작업 -->

<form class= "inven_board" method="post" action="board_insert.php">
       
        <div class= "insert_board1">
		<label class="p-3 mb-2 bg-success text-white"  for="title">게시글 제목 </label>
		<input class= "title_1" type="text" name="board_title" id="title">
        </div>

        <br>

        <div class= "insert_board2">
		<label class="p-3 mb-2 bg-success text-white"  for="contents">게시글 내용 </label>
		<input class= "contents_1" type="text" name="board_contents" id="contents">
        </div>

        <br>

		<button type="submit" class="btn btn-outline-warning">작성</button>
		
        <button type="button" class="btn btn-outline-warning">
        <a href="board_list.php">취소</a></button>

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>