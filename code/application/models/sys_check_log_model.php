<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Sys_Check_Log_Model
 *
 * @author andywu
 * @version $Id$
 */
class Sys_Check_Log_Model extends MQ_Model
{
    /**
     *{
     * @var int
     */
    public $check_log_id;
    /**
     *
     * @var int
     */
    public $check_user_id;
    /**
     *
     * @var int
     */
    public $place_id;
    /**
     *
     * @var int
     */
    public $item_id;
    /**
     *
     * @var int
     */
    public $team_id;
    /**
     *
     * @var varchar
     */
    public $img_url;
    /**
     *
     * @var int
     */
    public $nums;
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
        $this->_table = "sys_check_logs";
        $this->_key = "check_log_id";
        $this->_name = "place_id";
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

/* End of file sys_check_log_model.php */
/* Location: ./application/models/sys_check_log_model.php */