<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Sys_Notice_Model
 *
 * @author andywu
 * @version $Id$
 */
class Sys_Notice_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $notice_id;
    /**
     *消息内容
     * @var varchar
     */
    public $content;
    /**
     *消息来源
     * @var varchar
     */
    public $source;
    /**
     *状态 0.未读 1.已读
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
    /**
     *用户id
     * @var int
     */
    public $user_id;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "sys_notices";
        $this->_key = "notice_id";
        $this->_name = "notice_id";
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

/* End of file sys_notice_model.php */
/* Location: ./application/models/sys_notice_model.php */