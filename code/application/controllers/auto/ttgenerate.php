<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 自动生成模型文件
 *
 * @author andywu
 * @version $Id$
 */
class Mqmake extends MQ_Controller
{
    private $_root_path;
    private $_app_path;
    private $_controller_path;
    private $_model_path;
    private $_view_path;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('inflector');
        $this->load->helper('directory');
        $this->_root_path = $this->config->item('root_path');
        $this->_app_path = $this->_root_path . "/application";
        $this->_controller_path = $this->_app_path . "/controllers";
        $this->_model_path = $this->_app_path . "/models";
        $this->_view_path = $this->_app_path . "/views";
    }

    public function index()
    {
        $this->_v('/auto/index.tpl.php');
    }

    public function c1()
    {
        $models = directory_map($this->_model_path);
        $tmp = array();
        foreach ($models as $k => &$v) {
            if ("_model.php" == substr(strtolower($v), -10, 10)) {
                $tmp [] = ucfirst_string(str_replace("_model.php", "", $v) . "_Model");
            }
        }
        $models = $tmp;

        $this->_data ['models'] = $models;

        $this->_v('/auto/c1.tpl.php');
    }

    public function c2()
    {
        $params = array();
        $required = array(
            'class_name',
            'model_name'
        );
        $optional = array();
        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0101, "param is not set: ", $required);
        }
        $model_name = $params ['model_name'];
        $this->_m($model_name);
        $this->_data ['class_name'] = $params ['class_name'];
        $this->_data ['model_name'] = $params ['model_name'];
        $this->_m($model_name);
        $model_name = str_replace("_model", "", strtolower($model_name));
        $this->_data ['property'] = $this->$model_name->get_property();
        $this->_v('/auto/c2.tpl.php');
    }

    public function c3()
    {
        $params = array();
        $required = array(
            'class_name',
            'model_name',
            'POSTMUST',
            'GETMUST',
            'PUTMUST',
            'DELETEMUST'
        );
        $optional = array(
            'POSTOPTIONAL',
            'GETOPTIONAL',
            'PUTOPTIONAL'
        );

        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0101, "param is not set: ", $required);
        }
        $params ['class_name'] = ucfirst($params ['class_name']);
        $params ['file_name'] = $params ['resource_name'] = lcfirst_string($params ['class_name']);
        $params ['model'] = str_replace("_model", "", lcfirst_string($params ['model_name']));

        $params ['key_name'] = $params ['DELETEMUST'];
        $params ['DELETEMUST'] = $this->__generate_param_list(array(
            $params ['DELETEMUST']
        ));
        $params ['POSTMUST'] = $this->__generate_param_list($params ['POSTMUST']);
        $params ['GETMUST'] = $this->__generate_param_list($params ['GETMUST']);
        $params ['PUTMUST'] = $this->__generate_param_list($params ['PUTMUST']);

        $params ['POSTOPTIONAL'] = @is_vail($params ['POSTOPTIONAL']) ? $this->__generate_param_list($params ['POSTOPTIONAL']) : null;
        $params ['GETOPTIONAL'] = @is_vail($params ['GETOPTIONAL']) ? $this->__generate_param_list($params ['GETOPTIONAL']) : null;
        $params ['PUTOPTIONAL'] = @is_vail($params ['PUTOPTIONAL']) ? $this->__generate_param_list($params ['PUTOPTIONAL']) : null;

        $content = read_file($this->_controller_path . '/auto/controller.tpl');
        foreach ($params as $k => $v) {
            $content = str_replace('{' . $k . '}', $v, $content);
        }
        write_file($this->_controller_path . '/' . $params ['file_name'] . '.php', $content);
        $this->_v('/auto/c3.tpl.php');
    }

    private function __generate_param_list(array $params)
    {
        $line = "%s'%s',\n";
        $ret = "";
        $sp12 = repeater(' ', 12);
        foreach ($params as $v) {
            $ret .= sprintf($line, $sp12, $v);
        }
        return $ret;
    }

    /**
     * 获得指定模型属性
     */
    public function field_by_model()
    {
        $params = array();
        $required = array(
            'model_name'
        );
        $optional = array();
        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0101, "param is not set: ", $required);
        }
        $model_name = $params ['model_name'];
        $this->_m($model_name);
        $this->_data ['fields'] = $this->$model_name->get_property();
        $this->_v();
    }

    public function cs1()
    {
        ;
    }

    public function m1()
    {
        $this->_data ['tbls'] = $this->db->list_tables();
        $this->_v('/auto/m1.tpl.php');
    }

    public function m2()
    {
        $table_name = $_POST ['table_name'];
        if (!$this->db->table_exists($table_name)) {
            // 不存在
            echo "不存在";
            exit ();
            // $this->_v();
        }
        /**
         * 获得该表所有字段
         */
        // $this->_data['fields'] = $this->db->field_data($table_name);
        $query = $this->db->query("SELECT `COLUMN_NAME`,`COLUMN_DEFAULT`,`IS_NULLABLE`,`DATA_TYPE`,`COLUMN_KEY`,`COLUMN_COMMENT`
				                   FROM Information_schema.columns WHERE table_schema='cn_kys_dangerous' AND table_Name='" . $table_name . "'");

        $this->_data ['fields'] = $query->result_array();
        $query->free_result();
        $this->_data ['table_name'] = $table_name;
        $this->_v('/auto/m2.tpl.php');
    }

    /**
     * 获得指定供应商资源
     *
     * @param
     *            integer 供应商ID
     * @param
     *            fields 需要获得字段的列表名称
     * @return string
     * @example http://api.erp.ttzg.com/supplier/get?
     *          supplier=1&
     *          fields=supplier_id,supplier_name,createtime,updatetime
     */
    public function m3()
    {
        $params = array();
        $required = array(
            'table_name',
            'key_name',
            'primary_name',
            'property'
        );
        $optional = array();
        /**
         * 如果参数不满足，则返回错误信息
         */
        if (!($params = $this->_params($required, $optional))) {
            api_error(0101, "param is not set: ", $required);
        }
        // todo 去除表名te_前缀
        $params ['table_name'] = str_replace('cso_', '', $params ['table_name']);
        $content = read_file($this->config->item('root_path') . '/application/controllers/auto/model.tpl');
        if (count($content)) {

            $params ['file_name'] = strtolower(singular($params ['table_name']));
            $params ['class_name'] = ucfirst_string($params ['file_name']);
            foreach ($params as $k => $v) {
                if ("property" == $k) {
                    $content = str_replace('{' . $k . '}', $this->__generate_property($params ['property']), $content);
                } else {
                    $content = str_replace('{' . $k . '}', $v, $content);
                }
            }
        }
//		echo $content;
        try {
            write_file($this->config->item('root_path') . '/application/models/' . $params ['file_name'] . '_model.php', $content);
        } catch (Exception $e) {
            throw new Exception();
        } catch (Exception $e) {
//这里可以捕获到前面一个块抛出的Exception
            var_dump($e);
        }
        $this->_v('/auto/m3.tpl.php');
    }

    /**
     * 生成属性
     *
     * @param array $arr
     * @return string
     */
    private function __generate_property($arr)
    {
        $ret = "";
        $format = "%s/**\n%s*%s\n%s* @var %s\n%s*/\n%spublic $%s;\n";
        $sp4 = repeater(' ', 4);
        $sp = repeater(' ', 5);
        foreach ($arr as $v) {
            $ret .= sprintf($format, $sp4, $sp, $v ['COLUMN_COMMENT'], $sp, $v ['DATA_TYPE'], $sp, $sp4, $v ['COLUMN_NAME']);
        }
        return $ret;
    }
}

/* End of file ttgenerate.php */
/* Location: ./application/controllers/ttgenerate.php */