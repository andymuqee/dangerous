<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitchen_Good_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitchen_Good_Model extends MQ_Model
{
    /**
     *用料ID
     * @var int
     */
    public $goods_id;
    /**
     *用料名称
     * @var varchar
     */
    public $name;
    /**
     *类型 1.蔬菜 2.肉蛋禽 3.主食4.调味料5.调料包
     * @var tinyint
     */
    public $type;
    /**
     *净料率
     * @var decimal
     */
    public $goods_rate;
    /**
     *废弃率
     * @var decimal
     */
    public $reject_rate;
    /**
     *投料量
     * @var int
     */
    public $dosage;
    /**
     *投放标准
     * @var int
     */
    public $dosage_standard;
    /**
     *吃水量
     * @var int
     */
    public $water_intake;
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
     *出成率
     * @var decimal
     */
    public $yield;
    /**
     *备注
     * @var varchar
     */
    public $remark;
    /**
     *价格
     * @var decimal
     */
    public $price;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitchen_goods";
        $this->_key = "goods_id";
        $this->_name = "goods_id";
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

/* End of file kitchen_good_model.php */
/* Location: ./application/models/kitchen_good_model.php */