<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitch_Goods_Composition_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitch_Goods_Composition_Model extends MQ_Model
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


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitch_goods_composition";
        $this->_key = "goods_composition_id";
        $this->_name = "goods_id";
        //{models}
    }

    /**
     * 批量查询数据
     * @param array $params 查询参数
     * @return stdClass
     */
    public function lists(array $params)
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

/* End of file kitch_goods_composition_model.php */
/* Location: ./application/models/kitch_goods_composition_model.php */