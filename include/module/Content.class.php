<?php
/**
 *
 * @author daggreto
 */
class Content {

    private $content;

    public function getValue($section, $key)
    {
        if(!isset($this->content)){
            throw new Exception('Content doesn\'t initialized.');
        }

        if(!isset ($this->content[$section]) || !isset($this->content[$section][$key])){
            return '[missing: ' . $section . ' -> ' . $key . ']';
        }

        return $this->content[$section][$key];

    }

    public function getContent($filename){
        if(file_exists($filename))
        {
          $this->content =  parse_ini_file ($filename, true);
        }else{
            throw new Exception('File not found ');
        }

    }

    public function __construct($filename, $lang){
        $this->getContent($filename);
    }

}
?>
