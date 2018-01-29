<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 用户类
 *
 * @author andywu
 * @version $Id$
 */
class User extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('sys_user_model');
        $this->_m('sys_post_management_model');
        $this->_m('sys_role_model');
        $this->_m('sys_team_model');
    }

    /**
     * 页面
     */
    public function index()
    {
        /**
         * 如果参数不满足，则返回错误信息
         */

        $params = $this->p(array(), array('page', 'pagenums', 'team_id', 'kw', 'ajax'), false, function () {
            show_error("页面错误");
        });
        $this->_page_title = "参数设置";
        $this->_page_subtitle = "用户管理";
        $params['where'] = array();
        is_vail($params['kw']) ? $params['where']['realname like'] = "%" . $params['kw'] . "%" : null;
        is_vail($params['team_id']) ? $params['where']['team_id'] = $params['team_id'] : null;

        $params['fields'] = $this->_params['ajax'] == 'true' ? array('user_id', 'realname', 'team_id', 'salary_no') : array();
        $params['order'] = array();
        $params['page'] = is_vail($params['page']) ? $params['page'] : 1;
        $params['pagenums'] = is_vail($params['pagenums']) ? $params['pagenums'] : 20;
        $ret = $this->sys_user->lists($params);
        foreach ($ret as $v) {
            if ($this->_params['ajax'] != 'true') {
                $v->post_name = $this->sys_post_management->get_detail(array('pm_id' => $v->post_id), array('name'))->name;
                $v->role_name = $this->sys_role->get_detail(array('role_id' => $v->role_id), array('name'))->name;
            }
            $v->team_name = $this->sys_team->name($v->team_id);
        }
        /***分页***/
        $this->_data ['page_tpl'] = $this->page($this->sys_user, $params);
        /***分页结束***/
        $this->_data ['data'] = $ret;
        $this->_data ['team'] = $this->sys_team->get_kv();
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->_v('profile/user/index.tpl.php');

    }

    public function edit()
    {
        $required = array();
        $optional = array('user_id');
        /**
         * 如果参数不满足，则返回错误信息
         */
        $params = $this->p($required, $optional, false, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $this->_data['user_id'] = $params['user_id'];
        if ($params['user_id']) {
            $this->_data['data'] = $this->sys_user->get_detail(array('user_id' => $params['user_id']), array());
            $this->_page_title = '系统设置';
            $this->_page_subtitle = '用户编辑';
            $this->_data['is_new'] = "false";
        } else {
            $this->_page_title = '系统设置';
            $this->_page_subtitle = '用户添加';
            $this->_data['is_new'] = "true";
        }

        /*************/
        $params = array('where' => array(),
            'page' => null,
            'pagenums' => null,
            'order' => array(),
            'fields' => array());
        $this->_data['post'] = $this->sys_post_management->lists($params);
        $this->_data['role'] = $this->sys_role->lists($params);
        $this->_data['team'] = $this->sys_team->lists($params);
        /*************/


        $this->_v('profile/user/edit.tpl.php');
    }

    public function save()
    {
        $required = array();
        $optional = array(
            'username',
            'user_id',
            'department_id',
            'role_id',
            'post_id',
            'team_id',
            'remark',
            'password',
            'realname',
            'salary_no',
            'ajax'

        );

        /**
         * 如果参数不满足，则返回错误信息
         */
        $params = $this->p($required, $optional, false, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $params['modified'] = time();
        if ($params['user_id']) {
            unset($params['username']);
            $this->sys_user->assign($params);
            $this->_data ['data'] = $this->sys_user->u();
        } else {
            $params['created'] = time();
            $this->sys_user->assign($params);
            $this->_data ['data'] = $this->sys_user->a();
        }
        if (!$this->_data ['data']) {
            $this->_params['ajax'] == 'true' ? api_error(false, '操作失败') : show_error('操作失败');
        } else {
            if ($this->_params['ajax'] == 'true') {
                $this->_data ['msg'] = '操作成功';
                $this->_v();
            } else {
                $this->redirect('profile/team/index', '操作成功');
            }
        }
    }

    public function delete()
    {
        $params = array();
        $required = array('user_id',);
        $optional = array('ajax');
        /**
         * 如果参数不满足，则返回错误信息
         */
        $params = $this->p($required, $optional, true, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $this->sys_user->assign($params);
        $this->_data ['data'] = $this->sys_user->d();
        $this->_data['msg'] = $this->_data ['data'] > 0 ? '删除成功' : '删除失败';
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->redirect('profile/user/index', $this->_data['msg']);
    }

    public function delete_batch()
    {
        $params = array();
        $required = array('ids',);
        $optional = array('ajax');
        /**
         * 如果参数不满足，则返回错误信息
         */
        $params = $this->p($required, $optional, true, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $this->_data ['data'] = $this->sys_user->del_batch(explode(',', $params['ids']));
        $this->_data['msg'] = $this->_data ['data'] > 0 ? '删除成功' : '删除失败';
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->redirect('profile/user/index', $this->_data['msg']);
    }

    public function detail()
    {
        $this->p(array('user_id'), array('ajax'), true, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $this->sys_user->assign($this->_params);
        $this->_data['data'] = $this->sys_user->g();
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->_v('profile/user/detail.tpl.php');
    }
}

/* End of file supplier.php */
/* Location: ./application/controllers/sys/supplier.php */