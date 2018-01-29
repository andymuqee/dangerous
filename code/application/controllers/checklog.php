<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 检查记录类
 *
 * @author andywu
 * @version $Id$
 */
class Checklog extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('sys_item_model');
        $this->_m('sys_place_model');
        $this->_m('sys_check_log_model');
    }

    /**
     * 页面
     */
    public function index()
    {
        /**
         * 如果参数不满足，则返回错误信息
         */

        $params = $this->p(array(), array('page', 'pagenums', 'kw', 'ajax'), false, function () {
            show_error("页面错误");
        });
        $this->layout('报表', '检查记录');
        $params['where'] = array();
        if ($params['kw']) $params['where']['place_id like'] = "%" . $params['kw'] . "%";
        $params['fields'] = array();
        $params['order'] = array();
        $params['page'] = is_vail($params['page']) ? $params['page'] : 1;
        $params['pagenums'] = is_vail($params['pagenums']) ? $params['pagenums'] : 20;
        $ret = $this->sys_check_log->lists($params);
        foreach ($ret as $v) {
            $v->item_name = $this->sys_item->name($v->item_id);
            $v->place_name = $this->sys_place->name($v->place_id);
        }
        /***分页***/
        $this->_data ['page_tpl'] = $this->page($this->sys_check_log, $params);
        /***分页结束***/
        $this->_data ['data'] = $ret;
        $params['ajax'] == 'true' ? $this->_v() : $this->_v('sys/user/index.tpl.php');
    }

    public function edit()
    {
        $optional = array('user_id');

        $params = $this->_optional_params($optional);
        if ($params['user_id']) {
            $this->_data['data'] = $this->sys_user->get_detail(array('user_id' => $params['user_id']), array());
            $this->layout('系统设置', '用户编辑');
        } else
            $this->layout('系统设置', '用户添加');
        /*************/
        $params = array('where' => array(),
            'page' => null,
            'pagenums' => null,
            'order' => array(),
            'fields' => array());
        $this->_data['post'] = $this->sys_post_management->lists($params);
        $this->_data['role'] = $this->sys_role->lists($params);
        $this->_data['department'] = $this->sys_department->lists($params);
        /*************/


        $this->_v('sysconfig/user/edit.tpl.php');
    }

    public function save()
    {
        $required = array(
            'username'
        );
        $optional = array(

            'user_id',
            'department_id',
            'role_id',
            'post_id',
            'remark',
            'password',
            'realname'

        );


        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(400, "param is not set: ", $required);
        }
        $params['modified'] = time();
        if ($params['password'])
            $params['password'] = md5($params['password']);
        if ($params['user_id']) {
            $this->sys_user->assign($params);
            $this->_data ['out'] = $this->sys_user->u();
        } else {
            $params['created'] = time();
            $this->sys_user->assign($params);
            $this->_data ['out'] = $this->sys_user->a();
        }

        if (!$this->_data ['out']) {
            api_error(false, '修改失败');

        } else $this->redirect('/sysconfig/user/index', '保存成功');
//		$this->_data ['msg'] = '修改成功';
//		$this->_v ();
    }

    public function delete()
    {
        $params = array();
        $required = array(
            'user_id',
        );
        $optional = array();
        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0104, "param is not set: ", $required);
        }
        $this->sys_user->assign($params);
        $this->_data ['out'] = $this->sys_user->d();
        $this->redirect('/sysconfig/user/index', '删除成功');
    }

}

/* End of file supplier.php */
/* Location: ./application/controllers/sys/supplier.php */