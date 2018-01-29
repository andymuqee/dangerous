<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * Kitchen_Warehouse_Storage_Model
 *
 * @author andywu
 * @version $Id$
 */
class Kitchen_Warehouse_Storage_Model extends MQ_Model
{
    /**
     *
     * @var int
     */
    public $storage_id;
    /**
     *所属公寓ID
     * @var int
     */
    public $department_id;
    /**
     *公寓名称
     * @var varchar
     */
    public $department_name;
    /**
     *库房类型 1.主食库 2.副食库 3.调味品库 4.炝拌菜谱
     * @var tinyint
     */
    public $type;
    /**
     *基础库类型 1.蔬菜 2.肉蛋禽 3.主食 4.调味品
     * @var tinyint
     */
    public $base_type;
    /**
     *所属菜品名ID即品名
     * @var int
     */
    public $goods_id;
    /**
     *所属菜品名即品名
     * @var varchar
     */
    public $goods_name;
    /**
     *规格1.公斤2.斤3.两4.克5.袋6.箱7.件8.桶9瓶
     * @var tinyint
     */
    public $special;
    /**
     *重量
     * @var decimal
     */
    public $weight;
    /**
     *数量
     * @var int
     */
    public $quantity;
    /**
     *单价
     * @var decimal
     */
    public $price;
    /**
     *总价
     * @var decimal
     */
    public $total_price;
    /**
     *生成日期时间戳
     * @var char
     */
    public $manufacture_date;
    /**
     *保质期时间戳
     * @var char
     */
    public $quality_guarantee_period;
    /**
     *购买日期时间戳
     * @var char
     */
    public $purchase_date;
    /**
     *供货商ID
     * @var int
     */
    public $supplier_id;
    /**
     *照片
     * @var varchar
     */
    public $pic;
    /**
     *入库人
     * @var varchar
     */
    public $storage_person;
    /**
     *进货人
     * @var varchar
     */
    public $purchaser;
    /**
     *验收人
     * @var varchar
     */
    public $check_person;
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
     *单位规格重量
     * @var varchar
     */
    public $unit_weight;
    /**
     *单位规格
     * @var varchar
     */
    public $unit_special;
    /**
     *真正的重量，统一划成公斤(kg）
     * @var decimal
     */
    public $real_weight;


    public function __construct($arr = array())
    {
        parent::__construct($arr);
        $this->_table = "kitchen_warehouse_storage";
        $this->_key = "storage_id";
        $this->_name = "storage_id";
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

/* End of file kitchen_warehouse_storage_model.php */
/* Location: ./application/models/kitchen_warehouse_storage_model.php */