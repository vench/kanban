<?php

class Utill {

        /**
         * 
         * @param string $string
         * @return string
         */
	public static function safeText($string) {	    
		$string = preg_replace_callback(
            "/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i",
              create_function( 
            '$matches',
            'return CHtml::encode($matches[0]);'),
            $string); 
            return $string;
                /*
                return preg_replace_callback(
            "/^[^>\"]+(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/i",
              create_function( 
            '$matches',
            'return CHtml::link($matches[0], $matches[0], array("target"=>"_blank"));'),
            $string); */
	}
}