<?php
/**
 * PHP实现栈
 * 2017/9/23
 */
class Stack
{
	private $stack = []; // 顺序栈
	private $top = -1; // 栈顶指针
	public function __construct()
	{
		$this->top = -1;
		$this->stack = [];
	}
	/**
	 * 出栈
	 * @param boolean $flag 用来判断出栈操作是否使用PHP自带的出栈函数,默认是不使用
	 * @return boolean false代表栈为空,无法取出元素
	 * @return mixed $elem 代表的是取出的元素值
	 */
	public function pop($flag = false)
	{
		/* 空栈 */
		if ($this->isEmpty()) {
			return false;
		} else {
			/* 使用PHP自带的函数 */
			if ($flag) {
				$this->top--;
				return array_pop($this->stack);				
			} else {
				$elem = $this->stack[$this->top--]; // 先赋值后自减
				return $elem;
			}			
		}	
	}
	/**
	 * 入栈
	 * @param mixed $elem 要插入的元素值
	 * @param boolean $flag 用来判断入栈操作是否使用PHP自带的入栈函数,默认是不适用
	 * @return boolean true表示入栈成功,false表示失败
	 */
	public function push($elem, $flag = false)
	{
		/* 元素是否存在判断 */
		if(!isset($elem)) return false;
		if ($flag) {
			array_push($this->stack, $elem);
			$this->top--;
		} else {
			$this->stack[++$this->top] = $elem; // 表达式的值先加一然后在自增
		}	
		return true;	
	}
	/**
	 * 取出栈顶元素
	 * @return mixed 栈顶元素
	 */
	public function getTop()
	{
		if ($this->isEmpty()) {
			return false;
		} else {
			return $this->stack[$this->top];
		}
	}
	/**
	 * 判断栈空
	 * @return boolean true代表是空栈 fasle代表不是空栈
	 */
	public function isEmpty()
	{
		return $this->top == -1 ? true : false;
	}
	/**
	 * 判断栈的长度
	 * @return int 返回长度
	 */
	public function getSize()
	{
		return $this->top;
	}
}


?>