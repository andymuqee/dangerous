<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Dorm_Floor_Model
 *
 * @author andywu
 * @version $Id$
 */
class Dorm_Floor_Model extends MQ_Model
{
    /**
     *楼层ID
     * @var int
     */
    public $floor_id;
    /**
     *楼层名称
     * @var varchar
     */
    public $name;
    /**
     *所属公寓
     * @var int
     */
    public $department_id;
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
        $this->_table = "dorm_floors";
        $this->_key = "floor_id";
        $this->_name = "floor_id";
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

/* End of file dorm_floor_model.php */
/* Location: ./application/models/dorm_floor_model.php */