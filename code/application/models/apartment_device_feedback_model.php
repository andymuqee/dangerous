<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Apartment_Device_Feedback_Model
 *
 * @author andywu
 * @version $Id$
 */
class Apartment_Device_Feedback_Model extends MQ_Model
{
    /**
     *设备反馈ID
     * @var int
     */
    public $feedback_id;
    /**
     *所属公寓ID
     * @var int
     */
    public $department_id;
    /**
     *所属楼层
     * @var tinyint
     */
    public $floor;
    /**
     *所属房间号
     * @var varchar
     */
    public $room;
    /**
     *清扫人ID
     * @var int
     */
    public $user_id;
    /**
     *清扫人
     * @var varchar
     */
    public $realname;
    /**
     *处理说明主任ID
     * @var int
     */
    public $director_id;
    /**
     *处理说明主任名字
     * @var varchar
     */
    public $director;
    /**
     *班次
     * @var varchar
     */
    public $NO;
    /**
     *报修项目 json串
     * @var varchar
     */
    public $repair_item;
    /**
     *备注
     * @var varchar
     */
    public $remark;
    /**
     *处理说明
     * @var varchar
     */
    public $explain;
    /**
     *提报人反馈 1.销号办结 2.退回
     * @var tinyint
     */
    public $result;
    /**
     *处理步骤 1.保修 2.处理说明 3.提报人反馈
     * @var tinyint
     */
    public $status;
    /**
     *处理说明提交时间戳
     * @var char
     */
    public $explain_time;
    /**
     *提报人反馈时间戳
     * @var char
     */
    public $result_time;
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
        $this->_table = "apartment_device_feedback";
        $this->_key = "feedback_id";
        $this->_name = "feedback_id";
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

/* End of file apartment_device_feedback_model.php */
/* Location: ./application/models/apartment_device_feedback_model.php */