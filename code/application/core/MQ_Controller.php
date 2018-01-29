<?php

/**
 * MQ_Controller Application Controller Class
 *
 * This class object is the extend to super class that every library in
 * XZD will be assigned to.
 *
 * @package        TTZG
 * @subpackage    Libraries
 * @category    Libraries
 * @author        xzd Dev Team
 * @version $Id: MQ_Controller.php06 2014-05-07 07:13:11Z wudi $
 * @link
 */
class MQ_Controller extends CI_Controller
{
    protected $_params;
    protected $_format;
    protected $_is_gzip;
    protected $_model;
    protected $_data;
    protected $_page_title;
    protected $_page_subtitle;

    public function __construct()
    {
        parent::__construct();
        $this->_url = explode("/", uri_string());
        $this->need_login = true;
        if ($this->need_login && $this->router->class != 'member'
            && $this->_url['0'] != 'api' && $this->_url['0'] != 'app'
        ) {
            $this->check_login();
        }
        $this->_data = array(
            'out' => null,
            'msg' => null
        );
        $this->_format = $this->input->get('format');
        $this->_is_gzip = $this->input->get('gzip');
        //当前控制器名
        $this->_data['controller'] = $this->router->fetch_class();
        //当前模块名
        $this->_data['module'] = $this->_url[0];
        $this->_data['action'] = @is_vail($this->_url[2]);

        //
//        $this->session->userdata('referer') ? '' : $this->session->set_userdata('referer', $_SERVER['HTTP_REFERER']);
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    }


    public function check_login()
    {
        $user_id = $this->session->userdata('user_id');
        if (!@is_vail($user_id) && $this->input->get_post('ajax') != "true") {
            redirect("/sys/member/login?redirect_url=" . config_item("base_url"));
        }

    }

    /*
     * public function __call($name, $args){ ; } public function __get($name){ ; }
     */
    /**
     * 判断参数有效性并获得参数
     *
     * @param array $required
     * @param array $optional
     * @return boolean multitype:NULL
     */
    protected function _params(array $required, array $optional = array(), $is_required = true)
    {
        $ret = array();
        if ($is_required) {
            if (count($required) and is_array($required)) {
                foreach ($required as $v) {
                    if (!$ret [$v] = @is_vail($this->input->get_post($v))) {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
        foreach ($optional as $v) {
            if (!($ret [$v] = @is_vail($this->input->get_post($v)))) {
                continue;
            }
        }
        $this->_params = $ret;
        return $this->_params;
    }

    /**
     * 获取参数
     *
     * @param array $optional
     * @return boolean multitype:NULL
     */
    protected function _optional_params(array $optional)
    {
        $ret = array();
        foreach ($optional as $v) {
            if (!($ret [$v] = @is_vail($this->input->get_post($v)))) {
                continue;
            }
        }
        return $ret;
    }

    /**
     * 将json字符串转化成对象
     *
     * @param string $var
     * @return multitype:multitype: mixed
     */
    protected function _params_to_json($var)
    {
        $ret = array();
        if (@is_vail($var ['data'])) {
            $ret ['data'] = json_decode($var ['data'], TRUE);
        } else {
            $ret ['data'] = array();
        }
        return $ret;
    }

    protected function doFun($condition, Closure $do1, Closure $do2, Closure $do3 = null)
    {
//        var_dump($do1);
        if ($condition) {
            $do1($this);
        } else {
            $do2($this);
        }
        if (is_vail($do3)) {
            $do3($this);
        }
    }

    private function unicode_encode($name)
    {
        $name = iconv('UTF-8', 'UCS-2', $name);
        $len = strlen($name);
        $str = '';
        for ($i = 0; $i < $len - 1; $i = $i + 2) {
            $c = $name[$i];
            $c2 = $name[$i + 1];
            if (ord($c) > 0) {    // 两个字节的文字
                $str .= '\u' . base_convert(ord($c), 10, 16) . base_convert(ord($c2), 10, 16);
            } else {
                $str .= $c2;
            }
        }
        return $str;
    }

    private function unicode_decode($name)
    {
        // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
        preg_match_all($pattern, $name, $matches);
        if (!empty($matches)) {
            $name = '';
            for ($j = 0; $j < count($matches[0]); $j++) {
                $str = $matches[0][$j];
                if (strpos($str, '\\u') === 0) {
                    $code = base_convert(substr($str, 2, 2), 16, 10);
                    $code2 = base_convert(substr($str, 4), 16, 10);
                    $c = chr($code) . chr($code2);
                    $c = iconv('UCS-2', 'UTF-8', $c);
                    $name .= $c;
                } else {
                    $name .= $str;
                }
            }
        }
        return $name;
    }

    /**
     * 上传多张图片
     *
     * @return Ambigous <multitype:, string>
     */
    public function uploads()
    {
        $ret = array();
        if (@is_vail($_FILES ['filedata'] ['tmp_name'])) {
            $path = "uploads/" . date("Y-m-d");
            create_folder($path);
            $file_name = "";
            for ($i = 0; $i < count($_FILES ['filedata'] ['tmp_name']); $i++) {
                $extend = pathinfo($_FILES ['filedata'] ['name'] [$i]);
                if (!@is_vail($extend ['filename'])) {
                    continue;
                }
                $file_ext = $extend ['extension'];
                $file_name = random_num($i);
                $full_name = "/" . $path . "/" . $file_name . "." . $file_ext;

                if (move_uploaded_file($_FILES ['filedata'] ['tmp_name'] [$i], "." . $full_name)) {
                    $ret[$i]['url'] = config_item('base_url') . $full_name;
                    $ret[$i]['filename'] = $_POST['filename'][$i];
                }
//                var_dump($_POST);
            }
        }
//        $fileName = "/data0/htdocs/com/muqee/sykyd/test/data.txt";
//        $handle = fopen($fileName,'w+') or die('打开<b>'.$fileName.'</br>文件失败！！');
//        fwrite($handle, $_POST['filename'][0]);
//        fclose($handle);
        return $ret;
    }

    /**
     * 上传单张图片
     *
     * @param string $file_filed
     * @param string $path
     * @return multitype:string
     */
    public function upload_alone($file_filed = "file", $path = "")
    {
        $ret = array(
            "code" => 400,
            "url" => "",
            "filename" => ""
        );
        if (@is_vail($_FILES [$file_filed] ['tmp_name'])) {
            if ("" == $path) {
                $path = "uploads/" . date("Y-m-d");
            }
            create_folder($path);
            $file_name = "";
            $extend = pathinfo($_FILES [$file_filed] ['name']);

            if (@is_vail($extend ['basename'])) {
                $ret['code'] = 200;
                $file_ext = $extend ['extension'];
                $file_name = random_num(1);
                $full_name = "/" . $path . "/" . $file_name . "." . $file_ext;
                echo $_FILES [$file_filed] ['tmp_name'];
                if (move_uploaded_file($_FILES [$file_filed] ['tmp_name'], $full_name)) {
                    $ret ['url'] = config_item('base_url') . $full_name;
                    $ret ['filename'] = $file_name . "." . $file_ext;
                } else {
                    echo 'fail';
                }
            }
        }
        var_dump($ret);

        return $ret;
    }

    /**
     * 视图输出
     */
    protected function _v($out_page = 'json', $is_string = false)
    {
        $this->layout($this->_page_title, $this->_page_subtitle);
        $this->load->view($out_page, $this->_data, $is_string);
    }

    /**
     * 视图输出
     */
    protected function json_v($out_page = 'json', $is_string = false)
    {
        $this->load->view('json', $this->_data, $is_string);
    }

    protected function _o($f, $h)
    {
        call_user_func_array(array(
            $this,
            e_vail($f, 'json') . "_v"
        ), array(
            $h
        ));
    }

    /**
     * html输出
     */
    protected function _h($tpl)
    {
        if (@is_vail($this->_data))
            $this->load->view($tpl, $this->_data);
        else
            $this->load->view($tpl);
    }

    /**
     * 模型加载
     *
     * @param string $model
     */
    protected function _m($model)
    {
        $alias = $model;
        $alias = strtolower(substr($alias, 0, strrpos($alias, '_')));
        $this->load->model("$model", "$alias");
    }

    /**
     * 类型加载
     *
     * @param string $model
     */
    protected function _t($model)
    {
        $this->load->model(strtolower($model));
    }

    protected function layout($pageTitle = "", $pageSubTitle = "")
    {
        $this->_data ['page_title'] = $pageTitle;
        $this->_data ['page_subtitle'] = $pageSubTitle;
        $this->_data ['base_css'] = $this->load->view('layout/base_css.tpl.php', '', true);
//        $this->_data ['base_theme_css'] = $this->load->view('layout/base_theme_css.tpl.php', '', true);
//        $this->_data ['header'] = $this->load->view('layout/header.tpl.php', array('login_admin_name' => $this->session->userdata('nickname')), true);
//        $this->_data ['menu'] = $this->load->view('layout/menu.tpl.php', array('acl' => $this->session->userdata('acl') ? json_decode($this->session->userdata('acl')) : array()), true);
//
//        $this->_data ['header'] = $this->load->view ( 'layout/header.tpl.php', '', true );
//        $this->_data ['menu'] = $this->load->view ( 'layout/menu.tpl.php', $this->_data, true );
//        $this->_data ['footer'] = $this->load->view('layout/footer.tpl.php', '', true);
//        $this->_data ['btn_theme'] = $this->load->view('layout/btn-theme.tpl.php', '', true);
//        $this->_data ['mod_confirm'] = $this->load->view('layout/mod-confirm.tpl.php', '', true);
//        $this->_data ['btn_export_tools'] = $this->load->view('layout/btn-export-tools.tpl.php', '', true);
        $this->_data ['base_js'] = $this->load->view('layout/base_js.tpl.php', '', true);
//        $this->_data ['ctl_breadcrumb'] = $this->load->view('layout/ctl-breadcrumb.tpl.php', '', true);
    }

    protected function p(array $required, array $optional = array(), $isRequired = true, $erroFunc = '')
    {
        $params = array();

        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional, $isRequired))) {
            if (is_vail($erroFunc)) {
                $erroFunc();
            } else {
                show_error("参数错误", 404);
            }
        }

        return $params;
    }


    public function __call($name, $arguments)
    {
        echo "the function is not exits";
        show_error();
    }

    /*
     * 图片裁剪格式，转换成json列表
     */
    public function image_json($param, $dir)
    {
        $file_name_format = explode($dir, $param);
        $file_name = explode('.', $file_name_format[1]);
        $file_list = array('small' => $file_name_format[0] . $dir . $file_name[0] . '_s.' . $file_name[1],
            'normal' => $file_name_format[0] . $dir . $file_name[0] . '_n.' . $file_name[1],
            'large' => $file_name_format[0] . $dir . $file_name[0] . '_b.' . $file_name[1],
            'original' => $file_name_format[0] . $dir . $file_name_format[1]);
        return json_encode($file_list);
    }

    public function excel($titles, $array, $filename)
    {

        //创建对象

        $excel = new PHPExcel();

        //Excel表格式,这里简略写了8列

        $letter = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD');

        //表头数组

        $tableheader = $titles;

        //填充表头信息

        for ($i = 0; $i < count($tableheader); $i++) {

            $excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");

        }


        //表格数组

        $data = $array;

        //填充表格信息

        for ($i = 2; $i <= count($data) + 1; $i++) {

            $j = 0;

            foreach ($data[$i - 2] as $key => $value) {

                $excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");

                $j++;

            }

        }


        //创建Excel输入对象

        $write = new PHPExcel_Writer_Excel5($excel);

        header("Pragma: public");

        header("Expires: 0");

        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");

        header("Content-Type:application/force-download");

        header("Content-Type:application/vnd.ms-execl");

        header("Content-Type:application/octet-stream");

        header("Content-Type:application/download");;

        header('Content-Disposition:attachment;filename="' . $filename . '.xls"');

        header("Content-Transfer-Encoding:binary");

        $write->save('php://output');
    }

    /*
     * 平台分页类
     * */
    public function page($model, $params)
    {

        $page['count'] = $model->get_detail($params['where'], array('count(*) as count'))->count;
        $page['pages'] = ceil($page['count'] / $params ['pagenums']);
        $page['curr'] = $params['page'];
        $page['pagenums'] = $params ['pagenums'];
        $this->_data['page'] = $page;
        return $this->load->view('layout/page.tpl.php', $this->_data, true);

    }

    public function redirect($url, $msg = '')
    {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        if ($msg)
            echo "<script>alert('$msg')</script>";
        echo "<script>window.location.href='$url'</script>";

    }

    /*
     * 中文字符截取
     * */
    public function cnsubstr($str = '', $len = 0, $etc = ' ...')
    {
        if (0 == $len) return "";

        $str_len = preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $dummy);
        if ($len >= $str_len) {
            return $str;
        } else {
            $newstr = mb_substr($str, 0, $len, 'utf-8');
            return $newstr . $etc;
        }
    }

    /*获取工作流信息*/
    public function workflow($router)
    {
        $this->_m('sys_workflow_Model');
        $this->_m('sys_workflow_item_Model');
        $workflow = $this->sys_workflow->get_detail(array('router' => $router), array());
        $workflow->items = $this->sys_workflow_item->lists(array(
            'where' => array('workflow_id' => $workflow->workflow_id),
            'fields' => array('workflow_item_id', 'item', 'summary', 'operator'),
            'order' => array('sort_order' => 'asc'),
            'page' => null,
            'pagenums' => null
        ));
        return $workflow;

    }

    /*返回当前状态在工作流中的位置*/
    public function workflow_sort($workflow_items, $workflow_item_id)
    {
        $res = 0;
        foreach ($workflow_items as $k => $v) {
            if ($v->workflow_item_id == $workflow_item_id) {
                $res = $k + 1;
                break;
            }
        }
        return $res;

    }

    public function mk_where($keys)
    {
        $ret = array();
        foreach ($keys as $k => $v) {
            is_vail($v) ? $ret[$k] = $v : null;
        }
        return $ret;
    }

    public function mk_where_like($keys)
    {
        $ret = array();
        foreach ($keys as $k => $v) {
            is_vail($v) ? $ret[$k] = "%" . $v . "%" : null;
        }
        return $ret;
    }

}

/* End of file MQ_Controller.php/
/* Location: ./application/core/MQ_Controllerhp */
?>
