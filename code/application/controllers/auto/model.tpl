<?php
if (! defined ( 'BASEPATH' ))
    exit ( 'No direct script access allowed' );

/**
 * {class_name}_Model
 *
 * @author andywu
 * @version $Id$
 */
class {class_name}_Model extends MQ_Model {
{property}

    public function __construct($arr = array()) {
        parent::__construct ($arr);
        $this->_table = "{table_name}";
$this->_key = "{key_name}";
$this->_name = "{primary_name}";
//{models}
}

/**
* 批量查询数据
* @param array $params 查询参数
* @return stdClass
*/
public function lists( $params=array('where'=>array(),
'fields'=>array(),
'order'=>array(),
'page'=>null,
'pagenums'=>null)){
// todo where
return $this->get_lists($params['where'], $params['fields'], $params['order'], $params['page'],$params['pagenums']);
}
public function update($values) {
$where = array($this->_key =>$values[$this->_key] );
$res = $this->db->update($this->_table, $values, $where, $orderby = array(), $limit = FALSE);
return $res;
}
public function update_batch($values) {

$where = array (
//'is_del' =>0,

);
$this->db->update_batch($this->_table,$values,$this->_key,$where);

}
}

/* End of file {file_name}_model.php */
/* Location: ./application/models/{file_name}_model.php */