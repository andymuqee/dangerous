<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 用户类
 *
 * @author andywu
 * @version $Id$
 */
class Member extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('sys_user_Model');
    }

    /**
     * 登录页面
     */
    public function login()
    {
        $this->_data['r'] = @is_vail($_GET['redirect_url']) ? "?redirect_url=" . $_GET['redirect_url'] : '';
        $this->_v('sys/member/login.tpl.php');
    }

    /**
     * 登录处理
     *
     * @param  string   username
     * @param  string   password
     * @param  string   vaildcode
     * @return
     */
    public function login_do()
    {
        $info = array();
        $admin = array();
        $salesman = array();
        $params = array();


        $params = $this->p(array('username', 'password'), array('redirect_url'), true, function () {
            $info['state'] = "fail";
            $info['redirect_url'] = "/sys/member/login";
        });

        if (($admin = $this->check($params ['username'], md5($params ['password'])))) {
            $admin = $admin ? $admin : $salesman;
            $info['state'] = "success";
            $info['redirect_url'] = @is_vail($params['redirect_url']) ? $params['redirect_url'] : config_item('www_url');
            $this->session->set_userdata($admin);
        } else {
            $info['state'] = "fail";
            $info['redirect_url'] = "/sys/member/login";
        }

        echo json_encode($info);
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