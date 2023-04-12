


<?php
	define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
	define( "URL_DB", SRC_ROOT."common/db_common.php" );
	include_once( URL_DB );

 	// 상수를 여러 개 넣으면 에러가 난다.

	// GET 체크
	if( array_key_exists( "page_num", $_GET ) )
	{
		$page_num = $_GET["page_num"];
	}
	else
	{
		$page_num = 1;
	}

	$limit_num = 5;

	// 게시판 정보 테이블 전체 카운트 획득
	$result_cnt = select_board_info_cnt();

	// max page number
	$max_page_num = ceil( (int)$result_cnt[0]["cnt"] / $limit_num );

	// offset
	$offset = ( $page_num * $limit_num ) - $limit_num;

	$arr_prepare =
		array(
			"limit_num"	=> $limit_num
			,"offset"	=> $offset
		);

	// 페이징용 데이터 검색
	$result_paging = select_board_info_paging( $arr_prepare );
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

<!-- </head>mini_board\src\css\common.css -->

<body>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">로스트아크 인벤</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">EVENT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">자유게시판</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">직업게시판</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">질문과 답변</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	
	<div class="p-3 mb-2 bg-success text-white">
		<table class='table table-striped'>
			<thead>
				<tr>
					<th class="p-3 mb-2 bg-success text-white">게시글 번호</th>
					<th class="p-3 mb-2 bg-success text-white">게시글 제목</th>
					<th class="p-3 mb-2 bg-success text-white">작성일자</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach( $result_paging as $recode )
					{
				?>
						<tr>
							<td  class="p-3 mb-2 bg-light text-dark"><?php echo $recode["board_no"] ?></td>
							<td  class="p-3 mb-2 bg-light text-dark"><a href="board_detail.php?board_no=<?php echo $recode["board_no"] ?>"><?php echo $recode["board_title"] ?></a></td>
							<td  class="p-3 mb-2 bg-light text-dark"><?php echo $recode["board_write_date"] ?></td>
						</tr> 
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<div>
		<!-- 페이징 번호 -->
		<?php
			for( $i = 1; $i <= $max_page_num; $i++ )
			{
		?>
				<a href='board_list.php?page_num=<?php echo $i ?>' class='btn btn-outline-warning'><?php echo $i ?></a>
		<?php
			}
		?>
	</div>

</body>
</html>
