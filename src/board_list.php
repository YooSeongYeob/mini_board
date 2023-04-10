    <?php
        define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]. "/" );
        define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php");
        include_once( URL_DB );
        // $http_method = $_SERVER["REQUEST_METHOD"];
        // $http_method === "GET"

        if( array_key_exists( "page_num", $_GET ))
        {
            $page_num = $_GET["page_num"];
            // $page_num = $arr_get["page_num"];
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

        // 1페이지일 때 0, 2페이지일 때 5, 3페이지일 때 10 ... 
      
        // offset 계산
        $offset = ( $page_num * $limit_num ) - $limit_num;
        
        $arr_prepare = 
            array(
                "limit_num" => $limit_num
                ,"offset"   => $offset
            );
    $result_paging = select_board_info_paging( $arr_prepare );
    // print_r( $max_page_num );
    ?>
    
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>게시판</title>
    </head>
    <body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
        <table class='table table-striped'>
            <thead> 
                <tr>   
                <th>게시글 번호</th>
                <th>게시글 제목</th>
                <th>작성일자</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach( $result_paging as $recode )
                    {
                ?>      
                    <tr>
                        <td><?php echo $recode["board_no"] ?></td>
                        <td><?php echo $recode["board_title"] ?></td>
                        <td><?php echo $recode["board_write_date"] ?></td>
                    </tr>
                <?php
                    }
                ?>
                <!-- <tr>
                    <td>1</td>
                    <td>제목1</td>
                    <td>2023-04-08</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>제목2</td>
                    <td>2023-04-09</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>제목3</td>
                    <td>2023-04-10</td>
                </tr> -->
            </tbody>
        </table>
        <?php
            for( $i = 1; $i <= $max_page_num; $i++)
            {
        ?>          
            <a href='board_list.php?page_num=<?php echo $i?>'><?php echo $i ?></a>
            
        <?php
            }
        ?>       
    </body>
    </html>
