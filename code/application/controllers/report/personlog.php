<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 检查记录类
 *
 * @author andywu
 * @version $Id$
 */
class Personlog extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('sys_user_model');
        $this->_m('sys_item_model');
        $this->_m('sys_team_model');
        $this->_m('sys_place_model');
        $this->_m('sys_check_log_model');
    }

    /**
     * 项目统计日志
     */
    public function index()
    {
        /**
         * 如果参数不满足，则返回错误信息
         */

        $params = $this->p(array(), array('page', 'pagenums', 'check_user_id', 'item_id', 'team_id', 'place_id', 'date', 'start_date', 'end_date', 'date_range', 'kw', 'ajax'), false, function () {
            show_error("页面错误");
        });
        $this->_page_title = '报表';
        $this->_page_subtitle = '个人统计';
        $params['where'] = array();
        is_vail($params['check_user_id']) ? $params['where']['check_user_id'] = $params['check_user_id'] : null;
        is_vail($params['item_id']) ? $params['where']['item_id'] = $params['item_id'] : null;
        is_vail($params['team_id']) ? $params['where']['team_id'] = $params['team_id'] : null;
        is_vail($params['place_id']) ? $params['where']['place_id'] = $params['place_id'] : null;
        switch ($params['date']) {
            case '1':
                $params['where']["date_format(FROM_UNIXTIME(created),'%Y-%m-%d') = date_format(now(),'%Y-%m-%d')"] = null;
                break;
            case '2':
                $params['where']["YEARWEEK(date_format(FROM_UNIXTIME(created),'%Y-%m-%d')) = YEARWEEK(now())"] = null;
                break;
            case '3':
                $params['where']["date_format(FROM_UNIXTIME(created),'%Y-%m')=date_format(now(),'%Y-%m')"] = null;
                break;
            case '4':
                break;
            default:
                $range = array();
                if (is_vail($params['date_range'])) {
                    $range = explode(',', $params['date_range']);
                    $params['where']["date_format(FROM_UNIXTIME(created),'%Y-%m-%d')>=date_format('" . $range[0] . "','%Y-%m-%d') AND date_format(FROM_UNIXTIME(created),'%Y-%m-%d')<=date_format('" . $range[1] . "','%Y-%m-%d')"] = null;
                }
                break;
        }
        $ret = $this->sys_check_log->group('item_id, check_user_id', 'nums', 'check_user_id', $params['where']);
        $total = 0;
        foreach ($ret as $v) {
            $v->item_name = $this->sys_item->name($v->item_id);
            $v->place_name = $this->sys_place->name($v->place_id);
            $v->team_name = $this->sys_team->name($v->team_id);
            $v->user = $this->sys_user->g_by_id($v->check_user_id, array('user_id', 'realname', 'salary_no'));
        }
        $this->_data ['data'] = $ret;
        $this->_data['total'] = $total;
        $this->_data ['item'] = $this->sys_item->get_kv();
        $this->_data ['team'] = $this->sys_team->get_kv();
        $this->_data ['place'] = $this->sys_place->get_kv();
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->_v('report/personlog/index.tpl.php');
    }


}

/* End of file supplier.php */
/* Location: ./application/controllers/sys/supplier.php */