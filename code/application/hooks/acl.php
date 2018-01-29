<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * acl资源类
 *
 * @author andywu
 * @version $Id$
 */
class Acl extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->_m ( 'Ad_Model' );
    }

    public function filter()
    {
        if (!@is_vail($this->session->userdata('biz_id'))) {
            /**
             * 如果为登录页面或者登录提交页面则无需跳转，直接显示登录页面
             */
            $loginUrl = $this->uri->uri_string();
            if ($this->_is_exits_url($loginUrl)) {
                return;
            }
            redirect("/sys/login/get");


        }

        // 如果用户合法，则判断请求的url是否具备权限，如果不具备权限则干掉
        // 1.根据该用户的biz_id获得该用户的权限列表
        // 2.根据该用户的权限列表判断请求的controller或action是否合法，不合法提示权限不足引导至首页
    }

    protected function _is_exits_url($uri)
    {
        $ret = false;
        $c = null;
        if (!@is_vail($uri)) return $ret;
        $f = substr($uri, 0, 1);
        $c = ('/' == $f) ? substr($uri, 1) : $uri;
        $ret = in_array($c, config_item('ignore_uri'));
        return $ret;
    }

    /**
     * 获得指定供应商资源
     *
     * @param
     *            integer ID
     * @param
     *            fields 需要获得字段的列表名称
     * @return string
     * @example http://api.erp.ttzg.com/acl/get?
     *          acl=1&
     *          fields=supplier_id,supplier_name,createtime,updatetime
     */
    public function get()
    {
        $params = array();
        $required = array(
            'ads_id'
        );
        $optional = array(
            'fields'
        );
        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0101, "param is not set: ", $required);
        }
        $params ['fields'] = @is_vail($params ['fields']) ? explode(',', $params ['fields']) : array();
        $this->_data ['base_css'] = $this->load->view('layout/base_css.tpl.php', '', true);
        $this->_data ['header'] = $this->load->view('layout/header.tpl.php', '', true);
        $this->_data ['menu'] = $this->load->view('layout/menu.tpl.php', '', true);
        $this->_data ['footer'] = $this->load->view('layout/footer.tpl.php', '', true);

        $this->ad->ads_id = $params ['ads_id'];
        $this->_data ['ad'] = $this->ad->g($params ['fields']);
        $this->_v('ads/acl/index.tpl.php');
    }

    /**
     * 添加一个资源
     *
     * @param
     *            string 名称
     * @param
     *            string 需要获得字段的列表名称
     * @return string
     * @example http://api.erp.ttzg.com/acl/post?
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
            'ads_id'
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
        $this->ad->assign($params);
        $this->_data ['out'] = $this->ad->a();
        $this->_v();
    }

    /**
     * 获得指定资源
     *
     * @param
     *            integer ID
     * @param
     *            string 需要获得字段的列表名称
     * @return string
     * @example http://api.erp.ttzg.com/acl/get?
     *          supplier_id=1&
     *          supplier_name=1&
     *          supplier_contact=侯晓宇&
     *          supplier_tel=024-832323&
     *          contury_code=086&
     *          city_code=024&
     *          address=青年大街51号B座25楼&
     */
    public function put()
    {
        $params = array();
        $required = array(
            'ads_id'
        );
        $optional = array(
            'ads_id'
        );
        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0103, "param is not set: ", $required);
        }
        $params ['updatetime'] = now();
        $this->ad->assign($params);
        $this->_data ['out'] = $this->ad->u();
        $this->_v();
    }

    /**
     * 获得指定资源
     *
     * @param
     *            integer ID
     * @return boolean 删除成功与否
     * @example http://api.erp.ttzg.com/acl/get?
     *          supplier_id=1&
     */
    public function delete()
    {
        $params = array();
        $required = array(
            'ads_id'
        );
        $optional = array();
        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0104, "param is not set: ", $required);
        }
        $this->ad->assign($params);
        $this->_data ['out'] = $this->ad->d();
        $this->_v();
    }
}

/* End of file acl.php */
/* Location: ./application/controllers/acl.php */