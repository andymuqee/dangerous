<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 基础库设置类
 *
 * @author andywu
 * @version $Id$
 */
class Base64upload extends MQ_Controller
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
//        $file = $_FILES['myfile'];
//        $file_name = explode('.', $file['name']);
//        $suffix = $file_name[(count($file_name) - 1)];
//        $file_name = date('YmdHiS', time()) . $this->getRandChar(5) . '.' . $suffix;
//        //file_put_contents('/upload/tmp/'.$file_name,file_get_contents($file['tmp_name']));
//        move_uploaded_file($file['tmp_name'], 'upload/tmp/' . $file_name);
//        echo '/upload/tmp/' . $file_name;
        $params = array();
        $required = array(
            'base'
        );
        $optional = array();

        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(400, "param is not set: ", $required);
        }
        $ret = '';
        $base64_image_content = $params['base'];
//        echo $base64_image_content;exit;
//匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
            $type = $result[2];

            $new_file = "/data0/htdocs/com/muqee/shfwzx/upload/tmp/";
            if (!file_exists($new_file)) {
//检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0700);
            }
            $new = date('YmdHiS', time()) . $this->getRandChar(5) . ".{$type}";
            $new_file = $new_file . $new;

            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
                $ret = "/upload/tmp/" . $new;
            }
        }
        $this->_data['out'] = $ret;
        $this->_v();

    }

    /*
     * 生成随机字符串
     * */
    public function getRandChar($length)
    {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }

    public function check_type($type)
    {


    }
}

/* End of file baseinfo.php */
/* Location: ./application/controllers/sys/baseinfo.php */