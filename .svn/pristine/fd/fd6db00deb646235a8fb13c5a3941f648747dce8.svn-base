<?php
namespace Lib\Util;
//分类处理方法
class Category {

	//组合一维数组
	static public function unlimitedForLevel ($cate, $html = '&nbsp;|----&nbsp;', $pid = 0, $level = 0) { 
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$v['level'] = $level + 1;
				$v['html'] = str_repeat($html, $level);
				$arr[] = $v;
				$arr = array_merge($arr, self::unlimitedForLevel($cate, $html, $v['id'], $level + 1));
			}
		}
		return $arr;
	}

	//组合多维数组
	static public function unlimitedForLayer ($cate, $pid = 0) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$v['child'] = self::unlimitedForLayer($cate, $v['id']);
				$arr[] = $v;
			}
		}
		return $arr;
	}

	//传递一个子分类ID 返回所有父级分类
	static public function getParents ($cate, $id) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['id'] == $id) {
				$arr[] = $v;
				$arr = array_merge(self::getParents($cate, $v['pid']), $arr);
			}
		}
		return $arr;
	}

	//传递一个子分类ID 返回所有父级分类ID
	static public function getParentsid ($cate, $id) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['id'] == $id) {
				$arr[] = $v['id'];
				$arr = array_merge(self::getParentsid($cate, $v['pid']), $arr);
			}
		}
		return $arr;
	}

	//传递一个父级分类ID 返回所有子级分类
	static public function getchilds ($cate, $pid) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$arr[] = $v;
				$arr = array_merge($arr, self::getchilds($cate, $v['id']));
			}
		}
		return $arr;
	}
	
	//传递一个父级分类ID 返回所有子级分类ID
	static public function getchildsid ($cate, $pid) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$arr[] = $v['id'];
				$arr = array_merge($arr, self::getchildsid($cate, $v['id']));
			}
		}
		return $arr;
	}
}
?>