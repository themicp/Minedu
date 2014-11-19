<?php
    $url = "http://results.minedu.gov.gr/index.php/site/search?canId=" . $_POST[ 'id' ]; 
    //echo $url . "<br />";
    $page = file_get_contents( $url );
    preg_match_all("'<td>(.*?)</td>'si", $page, $matches);
    $matches = $matches[ 1 ];
    if ( $_POST[ 'filter' ] == "true" ) {
        $condition = $matches[ 1 ] == $_POST[ 'lastname' ] && $matches[ 2 ] == $_POST[ 'firstname' ];
    }
    else {
        $condition = $matches[ 1 ] == $_POST[ 'lastname' ] || $matches[ 2 ] == $_POST[ 'firstname' ];
    }
    if ( $condition ) {
        echo 1;
    }
    else {
        echo 0;
    }
    echo "*" . $_POST[ 'id' ];
?>
