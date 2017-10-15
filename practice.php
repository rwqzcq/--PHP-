<?php
/**
 * 回文算法
 */
include('./Queue.class.php');
function palindrome($str) {
	$str = str_split($str); // 字符串变数组
	$stack = []; // 栈
	$queue = new Queue(count($str)); // 堆
	foreach ($str as $value) {
		array_push($stack, $value);  // 入栈
		$queue->enQueue($value); // 入队
	}
	while(count($stack) != 0 && $queue->getLength() != 0) {
		if(array_pop($stack) != $queue->deQueue()) 
			return false;
	}
	return true;
}
?>