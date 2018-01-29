<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitchen_Goods_Composition_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitchen_Goods_Composition_Model extends MQ_Model
{
    /**
     *原料组成ID
     * @var int
     */
    public $goods_composition_id;
    /**
     *原料ID
     * @var int
     */
    public $goods_id;
    /**
     *数量
     * @var int
     */
    public $nums;
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
     *
     * @var int
     */
    public $food_id;
    /**
     *json 数据格式 [{'type':'1','goods_id':'1','num':'2','unit':'1'}]type:1蔬菜2肉禽蛋3主食4调味品goods_id:对应表的id  num:数量  unit:计量单位 1公斤2斤3两4克
     * @var varchar
     */
    public $data;
    /**
     *调料包ID
     * @var int
     */
    public $bag_id;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitchen_goods_composition";
        $this->_key = "goods_composition_id";
        $this->_name = "goods_composition_id";
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

/* End of file kitchen_goods_composition_model.php */
/* Location: ./application/models/kitchen_goods_composition_model.php */