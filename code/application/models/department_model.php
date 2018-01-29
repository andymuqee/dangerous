<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Department_Model
 *
 * @author andywu
 * @version $Id$
 */
class Department_Model extends MQ_Model
{
    /**
     *部门id
     * @var int
     */
    public $department_id;
    /**
     *部门名称
     * @var varchar
     */
    public $name;
    /**
     *所属父部分
     * @var int
     */
    public $parent_id;
    /**
     *分类标识 0.车队 1.科室
     * @var tinyint
     */
    public $type;
    /**
     *
     * @var char
     */
    public $created;
    /**
     *
     * @var char
     */
    public $modified;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "department";
        $this->_key = "department_id";
        $this->_name = "department_id";
        //{models}
    }

    /**
     * 批量查询数据
     * @param array $params 查询参数
     * @return stdClass
     */
    public function lists(array $params)
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

/* End of file department_model.php */
/* Location: ./application/models/department_model.php */