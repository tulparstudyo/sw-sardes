<?php
namespace Swordbros;
class Frigian {

    public static function composerUpdate() {

        $oldfile = resource_path() . '/views/app.blade.php';
        $frigianfile = dirname( __FILE__ ) . '/../view/app.blade.php';
		if(file_exists($frigianfile)){
			if ( file_exists( $oldfile . '.bak' ) ) {
				echo "Update the views.blade.php! app.blade.php.bak is already exists .\r\n";
			} else {
				copy( $oldfile, $oldfile . '.bak' );
				echo "Update the views.blade.php file for swordbros frigian theme. Original file backed up\r\n";
			}
		} else {
			echo "$frigianfile not found \r\n";
		}


    }
}