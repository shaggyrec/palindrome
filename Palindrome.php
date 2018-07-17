<?php
class Palindrome {
    private $string;
    /**
		@param string $string
    */
    function __construct($string){
        if(empty($string)){
            throw new Exception('emtpy string');
        }
        $string = mb_strtolower($string);
        $this->string = preg_replace('/\s+/', '', $string);
    }
    /**
		@param string $string
		@return bool
    */
    private function isPalindrome($string){
        return $string == $this->stringReverse($string);
    }
    
    /**
		@param string $string
		@return string
    */
    private function stringReverse($string, $encoding='UTF-8'){
        return mb_convert_encoding( strrev( mb_convert_encoding($string, 'UTF-16BE', $encoding) ), $encoding, 'UTF-16LE');
    }
    
    /**
		@param string $string
		@return string
    */
    private function findSubPolindrome($string){
        $subPolindrome = mb_substr($string,0,1);
		for($i = 0; $i < mb_strlen($string); $i++){
		    for($j = mb_strlen($string)-$i; $j > 0; $j--){
                 $subString = mb_substr($string, $i, $j);
                 if($this->isPalindrome($subString) && mb_strlen($subString) > mb_strlen($subPolindrome)){
                     $subPolindrome = $subString;
                 }
		    }
		}
        return $subPolindrome;
    }
    
    /**
		@param string $string
		@return string
    */
    public function result(){
        if($this->isPalindrome($this->string)){
            return $this->string;
        }
        return $this->findSubPolindrome($this->string);
    }
}

// example 
$string = 'Аргентина манит негра';
$palindrome = new Palindrome($string);
echo $palindrome->result();
