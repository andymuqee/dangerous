<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitchen_Condiment_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitchen_Condiment_Model extends MQ_Model
{
    /**
     *调料ID
     * @var int
     */
    public $condiment_id;
    /**
     *调料名称
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


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitchen_condiment";
        $this->_key = "condiment_id";
        $this->_name = "name";
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

/* End of file kitchen_condiment_model.php */
/* Location: ./application/models/kitchen_condiment_model.php */