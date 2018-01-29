<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitchen_Today_Menu_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitchen_Today_Menu_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $menu_id;
    /**
     *菜品ID
     * @var int
     */
    public $food_id;
    /**
     *菜品名
     * @var varchar
     */
    public $food_name;
    /**
     *所属公寓ID
     * @var int
     */
    public $department_id;
    /**
     *所属公寓名称
     * @var varchar
     */
    public $department_name;
    /**
     *菜品类别 1.热菜 2.炖菜 3.主食 4.炝拌菜 5.回民
     * @var tinyint
     */
    public $category;
    /**
     *菜品url
     * @var varchar
     */
    public $pic;
    /**
     *简介
     * @var varchar
     */
    public $remark;
    /**
     *可做份数
     * @var int
     */
    public $cooking_nums;
    /**
     *剩余份数
     * @var int
     */
    public $surplus_nums;
    /**
     *单价
     * @var decimal
     */
    public $price;
    /**
     *创建时间戳
     * @var char
     */
    public $created;
    /**
     *更新时间戳
     * @var char
     */
    public $modified;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitchen_today_menu";
        $this->_key = "menu_id";
        $this->_name = "menu_id";
        //{models}
    }

    /**
     * 批量查询数据
     * @param array $params 查询参数
     * @return stdClass
     */
    public function lists($params = array('where' => array(),
        'fields' => array(),
        'order' => array(),
        'page' => null,
        'pagenums' => null))
    {
        // todo where
        return $this->get_lists($params['where'], $params['fields'], $params['order'], $params['page'], $params['pagenums']);
    }

    public function update($values)
    {
        $where = array($this->_key => $values[$this->_key]);
        $res = $this->db->update($this->_table, $values, $where, $orderby = array(), $limit = FALSE);
        return $res;
    }

    public function update_batch($values)
    {

        $where = array(//'is_del' =>0,

        );
        $this->db->update_batch($this->_table, $values, $this->_key, $where);

    }
}

/* End of file kitchen_today_menu_model.php */
/* Location: ./application/models/kitchen_today_menu_model.php */