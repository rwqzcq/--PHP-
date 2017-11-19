<?php
/**
 * 例题 9/15
 */

/**
 * 顺序表原地逆置
 * @param array 要逆置的数组的地址
 * @return void
 */
function Reverse(&$sqList) {
	$head = 0; // 头
	$len = count($sqList);
	$rear = $len - 1; // 尾
	$temp = '';
	for ($head = 0; $head < $len && $head < $rear; $head++, $rear--) { 
		$temp = $sqList[$head];
		$sqList[$head] = $sqList[$rear];
		$sqList[$rear] = $temp;
	}
}

// 3.假定数组A中有多个零元素，试写出一个函数，将A中所有的非零元素依次移动到数组A的前端A[i](o<=i && i<=数组长度 )
/**
 * 移动非0元素到数组前端
 * @param array 数组的地址
 * @return void
 */
function removeToHead(&$arr) {
	$len = count($arr);
	for ($i=0, $j=0; $i < $len; $i++) { 
		if ($arr[$i] != 0) {
			$temp = $arr[$j]; // 要移动开的位置
			$arr[$j] = $arr[$i];
			$arr[$i] = $temp;
			$j++;
		} else {
			continue;
		}		
	}
}

//4.编写函数，
// 将有一个n个非零元素的整数一维数组A[n]拆分成两个一维数组，
// 使得A[]中大于零的元素存放在B[]中，小于0的元素存放在C[]中
/**
 * 数组拆分
 * @param array $A 待拆分的数组
 * @return array $res 二维数组
 */
function takePartZero($A) {
	// 查找非0元素的位置
	$index = array_filter($A, function($e){
		return $e != 0;
	});
	$index = array_keys($index);
	// 查找大于0元素的位置
	$bigger = array_filter($A, function($e) {
		return $e > 0;
	});
	$bigger = array_keys($bigger);
	// 查找小于0元素的位置
	$smaller = array_keys(array_filter($A, function($e){
		return $e < 0;
	}));
	// 存放结果
	$res = [];
	$res['B'] = [];
	$res['C'] = [];
	foreach ($bigger as $v) {
		$res['B'][] = $A[$v];
	}
	foreach ($smaller as $v) {
		$res['C'][] = $A[$v];
	}
	return $res;
}
$test = [1, 3, -8, -5, 10, 0, 19, 180];
//5.已知在一维数组A[m+n]中依次存放着两个线性表(a0, a1, a2.....am-1)和
// (b0, b1, b2, ......bn-1)。尝试编写一个函数，将数组中的两个顺序表的位置互换
/**
 * 顺序表位置互换
 * @param array $A 存放着两个顺序表的数组
 * @param int $m 第一个线性表的长度
 * @param int $n 第二个线性表的长度
 * @return array 位置互换之后的数组
 */
function listReverse($A, $m, $n) {
	include 'SqList.class.php'; // 引入自己写的顺序表类
	$sqList = new sqList($A);
	$len = count($A);
	for ($i=$m, $j=1; $i < $len; $i++, $j++) { 
		$temp = $A[$i];
		// 删除
		$sqList->listDelete($i+1); // 注意删除的是从1开始	
		// 插入
		$sqList->listInsert($j, $temp);		
	}
	return $sqList->list;
}

/* 顺序表归并
   两个顺序表都是非递减有序排列，归并之后仍然是有序的
   A[1, 3, 5, 8, 10]
   B[2, 6, 9, 18, 20]
   C[1, 2, 3, 5, 6, 8, 9, 10, 18, 20]
*/
/**
 * 顺序表归并
 * @param array $listA 待归并的顺序表
 * @param array $listB 待归并的顺序表
 * @param mixed 
 */
function mergeSqList($listA, $listB) {
	if(!is_array($listA) || !is_array($listB)) return false;
	$merge = [];
	$A = 0; // $listA的工作指针
	$B = 0; // $listB的工作指针
	$M = 0; // $merge的工作指针
	$lenA = count($listA);
	$lenB = count($listB);
	// 归并
	while ($A < $lenA && $B < $lenB) {
		if($listA[$A] < $listB[$B]) {
			$merge[$M++] = $listA[$A++];
		} else {
			$merge[$M++] = $listB[$B++];
		}
	}
	// A有冗余
	while ($A < $lenA) {
		$merge[$M++] = $listA[$A++];
	}
	// B有冗余
	while ($B < $lenB) {
		$merge[$M++] = $listB[$B++];
	}
	return $merge;
}
/**
 * 使用PHP自带的函数实现
 */
function mergePHP($listA, $listB) {
	sort($listA);
	sort($listB);
	$merge = array_merge($listA, $listB);
	sort($merge);
	return $merge;
}
$A = [1, 5, 3, 10];
$B = [2, 6, 9, 18, 20, 89];
$c = mergePHP($A, $B);
print_r($c);

?>