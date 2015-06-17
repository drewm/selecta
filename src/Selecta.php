<?php

namespace DrewM\Selecta;
 
class Selecta
{
	public static $single_tags = array('img', 'br', 'hr');
	public static $meta_map   = array('.'=>'class', '#'=>'id', '['=>'TODO');

	public static function build($selector, $contents='')
	{
		$parts = explode(' ', $selector);
		if (count($parts)) {
			$parts = array_reverse($parts);
			foreach($parts as $part) {
				$contents = self::tagify($part, $contents);
			}
		}
		return $contents;
	}

	private static function tagify($selector, $contents)
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

		return self::build_tag($selector, $attrs, $contents);
	}

	private static function build_attributes($meta_char, $value, $attrs)
	{
		if (isset(self::$meta_map[$meta_char])) {
			$key = self::$meta_map[$meta_char];

			if (isset($attrs[$key])) {
				$attrs[$key] .= ' '.$value;
			}else{
				$attrs[$key] = $value;
			}
		}

		return $attrs;
	}

	private static function build_tag($name, $attributes=array(), $contents='', $allow_empty=array(), $dont_escape=array())
	{
		$tag = '<'.self::html($name);
		if (count($attributes)) {
			// do attributes
			$attpairs = array();
            foreach($attributes as $key=>$val) {
                if (in_array($key, $allow_empty) || $val!='') {
                	if (in_array($key, $dont_escape)) {
                		$attpairs[] = self::html($key).'="'.$val.'"';
                	}else{
                		$attpairs[] = self::html($key).'="'.self::html($val, true).'"';
                	}
                } 
            }
            $tag .= ' '.implode(' ', $attpairs);
		}
		$tag .= '>';
		if (in_array($name, self::$single_tags)) return $contents.$tag;
		$tag .= $contents.'</'.self::html($name).'>';

		return $tag;
	}

	private static function html($s=false, $quotes=false, $double_encode=false)
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