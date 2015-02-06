<?php
    /**
     * 
     */
    class Encrypter {
        	
		/*public static function encrypt($string){
			$string = utf8_encode($string);
			$key = "tic"; 
			$string = $key.$string.$key; 
			$string = base64_encode($string);
			return($string);
		}

		public static function decrypt($string){
			$string = base64_decode($string); 
			return($string);
		 * 
		 * $cad = explode("&",$string); 
			$string = $cad[1]; 
			$string = base64_decode($string); 
			$key = "tic";
			$string = str_replace($key, "", "$string"); 
			$cad_get = explode("&",$string);
			
			foreach($cad_get as $value){
				$val_get = explode("=",$value); 
				$_GET[$val_get[0]]=utf8_decode($val_get[1]);
			}
		 * 
		}*/
		
		private static $key = "DiGiTalMiNd";

        public static function encrypt ($input){
        	$input = utf8_encode($input);
            $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$key), $input, MCRYPT_MODE_CBC, md5(md5(Encrypter::$key))));
            return $output;
        }

        public static function decrypt ($input){
            $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Encrypter::$key))), "\0");
            return $output;
        }
    }
    
?>