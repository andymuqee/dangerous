<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 自动生产工具
 *
 * @author andywu
 * @version $Id: account.php 3574 2013-11-05 00:42:03Z wudi $
 */
class AutoTools extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     *
     * 默认页面
     *
     * @param
     *            string 手机号或者通通号
     * @return account
     */
    public function index()
    {
        echo dirname(__FILE__);
        exit ();
        $this->_v('autotools');
    }

    /**
     * 创建
     *
     * @param
     *            string 类名
     * @param
     *            string 注释
     */
    public function create()
    {
        $params = array();
        $required = array(
            'class_name',
            'annotate_name'
        );
        if ($params = $this->_params($required)) {
            // 根据参数结合模板生产代码文件

            $template = read_file();
            $ret = $this->account->get($params ['login'], $params ['password']);
            if (count($ret)) {
                $this->_data ['out'] = $ret;
                $this->_v();
            } else {
                api_error("", "用户不存在");
            }
        } else {
            api_error("1001", "param is not set: login, password");
        }
    }

    /**
     * 添加用户信息
     *
     * @param
     *            string mobile 手机号码
     * @param
     *            string nickname 昵称
     * @param
     *            string password 密码
     * @param
     *            string avatar 头像地址
     * @return Account
     */
    public function post()
    {
        $id = $lon = $lat = 0;
        $params = array();
        $data = array();
        $required = $this->account->get_fields();
        $required ['password'] = null;
        if ($params = $this->_params($required)) {
            if ($id = $this->account->add($params)) {
                $where = array(
                    'user_id',
                    $id
                );
                $this->_data ['out'] = $this->account->get_detail($where);
                $this->_v();
            } else {
                api_error("", "添加账户失败！");
            }
        } else {
            api_error("", "params is not set: mobile, nickname, password, avatar");
        }
    }

    /**
     * 用户密码修改
     *
     * @param
     *            integer 手机号码
     * @param
     *            string 密码
     * @return boolean
     */
    public function put()
    {
        $mobile = $password = '';
        if ($mobile = @is_vail($this->_params ['mobile']) and $password = @is_vail($this->_params ['password'])) {
            // 判断该手机用户是否存在
            if ($this->account->is_exists_value('mobile', $mobile)) {
                $where = array(
                    'mobile' => $mobile
                );
                $set = array(
                    'password' => $password
                );
                $this->_data ['out'] = $this->user->set_data_where($set, $where);
                $this->_v();
            } else {
                api_error("", "用户不存在!");
            }
        } else {
            api_error("1010", "param is not set: user_id");
        }
    }

    /**
     * 注销用户
     *
     * @param
     *            integer id 用户ID
     * @return boolean
     */
    public function delete()
    {
        $id = 0;
        if ($id = @is_vail($this->_params ['id'])) {
            // 注销
            $this->_v();
        } else {
            api_error("", "param is not set: id");
        }
    }
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */