<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Dorm_Department_Model
 *
 * @author andywu
 * @version $Id$
 */
class Dorm_Department_Model extends MQ_Model
{
    /**
     *部门或公寓ID
     * @var int
     */
    public $department_id;
    /**
     *所属上级部门 默认0为一级
     * @var int
     */
    public $parent_id;
    /**
     *所属上级部门路径 用逗号分隔。如1,15,30
     * @var varchar
     */
    public $parent_path;
    /**
     *部门或公寓名称
     * @var varchar
     */
    public $name;
    /**
     *类型 1.公寓 2.部门 3.宿舍
     * @var tinyint
     */
    public $type;
    /**
     *公寓或部门负责人
     * @var varchar
     */
    public $director;
    /**
     *联络电话 多个电话用逗号分隔
     * @var varchar
     */
    public $office_phone;
    /**
     *值班电话
     * @var varchar
     */
    public $duty_phone;
    /**
     *建筑面积
     * @var decimal
     */
    public $built_area;
    /**
     *房间数
     * @var int
     */
    public $room_nums;
    /**
     *公寓照片 图片间用逗号分隔
     * @var varchar
     */
    public $pics;
    /**
     *备注或简介
     * @var varchar
     */
    public $remark;
    /**
     *新建时间戳
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
        $this->_table = "dorm_departments";
        $this->_key = "department_id";
        $this->_name = "department_id";
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

/* End of file dorm_department_model.php */
/* Location: ./application/models/dorm_department_model.php */