<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Sys_User_Model
 *
 * @author andywu
 * @version $Id$
 */
class Sys_User_Model extends MQ_Model
{
    /**
     *用户ID
     * @var int
     */
    public $user_id;
    /**
     *用户名
     * @var varchar
     */
    public $username;
    /**
     *密码
     * @var varchar
     */
    public $password;
    /**
     *真名
     * @var varchar
     */
    public $realname;
    /**
     *所属角色ID
     * @var int
     */
    public $role_id;
    /**
     *所属岗位ID
     * @var int
     */
    public $post_id;
    /**
     *所属岗位ID
     * @var int
     */
    public $team_id;
    /**
     *所属岗位ID
     * @var int
     */
    public $salary_no;
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

    public $avatar;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "sys_users";
        $this->_key = "user_id";
        $this->_name = "username";
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

/* End of file sys_user_model.php */
/* Location: ./application/models/sys_user_model.php */