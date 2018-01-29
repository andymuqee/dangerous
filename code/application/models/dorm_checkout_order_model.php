<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Dorm_Checkout_Order_Model
 *
 * @author andywu
 * @version $Id$
 */
class Dorm_Checkout_Order_Model extends MQ_Model
{
    /**
     *离寓ID
     * @var int
     */
    public $checkout_order_id;
    /**
     *
     * @var int
     */
    public $department_id;
    /**
     *
     * @var int
     */
    public $room_id;
    /**
     *
     * @var tinyint
     */
    public $bed_no;
    /**
     *
     * @var int
     */
    public $people_id;
    /**
     *状态 1.申请离寓 2.备品完备 3.费用结清 4.业务科确认 5.办理完成
     * @var tinyint
     */
    public $status;
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
    public $bed_status_id;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "dorm_checkout_orders";
        $this->_key = "checkout_order_id";
        $this->_name = "checkout_order_id";
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

/* End of file dorm_checkout_order_model.php */
/* Location: ./application/models/dorm_checkout_order_model.php */