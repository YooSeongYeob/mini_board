<?php
    //업데이트 파일과 디테일 파일을 한 파일 안에 만들 수 있음
    // 인풋만 수정 주기 때문임 이프나 자바스크립트로 구현
    // 한 페이지로 상세페이지와 업데이트 페이지를 구현
    // 디테일과 업데이트를 따로따로 만들 수도 있음.
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
	define( "URL_DB", SRC_ROOT."common/db_common.php" );
	include_once( URL_DB );

    // Request Parameter 획득(GET)
    $arr_get = $_GET; // 겟 파라미터를 담아서 언더바 겟을 쓰기가 바로 쓰기
    //무서워서 변수를 줌

    // DB에서 게시글 정보 획득
    $result_info = select_board_info_no( $arr_get["board_no"] )

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<body>
    <div>
        <p>게시글 번호 :   <?php echo $result_info["board_no"]?></p>
        <p>게시글 작성일 : <?php echo $result_info["board_write_date"]?></p>
        <p>게시글 제목 :   <?php echo $result_info["board_title"]?></p>
        <p>게시글 내용 :   <?php echo $result_info["board_contents"]?></p>
    </div>

    <button type="button"><a href="board_update.php?board_no= <?php echo $result_info["board_no"]?>" >
    수정
    </a>
    </button>
    
    <button type="button">
    <a href="board_delete.php?board_no=<?php echo $result_info["board_no"]?>">
    삭제
    </a>
    </button>
    
    <!-- DELETE FROM 테이블명 WHERE = 컬럼; -->
</body>
</html>

