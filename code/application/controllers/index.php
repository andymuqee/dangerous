<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * index资源类
 *
 * @author andywu
 * @version $Id$
 */
class Index extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->_m ( 'Sys_Notice_Model' );
    }

    public function index()
    {
        $this->_page_title = "危险品管理平台v1.0";
        $this->_page_subtitle = "首页";
        $this->_data['realname'] = $this->session->userdata('realname');
        $this->_data['user_id'] = $this->session->userdata('user_id');
        $this->_data['sexy'] = $this->session->userdata('sexy');
        $this->_data['avatar'] = $this->session->userdata('avatar');
        $this->_v('index.tpl.php');
    }
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */