<?php
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
                PDO::ATTR_EMULATE_PREPARES      => false 
                ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
                ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
            );

            try
            {
                $param_conn = new PDO($dns, $user, $pass, $pdo_option);
            }
            catch( Exception $e )
            {
                $param_conn = null;
                throw new Exception($e->getMessage());
            }
}

function select_board_info_paging( &$param_arr)
{
    $sql = 
    " SELECT " 
	." board_no "
	." ,board_title "
	." ,board_write_date "
    ." FROM" 
    ." board_info "
    ." WHERE "
    ." board_del_flg  = '0' "
    ." ORDER BY "
    ." board_no DESC " 
    ." LIMIT :limit_num OFFSET :offset "
    ;

    $arr_prepare =
        array(
             ":limit_num"  =>  $param_arr["limit_num"]
            ,":offset"     =>  $param_arr["offset"]
        );
    
    $conn = null; // 커넥션을 받을 것을 널로 설정
    try
    {
        db_conn( $conn );  
        $stmt = $conn->prepare( $sql );
        $stmt->execute($arr_prepare);
        $result = $stmt->fetchAll();
    }
    catch ( Exception $e)
    {
        return $e->getmessage(); //false;
    }
    finally
    {
        $conn = null; // 데이터를 사용했으니 다시 닫아주는 개념
    }
    
    return $result;
}

function select_board_info_cnt()
{
    $sql = 
    " SELECT "
    ."   COUNT(*) cnt "
    ."FROM " 
    ."    board_info "
    ." WHERE "
    ."       board_del_flg= '0' "
    ;
    $arr_prepare = array();

    $conn = null; // 커넥션을 받을 것을 널로 설정
    try
    {
        db_conn( $conn );  
        $stmt = $conn->prepare( $sql );
        $stmt->execute($arr_prepare);
        $result = $stmt->fetchAll();
    }
    catch ( Exception $e)
    {
        return $e->getmessage(); //false;
    }
    finally
    {
        $conn = null; // 데이터를 사용했으니 다시 닫아주는 개념
    }
    
    return $result;

};


// TODO : test start 할 게 남았을 때 남기는 코멘트
$arr=
    array(
        "limit_num" => 5
        ,"offset"   => 0
    );
// 최종적으로 서버에 올릴 때는 지워야 함
$result = select_board_info_paging($arr);
// print_r($result);
// TODO : test End
?>
