<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Sys_Room_Model
 *
 * @author andywu
 * @version $Id$
 */
class Sys_Room_Model extends MQ_Model
{
    /**
     *所属楼层ID
     * @var int
     */
    public $room_id;
    /**
     *房间名称
     * @var varchar
     */
    public $name;
    /**
     *房间类型
     * @var tinyint
     */
    public $type;
    /**
     *所属楼层ID
     * @var int
     */
    public $floor_id;
    /**
     *房间状态 0.为使用 1.可入住 2.已离寓未打扫 3.清扫中 4.已入住 5.房间有问题
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


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "sys_rooms";
        $this->_key = "room_id";
        $this->_name = "room_id";
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

/* End of file sys_room_model.php */
/* Location: ./application/models/sys_room_model.php */