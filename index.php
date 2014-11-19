<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
        </script>
    </head>
    <body>
        <form action='' method='GET' >
            <span>Όνομα</span>
            <input type='text' value='' name='firstname' />
            <span>Επώνυμο</span>
            <input type='text' value='' name='lastname' />
            <span>Να ταιριάζει το ονοματεπώνυμο</span>
            <input type='checkbox' />
            <input type='submit' value='Search' />
        </form>
        <script type='text/javascript'>
            var startid = 4750;
            $( "form" ).submit( function() {
                var input = $( this ).children( "input[ type=text ]" );
                var check = $( this ).children( "input[ type=checkbox ]" )[ 0 ];
                var firstname = input[ 0 ].value;
                var lastname = input[ 1 ].value;
                for ( i = 0; i < 501; ++i ) {
                    $.post( "post.php", {
                        id: 1*startid + 1*i,
                        firstname: firstname,
                        lastname: lastname,
                        filter: check.checked
                    }, function( response ) {
                        console.log( response );
                        var status = response.split( "*" )[ 0 ];
                        if ( 1*status == 1 ) {
                            alert( "found - " + response.split( "*" )[ 1 ] );
                        }
                    } );
                }
                return false;
            } );
        </script>
        <?php
            if ( $_GET[ 'firstname' ] != "" ) {
                $i = 0;
                $startid = 4995;
                for ( $i = 0; $i < 100; ++$i ) {
                    $url = "http://results.minedu.gov.gr/index.php/site/search?canId=" . ( $startid + $i ); 
                    //echo $url . "<br />";
                    $page = file_get_contents( $url );
                    if ( !$page ) {
                        echo ( (int)$startid + $i ) . " -- Error loading the page.<br />";
                    }
                    preg_match_all("'<td>(.*?)</td>'si", $page, $matches);
                    $matches = $matches[ 1 ];
                    if ( $matches[ 2 ] == $_GET[ 'firstname' ] && $matches[ 1 ] == $_GET[ 'lastname' ] ) {
                        echo "Found - " . ( (int)$startid + $i );
                        break;
                    }
                }
            }
        ?>
    </body>
</html>
