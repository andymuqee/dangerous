<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitchen_Supplier_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitchen_Supplier_Model extends MQ_Model
{
    /**
     *供货商ID
     * @var int
     */
    public $supplier_id;
    /**
     *供货商名称
     * @var varchar
     */
    public $name;
    /**
     *所属公寓ID
     * @var int
     */
    public $department_id;
    /**
     *联系电话
     * @var varchar
     */
    public $contact_phone;
    /**
     *银行卡号
     * @var varchar
     */
    public $bank_account;
    /**
     *开户行
     * @var varchar
     */
    public $open_bank;
    /**
     *税务登记证url
     * @var varchar
     */
    public $tax_registration;
    /**
     *结算方式 1.现金 2.银行付款
     * @var tinyint
     */
    public $settlement_type;
    /**
     *复选材料
     * @var varchar
     */
    public $check_data;
    /**
     *创建时间戳
     * @var char
     */
    public $created;
    /**
     *更新时间戳
     * @var char
     */
    public $modified;
    /**
     *营业执照
     * @var varchar
     */
    public $bussiness_licence;
    /**
     *卫生许可证
     * @var varchar
     */
    public $hygienic_license;
    /**
     *食品流通许可证
     * @var varchar
     */
    public $food_license;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitchen_suppliers";
        $this->_key = "supplier_id";
        $this->_name = "supplier_id";
        //{models}
    }

    /**
     * 批量查询数据
     * @param array $params 查询参数
     * @return stdClass
     */
    public function lists($params = array('where' => array(),
        'fields' => array(),
        'order' => array(),
        'page' => null,
        'pagenums' => null))
    {
        // todo where
        return $this->get_lists($params['where'], $params['fields'], $params['order'], $params['page'], $params['pagenums']);
    }

    public function update($values)
    {
        $where = array($this->_key => $values[$this->_key]);
        $res = $this->db->update($this->_table, $values, $where, $orderby = array(), $limit = FALSE);
        return $res;
    }

    public function update_batch($values)
    {

        $where = array(//'is_del' =>0,

        );
        $this->db->update_batch($this->_table, $values, $this->_key, $where);

    }
}

/* End of file kitchen_supplier_model.php */
/* Location: ./application/models/kitchen_supplier_model.php */