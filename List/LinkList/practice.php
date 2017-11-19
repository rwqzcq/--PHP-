<?php
	include 'LinkList.class.php';
	// 1. 单链表归并
/**
 * 有序的两个单链表归并
 * @param object $listA 待归并的单链表A
 * @param object $listB 待归并的单链表B
 * @return object $merge 归并之后的单链表
 */
function mergeLinkList($listA, $listB) {
	$p_a = $listA->head->next; // A的工作指针
	$p_b = $listB->head->next; // B的工作指针
	$merge = new LinkList(); // 存放结果的链表
	$m = $merge->head;
	while ($p_a && $p_b) {
		if ($p_a->data < $p_b->data) {
			$m->next = $p_a; // 指针传递
			$p_a = $p_a->next;
			$m = $m->next;
		} else {
			$m->next = $p_b;
			$p_b = $p_b->next;
			$m = $m->next;
		}			
	}
	while ($p_a) {
		$m->next = $p_a; // 指针传递
		$p_a = $p_a->next;	
		$m = $m->next;		
	}
	while ($p_b) {			
		$m->next = $p_b; // 指针传递
		$p_b = $p_b->next;		
		$m = $m->next;	
	}
	return $merge;
}
	// $A = new LinkList();
	// $A->createListByTail([-9, -8, 1,  5, 7, 9]);
	// $B = new LinkList();
	// $B->createListByTail([-9, 0, 2,  3, 5, 15, 18]);
	// $c = mergeLinkList($A, $B);
	// $c->listTerverse();
// 多项式运算
// 多项式的数据格式是 sum(Ai * X~n)
// 多项式加法 找到指数相同的然后系数相加
// 指数 index 系数 ratio 
// 思路 相加的话需要第三个链表来存储结果 遇到不同的就存到里面，遇到相同的就进行做和
// 输入的时候指数按照递增的顺序排列 利用归并排序的思想进行合并
/*
 * @param object $polynomeA 用单链表存储的多项式A 数据格式是['index'=>指数, 'ratio'=>系数]
 * @param object $polynomeB 用单链表存储的多项式B 数据格式是['index'=>指数, 'ratio'=>系数]
 * @return object $polynomeC 计算之后的单链表
 */
function mergePolynome($polynomeA, $polynomeB) {
	if(!is_object($polynomeA) || !is_object($polynomeB)) return false;
	$polynomeC = new LinkList();
	$p_a =  $polynomeA->head->next;
	$p_b =  $polynomeB->head->next;
	$p_c =  $polynomeC->head;
	// 归并
	while ($p_a && $p_b) {
		if ($p_a->data['index'] < $p_b->data['index']) {
			$p_c->next = $p_a;
			$p_a = $p_a->next;
			$p_c = $p_c->next;
		} else if($p_a->data['index'] == $p_b->data['index']) {				
			if($p_a->data['ratio'] + $p_b->data['ratio'] != 0) {				 	
			 	$new_ration = $p_a->data['ratio'] + $p_b->data['ratio'];
			 	$new_data = [];
			 	$new_data['index'] = $p_a->data['index'];
			 	$new_data['ratio'] = $new_ration;
			 	$new = new node($new_data);
			 	$p_c->next = $new;
			 	$p_c = $new; // 是当前的，不是下一个的
			} 
			$p_a = $p_a->next;
			$p_b = $p_b->next;				 				 	
		} else {
			$p_c->next = $p_b;
			$p_b = $p_b->next;
			$p_c = $p_c->next;		
		}
	}
	while ($p_a) {
		$p_c->next = $p_a;
		$p_a = $p_a->next;
	}
	while ($p_b) {
		$p_c->next = $p_b;
		$p_b = $p_b->next;
	}
	return $polynomeC;
}
	$polynomeA = new LinkList();
	$polynomeA->createListByTail([['index'=>1, 'ratio'=>5], ['index'=>2.5, 'ratio'=>5], ['index'=>4, 'ratio'=>6], ['index'=>5, 'ratio'=>10]]);
	$polynomeB = new LinkList();
	$polynomeB->createListByTail([['index'=>1, 'ratio'=>-5], ['index'=>3, 'ratio'=>8], ['index'=>4, 'ratio'=>7], ['index'=>5, 'ratio'=>19]]);
	$c = mergePolynome($polynomeA, $polynomeB);
	$res = $c->listTerverse(false);
	echo "<pre>";
	print_r($res);
	echo "</pre>";
	echo $c->getLength();
?>