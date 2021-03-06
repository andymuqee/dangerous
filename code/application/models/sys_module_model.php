<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Sys_Module_Model
 *
 * @author andywu
 * @version $Id$
 */
class Sys_Module_Model extends MQ_Model
{
    /**
     *模块id
     * @var int
     */
    public $module_id;
    /**
     *模块名
     * @var varchar
     */
    public $module_name;
    /**
     *模块名英文
     * @var varchar
     */
    public $module_name_en;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "sys_module";
        $this->_key = "module_id";
        $this->_name = "module_id";
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

/* End of file sys_module_model.php */
/* Location: ./application/models/sys_module_model.php */