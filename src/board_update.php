<?php
	define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
	define( "URL_DB", SRC_ROOT."common/db_common.php" );
	include_once( URL_DB );
	
	// Request Method를 획득
	$http_method = $_SERVER["REQUEST_METHOD"];

	// GET 일때
	if( $http_method === "GET" )
	{
		$board_no = 1;
		if( array_key_exists( "board_no", $_GET ) )
		{
			$board_no = $_GET["board_no"];
		}
		$result_info = select_board_info_no( $board_no );
	}
	// POST 일때
	else
	{
		$arr_post = $_POST;
		$arr_info =
			array(
				"board_no" => $arr_post["board_no"]
				,"board_title" => $arr_post["board_title"]
				,"board_contents" => $arr_post["board_contents"]
			);
		
		// update
		$result_cnt = update_board_info_no( $arr_info );
		
		// select
		// $result_info = select_board_info_no( $arr_post["board_no"] ); // 0412 del
		
		header( "Location: board_detail.php?board_no=".$arr_post["board_no"] );
		exit(); // 해당 행에서 redirect 했기 때문에 이후의 소스코드는 실행할 필요가 없다. 
		// exit 밑으로는 실행 안 함 이 밑의 코드는 실행이 안 됨 다른 화면으로 넘어갈 거기 때문임.
		// 리다이렉트 방법 여러가지 있음 그 중 하나가 헤더 
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
	<title>게시판</title>
</head>
<body>

	<form method="post" action="board_update.php">
		<label class="p-3 mb-2 bg-success text-white"  for="bno">게시글 번호 : </label>
		<input type="text" name="board_no" id="bno" value="<?php echo $result_info["board_no"] ?>" readonly>
		<br>
		<label class="p-3 mb-2 bg-success text-white"  for="title">게시글 제목 : </label>
		<input type="text" name="board_title" id="title" value="<?php echo $result_info["board_title"] ?>">
		<br>
		<label class="p-3 mb-2 bg-success text-white"  for="contents">게시글 내용 : </label>
		<input type="text" name="board_contents" id="contents" value="<?php echo $result_info["board_contents"] ?>">
		<br>
		<button type="submit" class="p-3 mb-2 bg-light text-dark">수정</button>
		<button type="button" class="p-3 mb-2 bg-light text-dark"><a href= "board_detail.php?board_no=<?php echo $result_info["board_no"] ?>">
		취소
		</a>
		</button>
	</form>
	<button type="button" class="p-3 mb-2 bg-light text-dark"><a href= "board_list.php">목록</a></button>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>