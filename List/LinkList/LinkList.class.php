<?php
/**
 * 链表类
 * 9.15
 */

/**
 * 节点描述类
 */
class node {
	public $data; // 数据元素
	public $next; // 指向下一个元素的指针
	public function __construct($data = null) {
		$this->data = $data;
	}
}

/**
 * 单链表类
 */
class LinkList {
	public $head = null; // 头结点
	private static $length = 0; // 链表长度 
	/**
	 * 初始化头结点
	 * @return void
	 */
	public function __construct() {
		$this->head = new node(null);
	}
	/**
	 * 判断链表是否是空表
	 * return boolean true为不是空表, false为是空表
	 */
	public function isEmpty() {
		return self::$length > 0 ? true : false;
	}
	/**
	 * 获取链表长度
	 * @return int
	 */
	public function getLength() {
		$current = $this->head->next;
		$count = 0;
		while($current) {
			$count++;
			$current = $current->next;
		}
		self::$length = $count;
		return self::$length;
	}
	/**
	 * 头插法建立链表
	 * 实际顺序与输入顺序相反
	 * @param array 要输入的元素
	 * @return void
	 */
	public function createListByFront($arr) {
		// 元素类型判断
		if(!is_array($arr)) return false;
		// 判断是否是空表
		if($this->isEmpty()) return false;
		// 链表去空 
		$this->clearList(); 
		if(is_array($arr) && count($arr) > 0 ) {
			$current = $this->head;
			foreach ($arr as $value) {
				$new = new Node($value);
				$new->next = $current->next;
				$current->next = $new;
				self::$length++;
			}			
		} else {
			return false;
		}
		return true;
	}
	/**
	 * 尾插法
	 * 实际顺序与输入顺序相同
	 * @param array 要输入的元素
	 * @return void
	 */
	public function createListByTail($arr) {
		// 链表去空
		$this->clearList(); 
		// 元素类型判断
		if(!is_array($arr)) return false;
		// 判断是否是空表
		if($this->isEmpty()) return false;
		$current = $this->head;
		if(is_array($arr) && count($arr) > 0 ) {
			foreach ($arr as $value) {
				$new = new Node($value);
				$new->next = $current->next;
				$current->next = $new;
				$current = $new;
				self::$length++;
			}			
		} else {
			return false;
		}
		return true;		
	}
	/**
	 * 插入元素
	 * @param int $location 要插入的位置,从1开始
	 * @param mixed $data 要插入的数据
	 * @return void
	 */
	public function listInsert($location, $data) {
		// 判断位置
		if ($location <= 0 || $location > self::$length) {
			return false;
		}
		$new = new Node($data);
		$index = 1;
		$current = $this->head; // 定位指针
		while($index < $location) {
			$current = $current->next;
			$index++;
		}
		/* 插入元素 */
		$new->next = $current->next;
		$current->next = $new;
		self::$length++;
		return true;
	}
	/**
	 * 删除元素
	 * @param int $location 待删除的位置
	 * @return boolean true代表删除成功
	 */
	public function listDelete($location) {
		// 输入类型判断
		if(!is_numeric($location)) return false;
		// 判断位置
		if ($location <= 0 || $location > self::$length) {
			return false;
		}
		$current = $this->head;
		$index = 1;
		while($index < $location) {
			$current = $current->next;
			$index++;
		}	
		/* 删除操作 */
		$wait_delete = $current->next;
		$current->next = $wait_delete->next;
		unset($wait_delete);
		self::$length--;
		return true;
	}
	/**
	 * 查找元素
	 * @param int $location 待查找的位置
	 * @param boolean $flag 决定返回值的类型 true返回数据元素 false返回指针
	 * @return mixed 根据$flag决定
	 */
	public function listSearch($location, $flag = true) {
		// 判断参数属性
		if(!is_numeric($location)) return false;
		// 判断位置
		if ($location <= 0 || $location > self::$length) {
			return false;
		}
		$current = $this->head;
		$index = 1;
		while($index < $location) {
			$current = $current->next;
			$index++;
		}
		return $flag ? $current->next->data : $current->next;	
	}
	/**
	 * 根据元素值来定位元素
	 * @param mixed $value 待查找的元素
	 * @param boolean $flag 决定返回值的类型 true返回数据元素 false返回指针
	 * @return mixed 根据$flag决定
	 */
	public function locateElem($value, $flag = true) {	
		// 判断元素是否存在
		if(!$value) return false;	
		if ($flag) { /* 返回位置 */
			$current = $this->head;
			$index = 1;
			while($current->next) {
				if($current->next->data == $value) {
					return $index;
				} else {
					$current = $current->next;
					$index++;
				}
			}
		} else { /* 返回指针 */
			$current = $this->head;
			while($current->next) {
				if($current->next->data == $value) {
					return $current->next;
				} else {
					$current = $current->next;
				}
			}
		}		
	}
	/**
	 * 修改第i个元素的值
	 * @param int $location 修改元素的位置
	 * @param miexed $value 新的元素值
	 * @return boolean true代表修改成功
	 */
	public function updateListByLocation($location, $value) {
		// 判断参数属性
		if(!is_numeric($location)) return false;
		// 判断位置
		if ($location <= 0 || $location > self::$length) {
			return false;
		}
		// 查找元素
		$point = $this->listSearch($location, false);
		$point->data = $value;		
	}
	/**
	 * 链表遍历
	 * @param boolean $flag true为输出 false为返回数组
	 * @return mixed
	 */
	public function listTerverse($flag = true) {
		$current = $this->head;
		if ($flag) {
			$str = '';
			if(self::$length == 0){
				echo '空表'; 
				return null;
			} 
			while($current && $current->next) {
				$str .= "-------".$current->next->data;
				$current = $current->next;
			}
			echo $str;		
			return null;	
		} else {
			$list = [];
			if(self::$length == 0) return [];
			while($current && $current->next) {
				$list[] = $current->next->data;
				$current = $current->next;
			}
			return $list;
		}
	}
	/**
	 * 清空链表
	 * @return boolean
	 */
	public function clearList() {
		if(!$this->isEmpty()) return false;
		//$current = $this->head->next; 这样会导致双重传递，并不会删除元素 因为next属性本身就是一个指针
		while($this->head->next) {
			$q = $this->head->next->next;
			$this->head->next = null;
			unset($this->head->next);
			$this->head->next = $q;
		 }
		self::$length = 0; 
		return true;
	}
}
// class Test{
// 	public $a = 0;
// 	public function __construct($a){
// 		$this->a = $a;
// 	}		
// }
// $a1 = new Test(1);
// $a2 = $a1;
// $a2->a = 10;
//  $a2 = null;
//  unset($a2);
// echo $a1->a;
// exit;
// $test = new LinkList();
// // 创建链表
// $test->createListByTail([10, 15, 20, 30]);
// //print_r($test->listTerverse(false));
// //$test->updateListByLocation(1, 100);
// //$test->listDelete(4);

// echo $test->listTerverse();
// $test->clearList();
// //echo $test->listSearch(1);
// echo $test->listTerverse();echo "<br>";
// //echo $test->listSearch(1);echo "<br>";
// //$test->listInsert(3, 25);
// exit;
// // 链表遍历
// //$test->listTerverse();echo "<br>";
// // 按照位置查找元素
// //echo $test->listSearch(1);echo "<br>";
// // 插入元素
// $test->listInsert(3, 25);
// $test->listTerverse();echo "<br>";
// // 删除元素
// $test->listDelete(2);
// $test->listTerverse();echo "<br>";
// // 定位元素
// echo $test->locateElem(10);
// // 获取长度
// echo $test->getLength();
?>