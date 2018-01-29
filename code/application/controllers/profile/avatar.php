<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * index资源类
 *
 * @author andywu
 * @version $Id$
 */
class Avatar extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->_m ( 'Sys_Notice_Model' );
        $this->_m('Sys_user_Model');
    }

    /**
     * 获得
     *
     * @param
     *            integer ID
     * @param
     *            fields 需要获得字段的列表名称
     * @return string
     * @example http://api.erp.ttzg.com/index/get?
     *          index=1&
     *          fields=supplier_id,supplier_name,created,modified
     */
    public function index()
    {
        $this->layout("");
        $this->_data['avatar'] = $this->sys_user->get_detail(array('user_id' => $this->session->userdata('user_id')), array('avatar'))->avatar;
        $this->_v('profile/avatar/index.tpl.php');
    }

    /**
     * 添加一个资源
     *
     * @param
     *            string 名称
     * @param
     *            string 需要获得字段的列表名称
     * @return string
     * @example http://api.erp.ttzg.com/index/post?
     *          supplier_name=1&
     *          supplier_contact=侯晓宇&
     *          supplier_tel=024-832323&
     *          contury_code=086&
     *          city_code=024&
     *          address=青年大街51号B座25楼&
     */
    public function upload()
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
        $params ['modified'] = now();
        $params ['created'] = now();
        $this->administartor->assign($params);
        $this->_data ['out'] = $this->administartor->a();
        $this->_v();
    }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */