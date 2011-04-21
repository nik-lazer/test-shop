<?php

class DataUtils {
	public static function checkIntVal($id, $default=0) {
            if ($id) $ret = (int)$id; else $ret = $default;
            return $ret;
    }
}