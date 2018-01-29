<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitchen_Team_Warehouse_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitchen_Team_Warehouse_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $team_warehouse_id;
    /**
     *所属班组ID
     * @var int
     */
    public $department_id;
    /**
     *班组称
     * @var varchar
     */
    public $department_name;
    /**
     *库房类型 1.主食库 2.副食库 3.调味品库 4.炝拌菜谱
     * @var tinyint
     */
    public $type;
    /**
     *基础库类型 1.蔬菜 2.肉蛋禽 3.主食 4.调味品
     * @var tinyint
     */
    public $base_type;
    /**
     *交接人用户ID
     * @var int
     */
    public $receiver_user_id;
    /**
     *交接人姓名
     * @var int
     */
    public $receiver;
    /**
     *所属品名ID
     * @var int
     */
    public $goods_id;
    /**
     *所属品名
     * @var varchar
     */
    public $goods_name;
    /**
     *规格
     * @var varchar
     */
    public $special;
    /**
     *重量
     * @var decimal
     */
    public $weight;
    /**
     *数量
     * @var int
     */
    public $quantity;
    /**
     *单价
     * @var decimal
     */
    public $price;
    /**
     *总价
     * @var decimal
     */
    public $total_price;
    /**
     *照片
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


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitchen_team_warehouses";
        $this->_key = "team_warehouse_id";
        $this->_name = "team_warehouse_id";
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

/* End of file kitchen_team_warehouse_model.php */
/* Location: ./application/models/kitchen_team_warehouse_model.php */