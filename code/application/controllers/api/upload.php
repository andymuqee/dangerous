<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 基础库设置类
 *
 * @author andywu
 * @version $Id$
 */
class Upload extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 基础库页面
     */
    public function index()
    {
        $ret = array(
            'code' => 400,
            'url' => ''
        );
        $file = $_FILES['myfile'];
        $file_name = explode('.', $file['name']);
        $suffix = $file_name[(count($file_name) - 1)];
        $file_name = date('YmdHiS', time()) . $this->getRandChar(5) . '.' . $suffix;
        if (move_uploaded_file($file['tmp_name'], 'uploads/' . $file_name)) {
            $ret['code'] = 200;
            $ret['url'] = 'http://' . $_SERVER['SERVER_NAME'] . '/uploads/' . $file_name;
        }
        echo json_encode($ret);
    }

    /**
     * 生成随机字符串
     */
    public function getRandChar($length)
    {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
    }
}
/* End of file upload.php */
/* Location: ./application/controllers/sys/upload.php */