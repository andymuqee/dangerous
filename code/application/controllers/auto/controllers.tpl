<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 * 封装资源类
 *
 * @author andywu
 * @version $Id: package.php 106 2014-05-07 07:13:11Z wudi $
 */
class Package extends MQ_Controller {
	public function __construct() {
		parent::__construct ();
		$this->_m("package_model");
}

/**
* 获得指定供应商资源
*
* @param integer 封装ID
* @param fields 需要获得字段的列表名称
* @return string
* @example http://api.erp.ttzg.com/package/get?
*                 package_id=1&
*                 fields=package_name,package_alias,package_category,remark,createtime,updatetime
*/
public function get() {
$params = array ();
$required = array (
'package_id'
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

$this->_data['out'] = $this->package->get($params['package_id'], $params['fields']);
$this->_v();
}

/**
* 添加一个供应商资源
*
* @param string 封装名称
* @param string 需要获得字段的列表名称
* @return string
* @example http://api.erp.ttzg.com/package/post?
*                 package_name=BGA&
*                 package_alias=BGA&
*                 package_category=1&
*                 remark=备注&
*                 createtime=1023430234&
*                 updatetime=1023430235&
*/
public function post() {
$params = array ();
$required = array (
'package_name',
'package_category'
);
$optional = array(
'package_alias',
'remark',
'createtime',
'updatetime'
);
/**
* 如果参数不满足，则返回错误信息
*/
if ( !($params = $this->_params ( $required, $optional )) ) {
api_error ( 0102, "param is not set: ", $required );
}
$this->_data['out'] = $this->package->add_data($params);
//        $this->_data['msg'] =
$this->_v();
}

/**
* 更新指定封装资源
*
* @param integer 封装ID
* @param string 需要获得字段的列表名称
* @return string
* @example http://api.erp.ttzg.com/package/put?
*                 package_id=1&
*                 package_name=1&
*                 package_contact=侯晓宇&
*                 package_tel=024-832323&
*                 contury_code=086&
*                 city_code=024&
*                 address=青年大街51号B座25楼&
*/
public function put() {
$params = array ();
$required = array (
'package_id'
);
$optional = array(
'package_name',
'package_alias',
'package_category',
'remark',
'createtime',
'updatetime'
);
/**
* 如果参数不满足，则返回错误信息
*/
if ( !($params = $this->_params ( $required, $optional )) ) {
api_error ( 0103, "param is not set: ", $required );
}
$set = $params;
unset($set['package_id']);
$this->_data['out'] = $this->package->set_data($params['package_id'], $params);
$this->_v();
}

/**
* 删除指定封装资源
*
* @param integer 封装ID
* @return boolean 删除成功与否
* @example http://api.erp.ttzg.com/package/get?
*                 package_id=1&
*/
public function delete() {
$params = array ();
$required = array (
'package_id'
);
$optional = array(
);
/**
* 如果参数不满足，则返回错误信息
*/
if ( !($params = $this->_params ( $required, $optional )) ) {
api_error ( 0104, "param is not set: ", $required );
}
$this->_data['out'] = $this->package->delete($params['package_id']);
$this->_v();
}

}

/* End of file package.php */
/* Location: ./application/controllers/package.php */