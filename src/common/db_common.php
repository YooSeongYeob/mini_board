<?php
// pdo를 이용해서 데이터베이스를 연결 mysql로도 사용 가능은 한데 
// 연습했던 것과는 다른 방향이라 비추천 한다고 하심.
// ---------------------------------
// 함수명	: db_conn
// 기능		: DB Connection
// 파라미터	: Obj	&$param_conn
// 리턴값	: 없음
// ---------------------------------
function db_conn( &$param_conn )
{
	$host = "localhost";
	$user = "root";
	$pass = "root506";
	$charset = "utf8mb4";
	$db_name = "board";
	$dns = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
	$pdo_option =
		array(
			PDO::ATTR_EMULATE_PREPARES		=> false
			,PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION
			,PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC
		);
	
	try
	{
		$param_conn = new PDO( $dns, $user, $pass, $pdo_option );
	}
	catch( Exception $e )
	{
		$param_conn = null;
		throw new Exception( $e->getMessage() );
	}
}

// ---------------------------------
// 함수명	: select_board_info_paging
// 기능		: 페이징_게시판 정보 검색
// 파라미터	: Array		&$param_arr
// 리턴값	: Array		$result
// ---------------------------------
function select_board_info_paging( &$param_arr )
{
	$sql =
		" SELECT "
		." 	board_no "
		." 	,board_title "
		." 	,board_write_date "
		." FROM "
		." 	board_info "
		." WHERE "
		." 	board_del_flg = '0' "
		." ORDER BY "
		." 	board_no DESC "
		." LIMIT :limit_num OFFSET :offset "
		;
	
	$arr_prepare =
		array(
			":limit_num"	=> $param_arr["limit_num"]
			,":offset"		=> $param_arr["offset"]
		);

	$conn = null;
	try
	{
		db_conn( $conn );
		$stmt = $conn->prepare( $sql );
		$stmt->execute( $arr_prepare );
		$result = $stmt->fetchAll();
	}
	catch( Exception $e )
	{
		return $e->getMessage();
	}
	finally
	{
		$conn = null;
	}

	return $result;
}

// ---------------------------------
// 함수명	: select_board_info_cnt
// 기능		: 게시판 정보 테이블 레코드 카운트 검색
// 파라미터	: 없음
// 리턴값	: Array		$result
// ---------------------------------
function select_board_info_cnt()
{
	$sql =
		" SELECT "
		." 		COUNT(*) cnt "
		." FROM "
		." 		board_info "
		." WHERE "
		." 		board_del_flg = '0' "
		;
	$arr_prepare = array();

	$conn = null;
	try
	{
		db_conn( $conn );
		$stmt = $conn->prepare( $sql );
		$stmt->execute( $arr_prepare );
		$result = $stmt->fetchAll();
	}
	catch( Exception $e )
	{
		return $e->getMessage();
	}
	finally
	{
		$conn = null;
	}

	return $result;
}


// ---------------------------------
// 함수명	: select_board_info_no
// 기능		: 게시판 특정 게시글 정보 검색
// 파라미터	: INT		&$param_no
// 리턴값	: Array		$result
// ---------------------------------
function select_board_info_no( &$param_no )
{
	$sql =
		" SELECT "
		." 	board_no "
		." 	,board_title "
		." 	,board_contents "
		." 	,board_write_date "// 230412 작성일 추가
		." FROM "
		." 	board_info "
		." WHERE "
		." 	board_no = :board_no "
		;
	
	$arr_prepare =
		array(
			":board_no"	=> $param_no
		);

	$conn = null;
	try
	{
		db_conn( $conn );
		$stmt = $conn->prepare( $sql );
		$stmt->execute( $arr_prepare );
		$result = $stmt->fetchAll();
	}
	catch( Exception $e )
	{
		return $e->getMessage();
	}
	finally
	{
		$conn = null;
	}

	return $result[0];
}

// ---------------------------------
// 함수명	: update_board_info_no
// 기능		: 게시판 특정 게시글 정보 수정
// 파라미터	: Array		&$param_arr
// 리턴값	: INT/STRING	$result_cnt/ERRMSG
// ---------------------------------
function update_board_info_no( &$param_arr )
{
	$sql =
		" UPDATE "
		." 	board_info "
		." SET "
		." 	board_title = :board_title "
		." 	,board_contents = :board_contents "
		." WHERE "
		." 	board_no = :board_no "
		;
	$arr_prepare =
		array(
			":board_title" => $param_arr["board_title"]
			,":board_contents" => $param_arr["board_contents"]
			,":board_no" => $param_arr["board_no"]
		);

	$conn = null;
	try
	{
		db_conn( $conn ); // PDO object set(DB연결)
		$conn->beginTransaction(); // Transaction 시작
		$stmt = $conn->prepare( $sql ); // statement object set
		$stmt->execute( $arr_prepare ); // DB request
		$result_cnt = $stmt->rowCount(); // query 적용 recode 갯수
		$conn->commit();
	}
	catch( Exception $e )
	{
		$conn->rollback();
		return $e->getMessage();
	}
	finally
	{
		$conn = null; // PDO 파기
	}

	return $result_cnt;

}

// ---------------------------------
// 함수명	: delete_board_info_no  // 실제 쿼리는 [update]
// 기능		: 게시판 특정 게시글 정보 삭제 플러그 갱신
// 파라미터	: INT		&$param_no
// 리턴값	: INT/STRING	$result_cnt/ERRMSG
// ---------------------------------
function delete_board_info_no(&$param_no)
 {
	$sql = 
	 " UPDATE "
	." board_info "
	." SET "
	." board_del_flg = '1' " // 인트가 아님 캐릭터
	." ,board_del_date = NOW() " // 수정이나 삭제를 언제 했는지 꼭 갱신
	." WHERE "
	." board_no = :board_no "	
	;
	$arr_prepare =
		array(
			":board_no" => $param_no
		);

		$conn = null; // PDO를 오픈
		try
		{
			db_conn( $conn ); // PDO object set(DB연결)
			$conn->beginTransaction(); // Transaction 시작
			$stmt = $conn->prepare( $sql ); // statement object set
			$stmt->execute( $arr_prepare ); // DB request
			$result_cnt = $stmt->rowCount(); // query 적용 recode 갯수
			$conn->commit(); // 정상작동하면 커밋
		}
		catch( Exception $e )
		{
			$conn->rollback(); // 에러 발생시 롤백
			return $e->getMessage(); // 이 에러 메시지를 리턴해줘서 호출한 쪽에서 알 수 있도록 해주기
		}
		finally
		{
			$conn = null; // PDO 파기
		}
		
		return $result_cnt;
	}
// ---------------------------------
// 함수명	: insert_board_info
// 기능		: 게시글 생성
// 파라미터	: Array		&$param_arr
// 리턴값	: INT/STRING	$result_cnt/ERRMSG // 앞에는 정상 뒤에는 에러메시지
// ---------------------------------
function insert_board_info(&$param_arr)
  {
	$sql = 
	 " INSERT INTO board_info("
	."  board_title "
	." ,board_contents " 
	." ,board_write_date "
	. " ) "
	." VALUES ( "
	."  :board_title "
	." ,:board_contents " // 프리퀄렉션?으로 작성할거기 떄문에 콜론
	." ,NOW() " // MARIADB가 가지고 있는 함수 php가 가지고 있는 게 아니다.
	." ) "
	;

	$arr_prepare =
		array(
			":board_title" => $param_arr["board_title"]
			,":board_contents" => $param_arr["board_contents"]
		);

		// function의 로직 흐름.
		// db 연결 트랜잭션 시작하고 스테이트먼트 만들고 쿼리를 데이터베이스에 리퀘스트 하고 정상이면 커밋 비정상이면 롤백
		// 마지막으로 정상일 때는 리턴 에러면 에러메시지 리턴 (순서)
		
		$conn = null; // PDO를 오픈 // 얘가 본체임
		try
		{
			db_conn( $conn ); // PDO object set(DB연결)
			$conn->beginTransaction(); // Transaction 시작 // 데이터 변경할 때 데이터가 이상해지지 않게 제어
			$stmt = $conn->prepare( $sql ); // statement object set
			$stmt->execute( $arr_prepare ); // DB request
			$result_cnt = $stmt->rowCount(); // query 적용 recode 갯수
			$conn->commit(); // 정상작동하면 커밋
		}
		catch( Exception $e )
		{
			$conn->rollback(); // 에러 발생시 롤백
			return $e->getMessage(); // 이 에러 메시지를 리턴해줘서 호출한 쪽에서 알 수 있도록 해주기
		}
		finally
		{
			$conn = null; // PDO 파기
		}
		
		return $result_cnt;
	}


	// TODO 
	// $arr = array("board_title" => "test", "board_contents" => "test contents");
	// echo insert_board_info( $arr );
	//TODO