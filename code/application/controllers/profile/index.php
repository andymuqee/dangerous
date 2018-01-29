<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 用户类
 *
 * @author andywu
 * @version $Id$
 */
class Index extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('Sys_User_Model');
        $this->_m('Sys_Team_Model');
        $this->_m('Sys_Role_Model');
        $this->_m('Sys_Post_Management_Model');

    }

    /**
     * 登录处理
     *
     * @param  string   username
     * @param  string   password
     * @param  string   vaildcode
     * @return
     */
    public function index()
    {
        $this->layout('个人信息', '个人资料');

        $userId = $this->session->userdata('user_id');
        $this->sys_user->user_id = $userId;
        $this->_data['data'] = $this->sys_user->g();
        $this->_data['team_name'] = $this->sys_team->name($this->_data['data']->team_id);
        $this->sys_role->role_id = $this->_data['data']->role_id;
        $this->_data['role_name'] = $this->sys_role->g()->name;
        $this->sys_post_management->pm_id = $this->_data['data']->post_id;
        $this->_data['past_name'] = $this->sys_post_management->g()->name;
        $this->_v('profile/index.tpl.php');
    }

    /**
     * 登录界面
     *
     * @param
     *            string 名称
     * @param
     *            string 需要获得字段的列表名称
     * @return string
     * @example http://api.erp.ttzg.com/login/post?
     *          supplier_name=1&
     *          supplier_contact=侯晓宇&
     *          supplier_tel=024-832323&
     *          contury_code=086&
     *          city_code=024&
     *          address=青年大街51号B座25楼&
     */
    public function post()
    {
        $params = array();
        $required = array(
            'administartor_id'
        );
        $optional = array();


        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0102, "param is not set: ", $required);
        }
        $params ['updatetime'] = now();
        $params ['createtime'] = now();
        $this->administrator->assign($params);
        $this->_data ['out'] = $this->administrator->a();
        $this->_v();
    }

    /**
     * 注销
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/sys/member/login');
    }

    /*
     * 原来写在model的login方法
     * */
    public function check($username, $password)
    {
        $where = array(
            'username' => $username,
            'password' => $password
        );
        return @is_vail($this->sys_user->get_detail($where));
    }


}

/* End of file member.php */
/* Location: ./application/controllers/sys/member.php */