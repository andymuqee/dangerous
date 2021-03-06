<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 发现地点类
 *
 * @author andywu
 * @version $Id$
 */
class Place extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('sys_place_model');
        $this->_m('sys_user_model');
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
            $this->_params['ajax'] == 'true' ? api_error(404, "参数错误") : show_error("页面错误");
        });
        $this->_page_title = "参数设置";
        $this->_page_subtitle = "发现地点";

        $params['where'] = array();
        is_vail($params['kw']) ? $params['where']['name like'] = "%" . $params['kw'] . "%" : null;

        $params['fields'] = array();
        $params['order'] = array();
        $params['page'] = is_vail($params['page']) ? $params['page'] : 1;
        $params['pagenums'] = is_vail($params['pagenums']) ? $params['pagenums'] : 20;
        $ret = $this->sys_place->lists($params);
        /***分页***/
        $this->_data ['page_tpl'] = $this->page($this->sys_place, $params);
        /***分页结束***/
        $this->_data ['data'] = $ret;
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->_v('profile/place/index.tpl.php');
    }

    public function edit()
    {
        $params = $this->p(array(), array('place_id'), false, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "参数错误") : show_error("页面错误");
        });
        if ($params['place_id']) {
            $this->_data['data'] = $this->sys_place->get_detail(array('place_id' => $params['place_id']), array());
            $this->_page_title = '参数设置';
            $this->_page_subtitle = '发现地点编辑';
        } else {
            $this->_page_title = '参数设置';
            $this->_page_subtitle = '发现地点添加';
        }
        $this->_v('profile/place/edit.tpl.php');

    }

    public function save()
    {
        $required = array(
            'name'
        );
        $optional = array(
            'place_id',
            'ajax'
        );

        /**
         * 如果参数不满足，则返回错误信息
         */
        $params = $this->p($required, $optional, true, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $params['modified'] = time();
        if ($params['place_id']) {
            $this->sys_place->assign($params);
            $this->_data ['data'] = $this->sys_place->u();
        } else {
            $params['created'] = time();
            $this->sys_place->assign($params);
            $this->_data ['data'] = $this->sys_place->a();
        }

        if (!$this->_data ['data']) {
            $this->_params['ajax'] == 'true' ? api_error(false, '操作失败') : show_error('操作失败');
        } else {
            if ($this->_params['ajax'] == 'true') {
                $this->_data ['msg'] = '操作成功';
                $this->_v();
            } else {
                $this->redirect('profile/place/index', '操作成功');
            }
        }
    }

    public function delete()
    {
        $params = array();
        $required = array('place_id',);
        $optional = array('ajax');
        /**
         * 如果参数不满足，则返回错误信息
         */
        $params = $this->p($required, $optional, true, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $this->sys_place->assign($params);
        $this->_data ['data'] = $this->sys_place->d();
        $this->_data['msg'] = $this->_data ['data'] > 0 ? '删除成功' : '删除失败';
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->redirect('profile/place/index', $this->_data['msg']);
    }

    public function detail()
    {
        $this->p(array('place_id'), array('ajax'), true, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $this->sys_place->assign($this->_params);
        $this->_data['data'] = $this->sys_place->g();
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->_v('profile/place/detail.tpl.php');
    }
}

/* End of file supplier.php */
/* Location: ./application/controllers/sys/supplier.php */