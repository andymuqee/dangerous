<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Sys_Post_Management_Model
 *
 * @author andywu
 * @version $Id$
 */
class Sys_Post_Management_Model extends MQ_Model
{
    /**
     *岗位ID
     * @var int
     */
    public $pm_id;
    /**
     *岗位名称
     * @var varchar
     */
    public $name;
    /**
     *备注
     * @var varchar
     */
    public $remark;
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
     *所属部门id
     * @var int
     */
    public $department_id;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "sys_post_management";
        $this->_key = "pm_id";
        $this->_name = "pm_id";
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

/* End of file sys_post_management_model.php */
/* Location: ./application/models/sys_post_management_model.php */