<?php
//递归重组节点信息为多维数组
function node_merge ($node, $access = null, $pid = 0) {
	$arr = array();
	foreach ($node as $v) {
		if (is_array($access)) {
				$v['access'] = in_array($v['id'], $access) ? 1 : 0;
		}
		if ($v['pid'] == $pid) {
			$v['child'] = node_merge($node, $access, $v['id']);
			$arr[] = $v;
		}
	}
	return $arr;
}

/**
 * 格式化字节大小
 * @param  number $bytes     字节数
 * @param  string $unit      单位 可选
 * @param  string $unit      小数 可选
 * @return string            格式化后的带单位的大小
 */
function admin_formatsize($bytes, $unit = "", $decimals = 2) {
    $units = array('B' => 0, 'KB' => 1, 'MB' => 2, 'GB' => 3, 'TB' => 4, 'PB' => 5, 'EB' => 6, 'ZB' => 7, 'YB' => 8);
    $value = 0;
    if ($bytes > 0) {
        if (!array_key_exists($unit, $units)) {
            $pow = floor(log($bytes)/log(1024));
            $unit = array_search($pow, $units);
        }
        $value = ($bytes/pow(1024,floor($units[$unit])));
    }

    if (!is_numeric($decimals) || $decimals < 0) {
        $decimals = 2;
    }

    return sprintf('%.' . $decimals . 'f '.$unit, $value);
}

//删除目录下的文件处理函数
function rmdirr($dirname) {
    
    if (!file_exists($dirname)) {
        return false;
    }

    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }

    $dir = dir($dirname);
    if($dir){
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            //递归
            rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
        }
    }
    $dir->close();

    return rmdir($dirname);
}