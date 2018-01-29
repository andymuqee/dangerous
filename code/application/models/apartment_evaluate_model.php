<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Apartment_Evaluate_Model
 *
 * @author andywu
 * @version $Id$
 */
class Apartment_Evaluate_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $evaluate_id;
    /**
     *被评价公寓id
     * @var int
     */
    public $department_id;
    /**
     *评价人持有ic卡号
     * @var varchar
     */
    public $evaluate_ic;
    /**
     *评价人姓名
     * @var varchar
     */
    public $evaluate_person;
    /**
     *服务环境满意度 1.满意 2.基本满意 3.不满意
     * @var tinyint
     */
    public $environment;
    /**
     *文明服务 1.满意 2.基本满意 3.不满意
     * @var tinyint
     */
    public $service;
    /**
     *饭菜质量 1.满意 2.基本满意 3.不满意
     * @var tinyint
     */
    public $quality;
    /**
     *卫生质量 1.满意 2.基本满意 3.不满意
     * @var tinyint
     */
    public $health;
    /**
     *建议
     * @var varchar
     */
    public $suggest;
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
        $this->_table = "apartment_evaluates";
        $this->_key = "evaluate_id";
        $this->_name = "evaluate_id";
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

/* End of file apartment_evaluate_model.php */
/* Location: ./application/models/apartment_evaluate_model.php */