<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Dorm_Credit_Record_Model
 *
 * @author andywu
 * @version $Id$
 */
class Dorm_Credit_Record_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $credit_record_id;
    /**
     *所属离宿
     * @var int
     */
    public $checkout_order_id;
    /**
     *所属宿舍id
     * @var int
     */
    public $department_id;
    /**
     *所属楼层ID
     * @var int
     */
    public $floor_id;
    /**
     *
     * @var int
     */
    public $bed_status_id;
    /**
     *所属房间ID
     * @var int
     */
    public $room_id;
    /**
     *所属床号
     * @var tinyint
     */
    public $bed_no;
    /**
     *入住人ID
     * @var int
     */
    public $people_id;
    /**
     *评价
     * @var text
     */
    public $evaluate;
    /**
     *分数 5分满
     * @var int
     */
    public $score;
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
        $this->_table = "dorm_credit_records";
        $this->_key = "credit_record_id";
        $this->_name = "credit_record_id";
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

/* End of file dorm_credit_record_model.php */
/* Location: ./application/models/dorm_credit_record_model.php */