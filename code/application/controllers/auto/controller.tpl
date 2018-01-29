<?php
if (! defined ( 'BASEPATH' ))
    exit ( 'No direct script access allowed' );

/**
 * {resource_name}资源类
 *
 * @author andywu
 * @version $Id$
 */
class {class_name} extends MQ_Controller {
    public function __construct() {
        parent::__construct ();
        $this->_m('{model_name}');
}

/**
* 获得指定供应商资源
*
* @param integer ID
* @param fields 需要获得字段的列表名称
* @return string
* @example http://api.erp.ttzg.com/{resource_name}/get?
*                 {resource_name}=1&
*                 fields=supplier_id,supplier_name,createtime,updatetime
*/
public function get() {
$params = array ();
$required = array (
{GETMUST}
);
$optional = array(
'fields'
);
/**
* 如果参数不满足，则返回错误信息
*/
if ( !($params = $this->_params ( $required, $optional )) ) {
api_error ( 0101, "param is not set: ", $required );
}
$params['fields'] = @is_vail($params['fields'])?explode(',', $params['fields']):array();
$this->{model}->{key_name} = $params['{key_name}'];
$this->_data['out'] = $this->{model}->g($params['fields']);
$this->_v();
}

/**
* 添加一个资源
*
* @param string 名称
* @param string 需要获得字段的列表名称
* @return string
* @example http://api.erp.ttzg.com/{resource_name}/post?
*                 supplier_name=1&
*                 supplier_contact=侯晓宇&
*                 supplier_tel=024-832323&
*                 contury_code=086&
*                 city_code=024&
*                 address=青年大街51号B座25楼&
*/
public function post() {
$params = array ();
$required = array (
{POSTMUST}
);
$optional = array(
{POSTOPTIONAL}
);
/**
* 如果参数不满足，则返回错误信息
*/
if ( !($params = $this->_params ( $required, $optional )) ) {
api_error ( 0102, "param is not set: ", $required );
}
$params['updatetime'] = now();
$params['createtime'] = now();
$this->{model}->assign($params);
$this->_data['out'] = $this->{model}->a();
$this->_v();
}

/**
* 获得指定资源
*
* @param integer ID
* @param string 需要获得字段的列表名称
* @return string
* @example http://api.erp.ttzg.com/{resource_name}/get?
*                 supplier_id=1&
*                 supplier_name=1&
*                 supplier_contact=侯晓宇&
*                 supplier_tel=024-832323&
*                 contury_code=086&
*                 city_code=024&
*                 address=青年大街51号B座25楼&
*/
public function put() {
$params = array ();
$required = array (
{PUTMUST}
);
$optional = array(
{PUTOPTIONAL}
);
/**
* 如果参数不满足，则返回错误信息
*/
if ( !($params = $this->_params ( $required, $optional )) ) {
api_error ( 0103, "param is not set: ", $required );
}
$params['updatetime'] = now();
$this->{model}->assign($params);
$this->_data['out'] = $this->{model}->u();
$this->_v();
}

/**
* 获得指定资源
*
* @param integer ID
* @return boolean 删除成功与否
* @example http://api.erp.ttzg.com/{resource_name}/get?
*                 supplier_id=1&
*/
public function delete() {
$params = array ();
$required = array (
{DELETEMUST}
);
$optional = array(
);
/**
* 如果参数不满足，则返回错误信息
*/
if ( !($params = $this->_params ( $required, $optional )) ) {
api_error ( 0104, "param is not set: ", $required );
}
$this->{model}->assign($params);
$this->_data['out'] = $this->{model}->d();
$this->_v();
}

}

/* End of file {file_name}.php */
/* Location: ./application/controllers/{file_name}.php */