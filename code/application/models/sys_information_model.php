<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Sys_Information_Model
 *
 * @author andywu
 * @version $Id$
 */
class Sys_Information_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $information_id;
    /**
     *标题
     * @var varchar
     */
    public $title;
    /**
     *信息类型 1.动态信息 2.公告 3.通知
     * @var tinyint
     */
    public $type;
    /**
     *描述
     * @var varchar
     */
    public $summary;
    /**
     *内容
     * @var text
     */
    public $content;
    /**
     *发布者user_id
     * @var int
     */
    public $publish_user_id;
    /**
     *发布给目标公寓id，用逗号分隔
     * @var int
     */
    public $to_apartment_ids;
    /**
     *浏览次数
     * @var int
     */
    public $view_nums;
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
     *紧急通知 1是0否
     * @var tinyint
     */
    public $emergency;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "sys_informations";
        $this->_key = "information_id";
        $this->_name = "information_id";
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

/* End of file sys_information_model.php */
/* Location: ./application/models/sys_information_model.php */