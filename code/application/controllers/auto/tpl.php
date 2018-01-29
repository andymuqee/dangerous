<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 供货商类
 *
 * @author andywu
 * @version $Id$
 */
class Tpl extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('sys_user_Model');
        $this->_m('sys_role_model');
        $this->_m('sys_department_model');
        $this->_page_title = '个人中心';
    }

    public function make()
    {
        $this->p(array('table'), array(), true, function () {
            echo 'false';
            exit;
        });
        $tbl = $this->_params['table'];
        $this->_m($tbl . '_model');
        $data = $this->$tbl->get_cloumn();
        $out['data'] = $data;
        $content = $this->load->view('tpl/edit.tpl.php', $out, true);
        if (write_file(APPPATH . "/views/tpl/" . $tbl . "_edit.tpl.php", $content)) {
            echo 'ok';
        } else {
            echo 'fail';
        }
//        $this->_v('test.tpl.php');
    }


}

/* End of file supplier.php */
/* Location: ./application/controllers/sys/supplier.php */