<?php
class sqList {
    public $list = null; // 顺序表
    /**
     * 初始化线性表
     * @param array $list
     * @return void
     */
    public function __construct(&$list) {
        if (!is_array($list))
            return false;
        $this->list = $list;
    }
    /**
     * 求表长
     * @return int
     */
    public function listLength() {
        return count($this->list);
    }
    /**
     * 查找元素
     * @param mixed $elem 线性表内的元素
     * @return int 
     */
    public function locateElem($elem) {
        foreach ($this->list as $v => $k) {
            if ($k == $elem) {
                return $v+1;
            } else {
                continue;
            }            
        }
        return -1;
    }
    /**
     * 在线性表第i个位置插入元素$elem
     * @param int 位置索引从1开始
     * @param mixed $elem
     * @return boolean true代表插入成功 false反之
     */
    public function listInsert($i, $elem) {
        $i = $i - 1;
        /* 位置判断 */
        if ($i < 0 || $i > $this->listLength())
            return false;
        /* 待插入的元素判断 */
        if (!isset($elem)) 
            return false;
        /* 插入元素 */
        $j = $this->listLength() - 1;
        for (; $j >= $i; $j--) {
            $this->list[$j+1] = $this->list[$j];
        }
        $this->list[$i] = $elem;
        return true;
    }
    /**
     * 删除第i个元素
     * @param int $i 从1开始的位置
     */
    public function listDelete($i) {
        /* 位置判断 */
        if ($i <= 0 || $i > $this->listLength())
            return false;
        array_splice($this->list, $i-1, 1); // 不能使用unset()函数,这样会破坏数组下标的连续性
    }
    /**
     * 读取第i个元素
     * @param int $i 从1开始的位置
     */
    public function getElem($i) {
        /* 位置判断 */
        if ($i <= 0 || $i > $this->listLength())
            return false;
        /* 判断是不是空表 */
        if ($this->listLength() == 0)
            return false;
        return $this->list[$i -1];
    }
    /**
     * 遍历元素
     * return void
     */
    public function listTraverse() {
        if (!empty($this->list)) {
            foreach ($this->list as $v => $k) {
                echo $k.'<br>';
            }            
        } else {
            echo '顺序表无元素';
        }
    }
    /**
     * 撤销操作
     */
    public function destoryList() {
        unset($this->list);
    }
}
?>