<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * User_Model
 *
 * @author andywu
 * @version $Id$
 */
class User_Model extends MQ_Model
{
    /**
     *用户id
     * @var int
     */
    public $user_id;
    /**
     *姓名
     * @var varchar
     */
    public $name;
    /**
     *所属部门id
     * @var int
     */
    public $department_id;
    /**
     *性别 1.男 2.女
     * @var tinyint
     */
    public $gender;
    /**
     *身份证号
     * @var varchar
     */
    public $ID;
    /**
     *头像地址
     * @var varchar
     */
    public $avatar;
    /**
     *职称
     * @var tinyint
     */
    public $title_id;
    /**
     *所属班组id
     * @var int
     */
    public $team_id;
    /**
     *所属线路id
     * @var int
     */
    public $line_id;
    /**
     *工资编号
     * @var varchar
     */
    public $salary_sn;
    /**
     *政治面貌 1.中共党员 2.中共预备党员 3.共青团员 4.民革党员 5.民盟盟员 6.民建会员 7.民进会员 8.农工党党员 9.致公党党员 10.九三学社社员 11.台盟盟员 12.无党派民主人士 13.群众（现称普通公民）
     * @var varchar
     */
    public $political_landscape;
    /**
     *参加工作时间
     * @var char
     */
    public $take_work_time;
    /**
     *个人所属设备 json序列化 [{'device_name':'手台', 'num':2, 'remarks':''}]
     * @var varchar
     */
    public $owned_devices;
    /**
     *个人奖惩 json序列化
     * @var varchar
     */
    public $reward_punishment;
    /**
     *培训记录
     * @var varchar
     */
    public $training_record;
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
        $this->_table = "user";
        $this->_key = "user_id";
        $this->_name = "user_id";
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

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */