<?php

class Utill {

	public static function safeText($string) {
		$match = NULL;
		return preg_replace_callback(
            "/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i",
              create_function( 
            '$matches',
            'return CHtml::encode($matches[0]);'),
            $string); 
	}
}