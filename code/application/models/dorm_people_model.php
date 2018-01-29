<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Dorm_People_Model
 *
 * @author andywu
 * @version $Id$
 */
class Dorm_People_Model extends MQ_Model
{
    /**
     *宿舍人员档案id
     * @var int
     */
    public $people_id;
    /**
     *宿舍人员姓名
     * @var varchar
     */
    public $realname;
    /**
     *0.未知 1.男 2.女
     * @var tinyint
     */
    public $sex;
    /**
     *职名
     * @var varchar
     */
    public $title;
    /**
     *身份证号
     * @var varchar
     */
    public $ID;
    /**
     *民族
     * @var varchar
     */
    public $nation;
    /**
     *所属单位名称
     * @var varchar
     */
    public $unitname;
    /**
     *联系电话
     * @var varchar
     */
    public $mobile;
    /**
     *照片地址
     * @var varchar
     */
    public $photo_url;
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
        $this->_table = "dorm_peoples";
        $this->_key = "people_id";
        $this->_name = "people_id";
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

/* End of file dorm_people_model.php */
/* Location: ./application/models/dorm_people_model.php */