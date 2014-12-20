<?php

class Utill {
    
    /**
     * 
     * @return array
     */
    public static function getAllowHTMLTags() {
        return array(
            '<br>',
            '<b>',
            '<em>',
            '<strong>',
            '<i>',
            '<small>',
            '<u>',
        );
    }
    
    /**
     * 
     * @return type
     */
    public static function getAllowHTMLTagsStr() {
        return CHtml::encode(join(', ', self::getAllowHTMLTags()));
    }
    
    /**
     * 
     * @param string $string
     * @return string
     */
    public static function safeTextSave($string) {
        return strip_tags($string, join('', self::getAllowHTMLTags()));
    }

    /**
         * 
         * @param string $string
         * @return string
         */
	public static function safeText($string) { 
	
            $string = self::safeTextSave($string);
               
            return preg_replace_callback(
               '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i',        
              create_function( 
            '$matches',
            'return CHtml::link($matches[0], $matches[0], array("target"=>"_blank"));'),
            $string); 
	}
}