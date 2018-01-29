<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitchen_Food_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitchen_Food_Model extends MQ_Model
{
    /**
     *菜品ID
     * @var int
     */
    public $food_id;
    /**
     *菜品名称
     * @var varchar
     */
    public $name;
    /**
     *菜品类别 1.热菜 2.炖菜 3.主食 4.炝拌菜 5.回民
     * @var tinyint
     */
    public $category;
    /**
     *菜品图片url
     * @var varchar
     */
    public $pic;
    /**
     *备注
     * @var varchar
     */
    public $remark;
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
    /**
     *类型 1.热菜2.炖菜3.主食4.炝拌菜5.回民菜谱
     * @var tinyint
     */
    public $type;
    /**
     *菜品类型1 菜品 2调料包
     * @var tinyint
     */
    public $food_type;
    /**
     *当前菜品所需的调料包 id 就是本表的food_id
     * @var int
     */
    public $bag_id;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitchen_foods";
        $this->_key = "food_id";
        $this->_name = "food_id";
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

/* End of file kitchen_food_model.php */
/* Location: ./application/models/kitchen_food_model.php */