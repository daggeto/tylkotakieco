<?php
        function uploadFile($input_name, $dir, $file_types, $overwrite = 1, $file_name = NULL) {
             
            if(!$_FILES[$input_name]['name']) return 0;			
			if($_FILES['obrazek']['error'] == 2) return 5;
		
            $file_ex = pathinfo($_FILES[$input_name]['name']);
					if(array_search($file_ex['extension'],$file_types) && preg_match('(image/)',$_FILES[$input_name]['type'])) {
						if($file_name == NULL) {
							if($overwrite == 0 && file_exists($dir.$_FILES[$input_name]['name'])) return 4;
							if(!move_uploaded_file($_FILES[$input_name]['tmp_name'],$dir.$_FILES[$input_name]['name'])) return 1;
							else return 2;
						}
						else {
							if($overwrite == 0 && file_exists($dir.$file_name.".".$file_ex['extension'])) return 4;
							if(!move_uploaded_file($_FILES[$input_name]['tmp_name'],$dir.$file_name.".".$file_ex['extension'])) return 1;
							else return 2;
						}
					}
				else return 3; 
        }
?>