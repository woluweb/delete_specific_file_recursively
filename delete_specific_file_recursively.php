<?php  
// inspiré librement de http://www.webgalli.com/blog/recursively-walk-in-a-directory-and-delete-all-matched-files-with-php/
function delete_recursively_($path,$match){
   static $deleted = 0, 
   $dsize = 0;
   $dirs = glob($path."*");
   $files = glob($path.$match);
   foreach($files as $file){
      if(is_file($file)){
         $deleted_size += filesize($file);
         unlink($file);
         $deleted++;
      }
   }
   foreach($dirs as $dir){
      if(is_dir($dir)){
         $dir = basename($dir) . "/";
         delete_recursively_($path.$dir,$match);
      }
   }
   return "$deleted files deleted with a total size of $deleted_size bytes";
}
// attention, deux différences par rapport au code initial :
// 1. j'ai mis le nom du dossier en dynamique et pas hardcodé
// 2. il faut mettre p ex '*.gif' et pas '.gif' comme indiqué dans le script original
// nb : si on met '*.php', le présent script sera supprimé aussi puisque c'est un fichier .php...
echo delete_recursively_(getcwd().'/', 'php.ini');
?>