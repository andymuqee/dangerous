<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Dorm_Checkin_Order_Model
 *
 * @author andywu
 * @version $Id$
 */
class Dorm_Checkin_Order_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $checkin_order_id;
    /**
     *所属宿舍公寓ID
     * @var int
     */
    public $department_id;
    /**
     *所属房间ID
     * @var int
     */
    public $room_id;
    /**
     *床位id
     * @var int
     */
    public $bed_status_id;
    /**
     *所属床号
     * @var int
     */
    public $bed_no;
    /**
     *申请人id
     * @var int
     */
    public $people_id;
    /**
     *申请人姓名
     * @var varchar
     */
    public $realname;
    /**
     *申请人单位
     * @var varchar
     */
    public $unitname;
    /**
     *申请人身份证
     * @var char
     */
    public $ID;
    /**
     *手机号
     * @var varchar
     */
    public $mobile;
    /**
     *家庭住址
     * @var varchar
     */
    public $address;
    /**
     *身体状况
     * @var varchar
     */
    public $physical_condition;
    /**
     *入住原因
     * @var varchar
     */
    public $reason;
    /**
     *办理类型 1.集中办理 2.个人办理
     * @var tinyint
     */
    public $transaction_type;
    /**
     *缴费类型 1.现金 2.转账 3.磨账 4.微信
     * @var tinyint
     */
    public $pay_type;
    /**
     *费用类型 1.宿费 2.押金 3.门卡押金
     * @var tinyint
     */
    public $fee_type;
    /**
     *住宿费
     * @var decimal
     */
    public $hotel_fee;
    /**
     *押金
     * @var decimal
     */
    public $deposit;
    /**
     *门卡押金
     * @var decimal
     */
    public $card_deposit;
    /**
     *附件1url地址
     * @var varchar
     */
    public $attachment_1;
    /**
     *附件2url地址
     * @var varchar
     */
    public $attachment_2;
    /**
     *附件3url地址
     * @var varchar
     */
    public $attachment_3;
    /**
     *附件4url地址
     * @var varchar
     */
    public $attachment_4;
    /**
     *办理类型 1.集中办理 2.个人办理
     * @var tinyint
     */
    public $type;
    /**
     *状态 1.申请 2.入住正式申请 3.业务科审批 4.财务科确认 5.负责领导确认 6.公寓管理人员制卡 7.入住完成
     * @var tinyint
     */
    public $status;
    /**
     *入住时间
     * @var char
     */
    public $checkin_time;
    /**
     *申请创建时间戳
     * @var char
     */
    public $created;
    /**
     *申请更新时间戳
     * @var char
     */
    public $modified;
    /**
     *
     * @var longtext
     */
    public $imgbase64;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "dorm_checkin_orders";
        $this->_key = "checkin_order_id";
        $this->_name = "checkin_order_id";
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

/* End of file dorm_checkin_order_model.php */
/* Location: ./application/models/dorm_checkin_order_model.php */