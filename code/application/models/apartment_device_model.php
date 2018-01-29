<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Apartment_Device_Model
 *
 * @author andywu
 * @version $Id$
 */
class Apartment_Device_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $device_id;
    /**
     *设备名称
     * @var varchar
     */
    public $name;
    /**
     *类型 1.备品 2.设备
     * @var tinyint
     */
    public $type;
    /**
     *公共区域id
     * @var int
     */
    public $area_id;
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
     *部门ID
     * @var int
     */
    public $department_id;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "apartment_devices";
        $this->_key = "device_id";
        $this->_name = "device_id";
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

/* End of file apartment_device_model.php */
/* Location: ./application/models/apartment_device_model.php */