<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Dorm_Payment_Registration_Model
 *
 * @author andywu
 * @version $Id$
 */
class Dorm_Payment_Registration_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $payment_registration_id;
    /**
     *所属宿舍ID
     * @var int
     */
    public $department_id;
    /**
     *所属楼层ID
     * @var int
     */
    public $floor_id;
    /**
     *所属房间ID
     * @var int
     */
    public $room_id;
    /**
     *所属床ID
     * @var int
     */
    public $bed_id;
    /**
     *所属床号
     * @var int
     */
    public $bed_no;
    /**
     *入住人ID
     * @var int
     */
    public $people_id;
    /**
     *入住人姓名
     * @var varchar
     */
    public $realname;
    /**
     *缴费金额
     * @var decimal
     */
    public $fee;
    /**
     *缴费类型 1.宿舍费 2.水费 3.电费
     * @var tinyint
     */
    public $type;
    /**
     *缴费日期
     * @var char
     */
    public $fee_date;
    /**
     *是否清楚 0.不清除 1.清除
     * @var tinyint
     */
    public $is_del;
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
        $this->_table = "dorm_payment_registration";
        $this->_key = "payment_registration_id";
        $this->_name = "department_id";
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

/* End of file dorm_payment_registration_model.php */
/* Location: ./application/models/dorm_payment_registration_model.php */