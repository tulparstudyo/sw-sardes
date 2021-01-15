<?php
namespace Swordbros;
class Sardes {

    public static function composerUpdate() {
        /*
        $oldfile = resource_path() . '/views/app.blade.php';
        $sardesfile = dirname( __FILE__ ) . '/../view/app.blade.php';
		if(file_exists($sardesfile)){
			if ( file_exists( $oldfile . '.bak' ) ) {
				echo "Update the views.blade.php! app.blade.php.bak is already exists .\r\n";
			} else {
				copy( $oldfile, $oldfile . '.bak' );
				copy( $sardesfile, $oldfile );
				echo "Update the views.blade.php file for swordbros sardes theme. Original file backed up\r\n";
			}
		} else {
			echo "$sardesfile not found \r\n";
		}
        */
// balde files
        $dst = resource_path() . '/views';
        if(!is_dir($dst)){
            @mkdir($dst); 
        }
        $src = dirname( __FILE__ ) . '/../view/resources';
        if(is_dir($src)){
            self::recurse_copy($src, $dst);
            echo "$src copied to $dst \r\n";
        } else{
            echo "$src not found \r\n";
        }   
// theme files
        $dst = public_path() . '/packages/swordbros';
        if(!is_dir($dst)){
            @mkdir($dst); 
        }
        $src = dirname( __FILE__ ) . '/../view/swordbros';
        if(is_dir($dst.'/shop/themes/sardes')){
            echo "$dst allready exists \r\n";
        } else{
            if(is_dir($src)){
                self::recurse_copy($src, $dst);
                echo "$src copied to $dst \r\n";
            } else{
                echo "$src not found \r\n";
            }
        }
    }
    private static function recurse_copy($src, $dst) { 
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    self::recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else {
                    if(is_file($dst . '/' . $file.'.bak')){
                        echo " - ". $file." allready copied\r\n";
                    } else{
                        if(is_file($dst . '/' . $file)){
                            copy($dst . '/' . $file, $dst . '/' . $file.'.bak'); 
                            echo " * ". $file." backed up\r\n";
                        }
                        copy($src . '/' . $file, $dst . '/' . $file); 
                        echo " - ". $file." copied\r\n";
                    }
                } 
            } 
        } 
        closedir($dir); 
    }
}

