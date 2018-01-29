<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 供货商类
 *
 * @author andywu
 * @version $Id$
 */
class Password extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('sys_user_Model');
        $this->_m('sys_role_model');
        $this->_m('sys_department_model');
        $this->_page_title = '个人中心';
    }

    /**
     * 页面
     */
    public function index()
    {
        $this->_page_subtitle = '修改密码';
        $this->_v('profile/password/index.tpl.php');
    }

    public function update()
    {
        $params = $this->p(array('user_id'), array(), true, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "参数错误") : show_error("页面错误");
        });
        $this->_page_subtitle = '设置密码';
        $this->_data['user_id'] = $params['user_id'];
        $this->_v('profile/password/update.tpl.php');
    }

    public function api()
    {
        $this->p(array('oldpassword'), array(), true, function () {
            echo 'false';
            exit;
        });
        if ($this->sys_user->is_exists_data(array('user_id' => $this->session->userdata('user_id'), 'password' => md5($this->_params['oldpassword'])))) {
            echo 'true';
        } else {
            echo 'false';
        }

        exit;
    }

    /**
     * 修改密码
     */
    public function save()
    {
        // 获取参数
        $params = $this->p(array('password'), array('user_id'), true, function () {
            api_error(400, '参数错误');
        });
        // 更新时间戳
        $this->_params['modified'] = time();
        // 密码加密之后赋值原密码
        $this->sys_user->password = assign_func($this->_params['password'], 'md5');
        // 设置更新用户ID
        $this->sys_user->user_id = is_vail($params['user_id']) ? $params['user_id'] : $this->session->userdata('user_id');
        // 更新用户密码
        $this->_data ['data'] = $this->sys_user->u();
        $this->_v();
    }


}

/* End of file supplier.php */
/* Location: ./application/controllers/sys/supplier.php */