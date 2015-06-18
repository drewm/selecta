<?php

namespace DrewM\Selecta;
 
class Selecta
{
	public static $single_tags = array('img', 'br', 'hr', 'input');
	public static $meta_map    = array('.'=>'class', '#'=>'id');

	public static function build($selector, $contents='', $open_tags=true, $close_tags=true)
	{
		$parts = explode(' ', $selector);
		if (count($parts)) {
			$parts = array_reverse($parts);
			foreach($parts as $part) {
				$contents = self::tagify($part, $contents, $open_tags, $close_tags);
			}
		}
		return $contents;
	}

	public static function wrap($selector, $contents='')
	{
		return self::build($selector, $contents, true, true);
	}

	public static function open($selector)
	{
		return self::build($selector, '', true, false);
	}

	public static function close($selector)
	{
		return self::build($selector, '', false, true);
	}

	private static function tagify($selector='', $contents='', $open_tags=true, $close_tags=true)
	{
		$attrs = array();

		$metas = '\.\#\[';
		$pattern = '/(['.$metas.'])([^'.$metas.']*)?/';
		preg_match_all($pattern, $selector, $matches, PREG_SET_ORDER);

		if (count($matches)) {
			foreach($matches as $match) {
				$attrs = self::build_attributes($match[1], $match[2], $attrs);
			}

			$parts = preg_split('/['.$metas.']/', $selector);
			$selector = $parts[0];
		}

		return self::build_tag($selector, $attrs, $contents, $open_tags, $close_tags);
	}

	private static function build_attributes($meta_char, $value, $attrs)
	{
		$key = false;
		if (isset(self::$meta_map[$meta_char])) {
			$key = self::$meta_map[$meta_char];
		}else{
			switch ($meta_char) {
				
				// Attribute selectors
				case '[':
					$value = rtrim($value, ']');

					if (strpos($value, '=')) {
						$parts = explode('=', $value);
						$key = $parts[0];
						$value = $parts[1];
					}else{
						$key = $value;
						$value = false;
					}
					break;

			}
		}

		if ($key){
			if (isset($attrs[$key])) {
				$attrs[$key] .= ' '.$value;
			}else{
				$attrs[$key] = $value;
			}
		}

		return $attrs;
	}

	private static function build_tag($name, $attributes=array(), $contents='', $open_tag=true, $close_tag=true)
	{
		$tag = '';

		if ($open_tag) {
			$tag = self::open_tag($name, $attributes);
		}
		
		if (in_array($name, self::$single_tags)) { 
			return $contents.$tag;
		}

		$tag .= $contents;

		if ($close_tag) {
			$tag .= self::close_tag($name);
		}

		return $tag;
	}

	private static function open_tag($name, $attributes=array())
	{
		$tag = '<'.self::html($name);
		if (count($attributes)) {
			// do attributes
			$attpairs = array();
			foreach($attributes as $key=>$val) {
				if ($val!='') {
					$attpairs[] = self::html($key).'="'.self::html($val, true).'"';
				}else{
					$attpairs[] = self::html($key);
				}
			}
			$tag .= ' '.implode(' ', $attpairs);
		}
		$tag .= '>';

		return $tag;
	}

	private static function close_tag($name)
	{
		return  '</'.self::html($name).'>';		
	}

	private static function html($s, $quotes=false, $double_encode=false)
	{
		if ($quotes) {
	        $q = ENT_QUOTES;
	    }else{
	        $q = ENT_NOQUOTES;
	    }
	    
		if ($s || (is_string($s) && strlen($s))) return htmlspecialchars($s, $q, 'UTF-8', $double_encode);
	    return '';
	}

} 