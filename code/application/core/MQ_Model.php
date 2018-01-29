<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * MQ_Model Class
 *
 * @package TTZG
 * @subpackage Libraries
 * @category Libraries
 * @author xzd Dev Team
 * @version $Id: MQ_Model.php06 2014-05-07 07:13:11Z wudi $
 * @link
 *
 */
class MQ_Model extends CI_Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $_table;
    /**
     * 主键
     *
     * @var String
     */
    protected $_key;
    /**
     * 名字
     *
     * @var string
     */
    protected $_name;
    /**
     * 字段
     *
     * @var array
     */
    protected $_fields;

    public function __construct($arr = array())
    {
        parent::__construct();
        $this->_table = "";
        $this->_key = "";
        $this->_name = "";
        $this->_fields = $this->_to_fields();
        if (count($arr)) {
            $this->assign($arr);
        }
    }

    public function __toString()
    {
        return get_class($this);
    }

    /*
     * public function __clone(){ if (is_array($this->_fields) && count($this->_fields)){ foreach ($this->_fields as $v){ $this->$v = $this->$v; } } }
     */
    /**
     * 剔除通用属性
     *
     * @return multitype:
     */
    private function _to_fields()
    {
        $fields = get_object_vars($this);
        foreach (get_class_vars(__CLASS__) as $k => $v) {
            unset ($fields [$k]);
        }
        $fields = array_keys($fields);
        return $fields;
    }

    /**
     * 返回数据库实例
     * @return mixed
     */
    public function getDbObject()
    {
        return $this->db;
    }

    public function sqlDebug()
    {
        echo $this->db->last_query();
    }

    public function get_table_name()
    {
        return $this->_table;
    }

    /**
     * 将数组赋值到该对象属性值中
     *
     * @param array $arr
     */
    public function assign(array $arr)
    {
        if (is_array($this->_fields) && count($this->_fields)) {
            foreach ($this->_fields as $v) {
                $this->$v = array_key_exists($v, $arr) ? $arr [$v] : null;
            }
        }
    }

    /**
     * 返回该对象有效属性，并返回对象
     *
     * @return stdClass
     */
    public function get_property()
    {
        $obj = new stdClass ();
        foreach ($this->_fields as $v) {
            $obj->$v = $this->$v;
        }
        return $obj;
    }

    /**
     * 返回该对象有效属性，并返回对象
     *
     * @return stdClass
     */
    public function set_property($obj)
    {
        foreach ($this->_fields as $v) {
            $this->$v = @is_vail($obj->$v);
        }
    }

    /**
     * 返回该对象有效属性，并返回对象
     *
     * @return void;
     */
    public function empty_property()
    {
        foreach ($this->_fields as $v) {
            $this->$v = null;
        }
        return void;
    }

    /**
     * 获得字段
     *
     * @return multitype:
     */
    public function get_fields()
    {
        return $this->_fields;
    }

    /**
     * 该id数据是否存在
     *
     * @param int $id
     * @return boolean
     */
    public function is_exists($id)
    {
        $where = array(
            $this->_key => $id
        );
        $query = $this->db->select($this->_key)->where($where)->get($this->_table);
        $nums = $query->num_rows();
        $query->free_result();
        return $nums > 0 ? TRUE : FALSE;
    }

    /**
     * 是否存在给定字段及对应值的记录
     *
     * @param string $key
     * @param string $value
     * @return boolean
     */
    public function is_exists_value($key, $value)
    {
        $where = array(
            $key => $value
        );
        $nums = $this->db->where($where)->count_all_results($this->_table);
        return $nums > 0 ? TRUE : FALSE;
    }

    /**
     * 查询特定表的符合特定字段及特定值的记录
     *
     * @param array $data
     * @param string $table
     * @return boolean
     */
    public function is_exists_data($where)
    {
        $query = $this->db->where($where)->get($this->_table);
        $nums = $query->num_rows();
        $query->free_result();
        return $nums > 0 ? TRUE : FALSE;
    }

    /**
     * 设置指定id记录的指定字段的值
     *
     * @param type $id
     * @param type $key
     * @param type $value
     * @return boolean
     */
    public function set($id, $key, $value)
    {
        $ret = FALSE;
        $where = array(
            $this->_key => $id
        );
        $set = array(
            $key => $value
        );
        if ($this->db->where($where)->update($this->_table, $set)) {
            $ret = TRUE;
        }

        return $ret;
    }

    /**
     * 设置 主键为特定值的记录信息
     *
     * @param type $id
     * @param type $set
     * @return boolean
     */
    public function u($is_empty_vail = FALSE)
    {
        $key = $this->_key;
        return $this->set_data($this->$key, $this->get_property());
    }

    /**
     * 设置 主键为特定值的记录信息
     *
     * @param type $id
     * @param type $set
     * @return boolean
     */
    public function set_data($id, $set, $is_empty_vail = FALSE)
    {
        $ret = FALSE;
        $where = array(
            $this->_key => $id
        );
        if (is_a($set, "MQ_Model")) {
            $set = $set->get_property();
        }
        if (!$is_empty_vail) {
            $set = filter_empty_array($set);
        }
        if ($this->db->where($where)->update($this->_table, $set)) {
            $ret = TRUE;
        }
        return $ret;
    }

    public function set_data_where($set, $where = array(), $is_empty_vail = FALSE)
    {
        $ret = FALSE;
        if (is_a($set, "MQ_Model")) {
            $set = $set->get_property();
        }
        if (!$is_empty_vail) {
            $set = filter_empty_array($set);
        }
        if (count($where) and is_array($where)) {
            if ($this->db->set($set, FALSE)->where($where)->update($this->_table)) {
                $ret = TRUE;
            }
        }
        return $ret;
    }

    public function set_batch_data()
    {

    }

    /**
     * 添加数据记录
     *
     * @param string $is_empty_vail
     * @return number
     */
    public function a($is_empty_vail = FALSE)
    {
        return $this->add_data($this->get_property());
    }

    /**
     * 添加数据记录
     *
     * @param array $set
     * @param string $is_empty_vail
     * @return number
     */
    public function add_data($set, $is_empty_vail = FALSE)
    {
        $ret = 0;
        if (is_a($set, "MQ_Model")) {
            $set = $set->get_property();
        }
        if (!$is_empty_vail) {
            $set = filter_empty_array($set);
        }
        if ($this->db->insert($this->_table, $set)) {
            $ret = $this->db->insert_id();
        }
        return $ret;
    }

    /**
     * add_data别名
     *
     * @param array $set
     * @param string $is_empty_vail
     * @return number
     */
    public function add($set, $is_empty_vail = FALSE)
    {
        return $this->add_data($set, $is_empty_vail);
    }

    /**
     * 批量添加记录数据
     *
     * @param array $sets
     * @return int
     */
    public function add_batch_data($sets, $is_empty_vail = FALSE)
    {
        if (!$is_empty_vail) {
            foreach ($sets as &$v) {
                $v = filter_empty_array($v);
            }
        }
        return $this->db->insert_batch($this->_table, $sets);
    }

    /**
     * 如果该记录已有则更新，否则插入
     *
     * @param array $data
     * @param array $where
     * @return int
     */
    public function save($data, $where = array(), $is_empty_vail = FALSE)
    {
        $ret = 0;
        if (is_a($data, "MQ_Model")) {
            $data = $data->get_property();
        }
        if (count($where) and is_array($where)) {
            if ($this->is_exists_data($where, $this->_table)) {
                $ret = $this->set_data_where($data, $where, $is_empty_vail);
            } else {
                $ret = $this->add_data($data, $is_empty_vail);
            }
        } else {
            $ret = $this->add_data($data, $is_empty_vail);
        }
        return $ret;
    }

    /**
     * 获取键值列表
     * @return mixed
     */
    public function get_kv()
    {
        $query = $this->db->select($this->_key . ',' . $this->_name)->group_by($this->_key . ' ASC')->get($this->_table);
        $ret = $query->result();
        $query->free_result();
        return $ret;
    }

    /**
     * 获得该模型对应数据列表，显示按照fileds显示
     *
     * @param array $where
     * @param array $fileds
     * @param int $paging
     * @param int $pagenums
     * @return mix
     */
    public function get_lists($where, $fields = array(), array $orderby = array(), $paging = 1, $pagenums = 20, $where_in = array(), $group_by = array())
    {
        $ret = array();

        if (count($fields) and is_array($fields)) {
            $select = implode(',', $fields);
            $this->db->select($select);
        }

        if (count($where)) {
            $this->db->where($where);
        }

        if (count($where_in)) {
            $this->db->where_in($where_in['field'], $where_in['array']);
        }
        if (count($group_by)) {
            $this->db->group_by($group_by);
        }

        if ($paging AND $pagenums) {
            $this->db->limit($pagenums, ($paging - 1) * $pagenums);
        }

        /*
         * if (count($orderby) AND is_array($orderby)) { $this->db->order_by($orderby); }
         */

        foreach ($orderby as $k => $v) {
            $this->db->order_by($k, $v);
        }

        $query = $this->db->get($this->_table);
        $ret = $query->result();
        $query->free_result();
        return $ret;
    }

    /**
     * 获得用户信息
     *
     * @param
     *            integer 供应商ID
     * @param
     *            array 筛选字段
     * @return Supplier_Model
     */
    public function g(array $fields = array())
    {
        $key = $this->_key;
        $where = array(
            $key => $this->$key
        );

        if (!count($fields)) {
            $fields = $this->_fields;
        }
        return $this->get_detail($where, $fields);
    }

    /**
     * 获得指定键值的详细记录
     *
     * @param string $key
     * @param string $value
     * @param array $fields
     * @return array
     */
    public function get_detail($where, array $fields = array(), $where_in = array())
    {
        $ret = array();
        $query = NULL;

        if (count($fields) and is_array($fields)) {
            $select = implode(',', $fields);
            $this->db->select($fields, FALSE);
        }

        if (count($where)) {
            $this->db->where($where);
        }
        if (count($where_in)) {
            $this->db->where_in($where_in['field'], $where_in['array']);
        }

        $query = $this->db->get($this->_table);
        $ret = $query->row();
        $query->free_result();
        return $ret;
    }

    public function get_value($field, $key, $value, $orderby = '')
    {
        $ret = "";
        $where = array(
            $key => $value
        );
        $query = $this->db->select($field)->where($where)->get($this->_table);
        $ret = $query->row();
        $query->free_result();
        return $ret;
    }

    public function g_by_id($id, $field)
    {
        return $this->get_value($field, $this->_key, $id);
    }

    public function get_name($id, $field)
    {
        $ret = "";
        $where = array(
            $this->_key => $id
        );
        $query = $this->db->select($field)->where($where)->get($this->_table);
        $ret = $query->row_array();
        $query->free_result();
        return count($ret) ? $ret [$field] : null;
    }

    /**
     * 根据主键id获得对应名字
     *
     * @param int $id
     * @return string
     */
    public function name($id, $key = null)
    {
        $ret = "";
        $key = count($key) ? $key : $this->_key;
        $where = array(
            $key => $id
        );

        $query = $this->db->select($this->_name)->where($where)->get($this->_table);
        $ret = $query->row_array();
        $query->free_result();
        return count($ret) ? $ret [$this->_name] : null;
    }

    public function get_db_fields()
    {
        $ret = array();
        $ret = $this->db->list_fields($this->_table);
        return $ret;
    }

    public function d()
    {
        $key = $this->_key;
        return $this->del_by_id($this->$key);
    }

    public function del_by_id($id)
    {
        $ret = FALSE;
        $where = array(
            $this->_key => $id
        );
        if ($this->db->where($where)->delete($this->_table)) {
            $ret = TRUE;
        }
        return $ret;
    }

    public function del_by_where($where)
    {
        $ret = FALSE;
        if (count($where) and is_array($where)) {
            if ($this->db->where($where)->delete($this->_table)) {
                $ret = TRUE;
            }
        }
        return $ret;
    }

    public function del_batch($ids)
    {
        return $this->db->where_in($this->_key, $ids)->delete($this->_table);
    }

    /**
     * 统计有多少条记录
     */
    public function c()
    {
        return $this->db->count_all($this->_table);
    }

    protected function _m($model)
    {
        $alias = $model;
        $alias = strtolower(substr($alias, 0, strrpos($alias, '_')));
        $this->load->model("$model", "$alias");
    }

    protected function _t($type)
    {
        $this->load->model($type);
    }

    /*
     * 统计该表字段名称，备注
     */
    public function get_cloumn()
    {
        $sql = "SELECT `COLUMN_NAME`,`COLUMN_DEFAULT`,`IS_NULLABLE`,`DATA_TYPE`,`COLUMN_KEY`,`COLUMN_COMMENT`
	 FROM Information_schema.columns WHERE table_schema='" . $this->db->database . "' AND table_Name='" . $this->_table . "'";
        $query = $this->db->query($sql);

        $fields = $query->result_array();
        $query->free_result();
        return $fields;
    }

    public function group($fields, $sum, $groupby, $where = array())
    {
        $this->db->select($fields)->select_sum($sum)->group_by($groupby);
        is_vail($where) ? $this->db->where($where) : null;
        return $this->db->get($this->_table)->result();
    }

}
/* End of file ttzg_model.php */
/* Location: ./application/core/ttzg_model.php */

