<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package CodeIgniter
 * @author ExpressionEngine Dev Team
 * @copyright Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license http://codeigniter.com/user_guide/license.html
 * @link http://codeigniter.com
 * @since Version 1.0
 * @filesource
 *
 */
// ------------------------------------------------------------------------

/**
 * TTZG Util Helpers
 *
 * @package TTZG
 * @subpackage Helpers
 * @category Helpers
 * @author xzd Dev Team
 * @link
 *
 */
// ------------------------------------------------------------------------

/**
 * Is Vail
 *
 * check is vail for the param
 *
 * @access public
 * @param
 *            mixed
 * @return string
 */
if (!function_exists('is_vail')) {
    function is_vail($var)
    {
        $ret = null;

        if (!isset ($var) or @is_null($var) or (empty ($var) and strlen($var) < 1)) {
            $ret = null;
        } else {
            $ret = $var;
        }
        return $ret;
    }
}

/**
 * is_vail的别名
 *
 * check is vail for the param
 *
 * @access public
 * @param
 *            mixed
 * @return mixed
 */
if (!function_exists('assign')) {
    function assign($var)
    {
        return is_vail($var);
    }
}

/**
 * If execute
 *
 * check is vail for the param
 *
 * @access public
 * @param
 *            mixed
 * @return string
 */
if (!function_exists('assign_func')) {
    function assign_func(&$var, $strFunName)
    {
        $var = is_vail($var) ? call_user_func($strFunName, $var) : '';
        return $var;
    }
}

/**
 * Uuid
 *
 * make a string of union id
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('uuid')) {
    function uuid($prefix = "")
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr($chars, 0, 8) . "-";
        $uuid .= substr($chars, 8, 4) . "-";
        $uuid .= substr($chars, 12, 4) . "-";
        $uuid .= substr($chars, 16, 4) . "-";
        $uuid .= substr($chars, 20, 12);

        return $prefix . $uuid;
    }
}

/**
 * Get API Data
 *
 * POST or GET method to get api data
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('get_api_data')) {
    function get_api_data($method)
    {
        $ret = array();

        if ('get' == strtolower($method)) {
            $ret = $_GET;
        } else {
            $ret = $_POST;
        }
        return $ret;
    }
}

/**
 * Make to sign
 *
 * POST or GET data params make to sign
 * ?v=1.0&timestamp=2013-05-06 13:52:03&format=json&imei=abc12345&&data={json}
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('mk_sign')) {
    function mk_sign($params)
    {
        $ret = null;
        if (@is_vail($params)) {
            // timestamp=&format=json&imei=&&data=
            $r_arr = array_unique($params);
            $string = implode("", $r_arr);
            $ret = md5(strtolower($string));
        }
        return $ret;
    }
}

/**
 * Make the folder
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('create_folder')) {
    function create_folder($path)
    {
        if (!file_exists($path)) {
            $oldumask = umask(0);
            mkdir($path, 0777);
            umask($oldumask);
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * Get the ext name of file
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('get_extension')) {
    function get_extension($file)
    {
        return end(explode('.', $file));
    }
}

/**
 * Get the ext name of file
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('random_num')) {
    function random_num($prefix)
    {
        // 第一步:初始化种子
        // microtime(); 是个数组
        $seedstr = explode(" ", microtime(), 5);
        $seed = $seedstr [0] * 10000;
        // 第二步:使用种子初始化随机数发生器
        srand($seed);
        // 第三步:生成指定范围内的随机数
        $random = rand(1000, 10000);

        $filename = date("YmdHis", time()) . $random . $prefix;

        return $filename;
    }
}

/**
 * Echo api error
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('api_error')) {
    function api_error($error_code, $error_msg, $error_args = array(), $template = "api_error")
    {
        include(APPPATH . 'errors/' . $template . '.php');
        exit ();
    }
}

/**
 * Echo tt error page
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('tt_error_page')) {
    function tt_error_page($error_heading, $error_message, $error_args = array(), $template = "tt_error_page")
    {
        include(APPPATH . 'errors/' . $template . '.php');
        exit ();
    }
}
/**
 * 获得附近的距离
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('get_round')) {
    function get_round($myLat, $myLng, $distance)
    {
        // 以下为核心代码
        $range = 180 / pi() * $distance / 6372.797; // 里面的 1 就代表搜索 1km 之内，单位km
        $lngR = $range / cos($myLat * pi() / 180);
        $maxLat = $myLat + $range; // 最大纬度
        $minLat = $myLat - $range; // 最小纬度
        $maxLng = $myLng + $lngR; // 最大经度
        $minLng = $myLng - $lngR; // 最小经度
        return array(
            'maxlat' => $maxLat,
            'minlat' => $minLat,
            'maxlon' => $maxLng,
            'minlon' => $minLng
        );
    }
}

/**
 * 获得格式时间
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('get_time')) {

    // 获取时间
    function get_time($time)
    {
        if (empty ($get_time)) {
            return false;
        }

        $get_year = date('Y', strtotime($get_time)); // 输入中的年
        $nowDate = date("Y"); // 今年
        if ($get_year == $nowDate) {
            $nowDate = date("Y-m-d");
            $get_time = substr($get_time, 0, 10);
            if ($nowDate === $get_time) {
                $time = date('H:i', time()); // 现在的时间
            } else {
                $time = $get_time = substr($get_time, 5, 10); // 接收到的日期
            }
        } else {
            $time = $get_year = date('Y-m', strtotime($get_time)); // 输入中的年和月
        }
        return $time;
    }
}

/**
 * 获取指定日期对应星座
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return boolean string
 * @return string
 */
if (!function_exists('get_constellation')) {
    function get_constellation($time)
    {
        $month = date('m', strtotime($time)); // 输入中的月
        $day = date('d', strtotime($time)); // 输入中的天
        $day = intval($day);
        $month = intval($month);
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
            return false;
        $signs = array(
            array(
                '20' => '宝瓶座'
            ),
            array(
                '19' => '双鱼座'
            ),
            array(
                '21' => '白羊座'
            ),
            array(
                '20' => '金牛座'
            ),
            array(
                '21' => '双子座'
            ),
            array(
                '22' => '巨蟹座'
            ),
            array(
                '23' => '狮子座'
            ),
            array(
                '23' => '处女座'
            ),
            array(
                '23' => '天秤座'
            ),
            array(
                '24' => '天蝎座'
            ),
            array(
                '22' => '射手座'
            ),
            array(
                '22' => '摩羯座'
            )
        );
        list ($start, $name) = each($signs [$month - 1]);
        if ($day < $start)
            list ($start, $name) = each($signs [($month - 2 < 0) ? 11 : $month - 2]);
        return $name;
    }
}

/**
 * 获得距离
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('get_distance')) {
    function get_distance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6367000; // approximate radius of earth in meters

        $lat1 = ($lat1 * pi()) / 180;
        $lon1 = ($lon1 * pi()) / 180;

        $lat2 = ($lat2 * pi()) / 180;
        $lon2 = ($lon2 * pi()) / 180;

        $calcLongitude = $lon2 - $lon1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        return round($calculatedDistance);
    }
}

/**
 * 时间戳转日期
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('u2d')) {
    function u2d($str, $format = "Y-m-d H:i")
    {
        return date($format, $str);
    }
}
/**
 * 获得当前日期
 *
 *
 *
 * @access public
 * @param
 *            string
 * @return string
 */
if (!function_exists('now_date')) {
    function now_date()
    {
        return date("Y-m-d H:i:s");
    }
}

/**
 * 判断是email还是手机号
 *
 * @param String $str
 * @return String $rtn
 */
if (!function_exists('check_login_info')) {
    function check_login_info($str)
    {
        if (check_email($str)) {
            return 1;
        }
        if (check_mobile($str)) {
            return 2;
        }
        return -1;
    }
}

/**
 * 判断是email
 *
 * @param String $str
 * @return String $rtn
 */
if (!function_exists('check_email')) {
    function check_email($str)
    {
        if (preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$/i", $str)) {
            return TRUE;
        }
        return FALSE;
    }
}

/**
 * 判断是手机号
 *
 * @param String $str
 * @return String $rtn
 */
if (!function_exists('check_mobile')) {
    function check_mobile($str)
    {
        if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]$/", $str)) {
            return TRUE;
        }
        return FALSE;
    }
}

/**
 * mysql 距离排序算法
 *
 * @param String $lon_field_name
 * @param String $lat_field_name
 * @return String
 */
if (!function_exists('mysql_distance')) {
    function mysql_distance($lon, $lat, $lon_field_name = "lon", $lat_field_name = "lat")
    {
        // return "(2*6378.138*ASIN(SQRT(POW(SIN(PI()*(".$lat."-".$lat_field_name.")/360), 2)+COS(PI()*".$lon."/180)* COS(".$lat_field_name."*PI()/180)*POW(SIN(PI()*(".$lon."-".$lon_field_name.")/360), 2))))";
        // return "ROUND(6378.138 * 2 * ASIN( SQRT(POW(SIN((" .(double)$lat ." * PI() / 180- $lat_field_name * PI() / 180) / 2),2) + COS(" .(double)$lat ." * PI() / 180) * COS($lat_field_name * PI() / 180) * POW(SIN((".(double)$lon ."* PI() / 180- $lon_field_name * PI() / 180) / 2),2))) * 1000)";
        return "3956 * 2 * ASIN(SQRT(POWER(SIN((" . ( double )$lat . "-" . $lat_field_name . ") * pi()/180 / 2), 2) +  COS(" . ( double )$lat . " * pi()/180) *  COS(" . $lat_field_name . " * pi()/180) *  POWER(SIN((" . ( double )$lon . " - " . $lon_field_name . ") * pi()/180 / 2), 2)  ))";
    }
}

/**
 * 发送短信接口
 *
 * @param String $mobile
 * @param String $content
 * @author Allan
 */
if (!function_exists('send_sms')) {
    function send_sms($mobile, $content)
    {
        $url = SEND_SMS_URL . '&smsMob=' . $mobile . '&smsText=' . $content;
        if (function_exists('file_get_contents')) {
            $file_contents = file_get_contents($url);
        } else {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }
}

/**
 * 过滤空值的k-v数组
 *
 * @param array $params
 * @author andywu
 */
if (!function_exists('filter_empty_array')) {
    function filter_empty_array(&$params)
    {
        if (is_object($params)) {
            foreach ($params as $k => $v) {
                if (null === @is_vail($v)) {
                    unset ($params->$k);
                    continue;
                }
            }
        } else {
            foreach ($params as $k => $v) {
                if (null === @is_vail($v)) {
                    unset ($params [$k]);
                    continue;
                }
            }
        }
        return $params;
    }
}
/**
 * 判断插入、更新、删除提交时间
 *
 * @param String $params
 * @author andywu
 */
if (!function_exists('has_over_interval')) {
    function has_over_interval($tim1, $time2)
    {
        $ret = "";
        foreach ($params as $k => $v) {
            if ("" === ($v)) {
                continue;
            }
            $ret [$k] = $v;
        }
        return $ret;
    }
}
/**
 * 对象转换为数组
 *
 * @param
 *            object
 * @return array
 * @author andywu
 */
if (!function_exists('object_to_array')) {
    function object_to_array($d)
    {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
             * Return array converted to object Using __FUNCTION__ (Magic constant) for recursive call
             */
            return array_map(__FUNCTION__, $d);
        } else {
            // Return array
            return $d;
        }
    }
}
/**
 * 多条件转换二维数组
 *
 * @param
 *            string
 * @return array
 * @author andywu
 */
if (!function_exists('str2assoc')) {
    function str2assoc($str)
    {
        $ret = array();
        $a = $b = null;
        $a = @is_vail(explode(',', $str));
        if ($a and is_array($a)) {
            for ($i = 0; $i < count($a); $i++) {
                $b = @is_vail(explode(':', $a [$i]));
                if (is_array($b) and count($b) == 2) {
                    $ret [$b [0]] = $b [1];
                }
            }
        }
        return $ret;
    }
}
/**
 * 字符串首字母小写
 *
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('lcfirst')) {
    function lcfirst($str)
    {
        return strtolower(substr($str, 0, 1)) . substr($str, 1);
    }
}
/**
 * 字符串首字母大写
 *
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('ucfirst')) {
    function ucfirst($str)
    {
        return strtoupper(substr($str, 0, 1)) . substr($str, 1);
    }
}
/**
 * 按分隔符字符串首字母小写
 *
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('lcfirst_string')) {
    function lcfirst_string($str, $delimiter = "_")
    {
        $ret = "";
        $tmp = explode($delimiter, $str);
        foreach ($tmp as &$v) {
            $v = lcfirst($v);
        }
        return implode($delimiter, $tmp);
    }
}
/**
 * 按分隔符字符串首字母小写
 *
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('ucfirst_string')) {
    function ucfirst_string($str, $delimiter = "_")
    {
        $ret = "";
        $tmp = explode($delimiter, $str);
        foreach ($tmp as &$v) {
            $v = ucfirst($v);
        }
        return implode($delimiter, $tmp);
    }
}
/**
 * 按分隔符字符串首字母小写
 *
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('to_fields')) {
    function to_fields($fields, $delimiter = ",")
    {
        return @is_vail($fields) ? explode($delimiter, $fields) : array();
    }
}
/**
 * 简化输出echo函数
 *
 * @param
 *            mix
 * @return void
 * @author andywu
 */
if (!function_exists('e')) {
    function e($c)
    {
        echo $c;
        return;
    }
}
/**
 * 简化输出var_dump函数
 *
 * @param
 *            mix
 * @return void
 * @author andywu
 */
if (!function_exists('v')) {
    function v($content)
    {
        var_dump($content);
        return;
    }
}
/**
 * 有内容则输出
 *
 * @param
 *            mix
 * @param
 *            string
 * @return void
 * @author andywu
 */
if (!function_exists('ee')) {
    function ee($content, $tag = "")
    {
        if (@is_vail($tag) and @is_vail($content)) {
            echo sprintf($tag, $content);
        } else {
            echo @is_vail($content);
        }
        return;
    }
}
/**
 * 判断参数为所设定的值则输出该值
 *
 * @param
 *            mix
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('e_vail')) {
    function e_vail($c, $val)
    {
        return $val == @is_vail($c) ? $c : "";
    }
}

/**
 * 判断参数为所设定的值则输出指定值
 *
 * @param
 *            mix
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('e_vail_s')) {
    function e_vail_s($c, $val, $s)
    {
        echo $val == @is_vail($c) ? $s : "";
        return;
    }
}

/**
 * 随机生成颜色
 *
 * @param
 *            mix
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('rand_color')) {
    function rand_color($num)
    {
        //color value limits 0-16777215;
        $prehash = '#';    //using string '#' before the color value;
        $rsArr = array();

        for ($i = 0; $i < $num; $i++) {
            $color = rand(0, 16777215);
            $rsArr[$i] = $prehash . dechex($color);
        }
        return $rsArr;
    }
}

/**
 * 生成激活码
 *
 * @param
 *            mix
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('generate_activation_code')) {
    function generate_activation_code($time, $code, $account)
    {
        return md5($time . $code . $account . now());
    }
}
/**
 * 生成缩略图
 *
 * @param
 *            mix
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('makethumb')) {
    function makethumb($src_image, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h, $dir, $dst_name)
    {

        $url = null;
        //生成裁剪后的图片
        $jpeg_quality = 90;

        //获取图片扩展名
        if (substr($src_image, 14, 1) == ";") {
            $ext = substr($src_image, 11, 3);
        } elseif (substr($src_image, 15, 1) == ";") {
            $ext = substr($src_image, 11, 4);
        }

        switch ($ext) {
            case "png":
            case "gif":
                $convert_img_name = "convert_" . random_num(1) . ".jpeg";
                //$im = new Imagick($src_image);

                $im = new Imagick();
                $svg = file_get_contents($src_image);

                $im->readImageBlob($svg);

                $im->setImageBackgroundColor('white');

                $im->flattenImages(); // This does not do anything.
                $im = $im->flattenImages(); // Use this instead.

                $im->setImageFormat('jpg');
                //$im->writeImage('.'.$dir.$convert_img_name);
                $im->writeImage(config_item('root_path') . $dir . $convert_img_name);
                //$src_image = config_item ( 'base_url' ).$dir.$convert_img_name;
                $src_image = config_item('root_path') . $dir . $convert_img_name;
                break;

            default:
                ;
        }
        $img_r = imagecreatefromjpeg($src_image);
        $dst_r = ImageCreateTrueColor($dst_w, $dst_h);
        imagecopyresampled($dst_r, $img_r, 0, 0, intval($src_x), intval($src_y), $dst_w, $dst_h, intval($src_w), intval($src_h));

        if (imagejpeg($dst_r, "." . $dir . $dst_name, $jpeg_quality)) {
            $url = config_item('base_url') . $dir . $dst_name;
        }

        //生成等比例缩略图(缩放比例10%)
        /*$img_r = imagecreatefromjpeg($url);
        $dst_r = ImageCreateTrueColor( $dst_w * 0.1, $dst_h * 0.1 );
        imagecopyresampled($dst_r,$img_r,0,0,0,0, $dst_w * 0.1,$dst_h * 0.1, intval($dst_w),intval($dst_h));

        if(imagejpeg($dst_r,".".$dir."thumb_".$dst_name,$jpeg_quality)){
            $thumb_url = config_item ( 'base_url' ) . $dir . "thumb_" . $dst_name;
        }*/
        return $url;
    }
}


/**
 * 生成缩略图
 *
 * @param
 *            mix
 * @param
 *            string
 * @return string
 * @author andywu
 */
if (!function_exists('makepngthumb')) {
    function makepngthumb($src_image, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h, $dir, $dst_name)
    {
        $url = null;
        //生成裁剪后的图片
        $jpeg_quality = 90;

        //获取图片扩展名
        if (substr($src_image, 14, 1) == ";") {
            $ext = substr($src_image, 11, 3);
        } elseif (substr($src_image, 15, 1) == ";") {
            $ext = substr($src_image, 11, 4);
        }

        switch ($ext) {
            case "jpg":
            case "jpeg":
            case "gif":
                $convert_img_name = "convert_" . random_num(1) . ".png";
                $im = new Imagick($src_image);
                $im->setImageBackgroundColor('white');

                $im->flattenImages(); // This does not do anything.
                $im = $im->flattenImages(); // Use this instead.

                $im->setImageFormat('png');
                $im->writeImage('.' . $dir . $convert_img_name);
                $src_image = config_item('base_url') . $dir . $convert_img_name;
                break;

            default:
                ;
        }

        $img_r = imagecreatefrompng($src_image);
        $dst_r = imagecreatetruecolor($dst_w, $dst_h);
        $alpha = imagecolorallocatealpha($dst_r, 0, 0, 0, 127);
        imagefill($dst_r, 0, 0, $alpha);

        imagecopyresampled($dst_r, $img_r, 0, 0, intval($src_x), intval($src_y), $dst_w, $dst_h, intval($src_w), intval($src_h));
        imagesavealpha($dst_r, true);
        // then just copy all the rounded corner images to the 4 corners

        if (imagePNG($dst_r, "." . $dir . $dst_name)) {
            $url = config_item('base_url') . $dir . $dst_name;
        }

        return $url;
    }
}

/**
 * 通过区域（县，区）编码获取市和省编码
 *
 * @param
 *            mix
 * @param
 *            string
 * @return string
 * @author zhenghongdan
 */
if (!function_exists('get_area_code')) {
    function get_area_code($district_code)
    {
        $district = array();
        $district['area'] = $district_code;
        $district['city'] = substr($district_code, 0, 4) . '00';
        $district['province'] = substr($district_code, 0, 2) . '0000';
        return $district;
    }
}
/* End of file util_helper.php */
/* Location: ./system/helpers/util_helper.php */