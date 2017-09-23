<?php
/**
 * 栈的练习题 
 * 栈一般是作为一个中介来使用
 * 括号匹配问题
 * 表达式计算
 * 数制转换
 * 递归变非递归
 */
header('Content-Type:text/html; charset=utf-8');
include './Stack.class.php';
// 1. 括号匹配

/**
 * 输出匹配的括号和没有匹配的括号
 */
function bracketCompare($str) {
	if(!is_string($str)) return false;
	$len = mb_strlen($str);
	$stack = new Stack;
	for ($i=0; $i < $len; $i++) { 
		/* 匹配到左括号就入栈 */
		if($str[$i] == '(') {
			$stack->push([$str[$i], $i]);
			/* 匹配到右括号就出栈 */
		} else if($str[$i] == ')') {
			/* 栈不空 */
			if(!$stack->isEmpty()) {
				$elem = $stack->pop();
				echo '第'.($elem[1] + 1).'个左括号与第'.($i + 1).'右括号匹配成功<br>';
			} else {
				echo '没有括号和第'.($i + 1).'右括号匹配成功<br>';
			}
		}
	}
	/* 遍历完字符串后栈仍不为空 */
	while(!$stack->isEmpty()) {
		$elem = $stack->pop();
		echo '没有右括号第'.($elem[1] + 1).'个左括号匹配<br>';
	}
}

// 2. 后缀表达式求解表达式的值

/**
 * 后缀表达式就是 操作数操作数+操作符的组合
 * 从左向右依次扫描表达式的每一项，根据类型做以下操作
 * 操作数入栈
 * 操作符则连续出栈两个操作数然后计算结果重现入栈
 * 
 */
/*
	A+B*(C-D)-E/F =>  ABCD-*+EF/-

*/
/**
 * 后缀变中缀
 * 需要考虑的是优先级和括号
 * 算法思想
 * 		
 */

// 栈内操作数优先数
function isp($operator) {
	$tar = ['#' => 0, '(' => 1, '*' => 5, '/' => 5, '%' => 5, '-' => 3, '+' => 3, ')' => 6];
	return $tar[$operator];
}
// 栈外操作数优先数
function icp($operator) {
	$tar = ['#' => 0, '(' => 6, '*' => 4, '/' => 4, '%' => 4, '-' => 2, '+' => 2, ')' => 1];
	return $tar[$operator];
}
function infixTopostfix($str) {
	/* 初始化操作符栈 */
	$stack = new Stack;
	$stack->push('#');
	/* 初始化后缀表达式 */
	$postFix = '';
	/* 初始化当前运算符以及栈顶元素 */
	$currentOp = '';
	$top = '';
	/* 初始化操作符字符串*/
	$opStr = '+-*/%()#';
	$len = strlen($str);
	/* 扫描字符串 */
	for ($i=0; $i < $len; $i++) { 
		$temp = $str[$i];
		/* 判断是操作数还是操作符 */
		if(strpos($opStr, $temp) === false){
			$postFix .= $temp; // 操作数直接输出
		} else {
			if(icp($temp) > isp($stack->getTop())) { // 进栈
				$stack->push($temp);
				continue;
			} else if(icp($temp) < isp($stack->getTop())) { // 退栈输出
				$top = $stack->pop();
				$postFix .= $top;
				continue;
			} else { // 退栈不输出
				$top = $stack->pop();
				continue;
			}
		}
	}
	while(!$stack->isEmpty()) {
		echo $stack->pop();
	}
	return $postFix;
}

/*
 * 数值转换
 * @param int $num 要转换的数字
 * @param int $base 要转换的进制
 * @return string $res 返回的拼接成的字符串
 */
function transFrom($num, $base) {
	$stack = new Stack;
	$res = '';
	while($num) {
		$stack->push($num%$base); // 入栈
		$num = floor($num/$base);
	}
	while(!$stack->isEmpty()) {
		$res .= $stack->pop(); 
	}
	echo $res;
}
/**
 * 找最大值的非递归算法
 * @param array 待查找的数组
 * @return int 最大的值
 */
function findMax($arr) {
	$stack = new Stack;
	$stack->push($arr[0]);
	foreach ($arr as $v) {
		$top = $stack->getTop();
		if ($top >= $v) {
			continue;
		} else {
			$stack->push($v);
		}		
	}
	return $stack->getTop();
}
/**
 * 递归求数组的和
 * @param array $arr 目标求和数组
 * @param int $n 数组的最大下标
 * @return int 最后的和
 */
function sumRecurve($arr, $n) {
	if ($n < 0) {
		return 0;
	} else {
		return $arr[$n] + findMaxRecurve($arr, $n-1);
	}	
	
}
/**
 * 递归求数组的最大
 * @param array $arr 目标求和数组
 * @param int $start 起始的值
 * @param int $n 起始位置 
 * @return int $start 最后的最大值
 */
function maxRecurve($arr, $start, $n) {
	if($n == count($arr) - 1)
		return $start;
	if($start < $arr[$n]) {
		return maxRecurve($arr, $arr[$n], ++$n); // 先赋值 后自增
	} else  {
		return maxRecurve($arr, $start, ++$n);
	}
}
/**
 * 递归求平均数
 * @param array $arr 待求平均数的数组
 * @param int $n 递归需要用到的条件
 */
function Aver($arr, $n) {
	if ($n == 1) {
		return $arr[0];
	} else {
		return (Aver($arr, $n-1)*($n-1)+$arr[$n-1])/$n;// $n是不变的,就是在相加的时候变化
	}
	
}

?>