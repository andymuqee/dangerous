<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Sys_Public_Area_Model
 *
 * @author andywu
 * @version $Id$
 */
class Sys_Public_Area_Model extends MQ_Model
{
    /**
     *区域ID
     * @var int
     */
    public $area_id;
    /**
     *公共区域类型 1.公共卫生间 2.电视机 3.活动室 4.阅览室 5.学习会议室 6.更衣室 7.服务室 8.大厅 9.理疗室 10.超市货架 11.自助洗衣房 12.浴池
     * @var tinyint
     */
    public $type;
    /**
     *所属部门
     * @var int
     */
    public $department_id;
    /**
     *所属楼层
     * @var int
     */
    public $floor_id;
    /**
     *操作者用户ID
     * @var int
     */
    public $operator_user_id;
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
     * @var varchar
     */
    public $name;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "sys_public_areas";
        $this->_key = "area_id";
        $this->_name = "area_id";
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

/* End of file sys_public_area_model.php */
/* Location: ./application/models/sys_public_area_model.php */