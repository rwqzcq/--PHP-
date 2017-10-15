<?php
// 删除数组元素并重新索引
//array_splice($arr, $index, 1);
/**
 * PHP 实现的循环队列
 * date: 2017/10/15
 */ 
class Queue
{
	private $queue = []; // 队列
	private $front = 0; // 队首指针
	private $rear = 0; // 队尾指针
	private $size = 0; // 队列长度
	public function __get($key)
	{
		return $this->$key;
	}
	/**
	 * 初始化队列
	 * @param int $size 队列的长度
	 * @return void
	 */
	public function __construct($size)
	{
		if(!is_int($size)) exit('请输入数字');
		$this->front = $this->rear = 0;
		$this->queue = [];
		$this->size = $size+1; // 少用一个存储单元
	}
	/**
	 * 求队列的长度
	 * @return void
	 */
	public function getLength()
	{
		return ($this->rear-$this->front+$this->size) % $this->size;
	}
	/**
	 * 入队
	 * @param mixed $item 要插入的元素
	 * @return void
	 */
	public function enQueue($item)
	{
		// 入队判满
		if(($this->rear+1) % $this->size == $this->front) {
			exit("队列已经满了");
		} else {
			$this->queue[$this->rear] = $item;
			$this->rear = ($this->rear+1) % $this->size; // 依环装加1
		}

	}
	/**
	 * 队尾元素出队
	 * @return mixed $item 队尾元素
	 */
	public function deQueue()
	{
		// 出队判空
		if($this->front == $this->rear) {
			exit("队列为空");
		} else {
			$item = $this->queue[$this->front];
			unset($this->queue[$this->front]);
			$this->front = ($this->front+1) % $this->size;
			return $item;
		}
	}
	/**
	 * 取队首元素
	 * @return mixed 队首元素
	 */
	public function getHead()
	{
		// 判队空
		if($this->front == $this->rear) {
			exit("队列为空");
		} else {
			return $this->queue[$this->front];
		}		
	}
	/**
	 * 取队尾元素
	 * @return mixed 队尾元素
	 */
	public function getRear()
	{
		// 判空
		if($this->front == $this->rear) {
			exit("队列为空");
		} else {
			return $this->queue[$this->rear];
		}		
	}
	/**
	 * 清空队列
	 */
	public function clearQueue()
	{
		$this->queue = [];
		$this->front = $this->rear = 0;
		$this->size = 0;
		return true;
	}
}

?>