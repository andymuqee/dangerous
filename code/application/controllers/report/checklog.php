<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * 检查记录类
 *
 * @author andywu
 * @version $Id$
 */
class Checklog extends MQ_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_m('sys_item_model');
        $this->_m('sys_place_model');
        $this->_m('sys_user_model');
        $this->_m('sys_team_model');
        $this->_m('sys_check_log_model');
    }

    /**
     * 检查日志
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
        $this->_page_subtitle = '检查记录';
        // where
        $params['where'] = array();
        is_vail($params['kw']) ? $params['where']['kw like'] = "%" . $params['kw'] . "%" : null;
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

        $params['fields'] = array();
        $params['order'] = array();
        $params['page'] = is_vail($params['page']) ? $params['page'] : 1;
        $params['pagenums'] = is_vail($params['pagenums']) ? $params['pagenums'] : 20;
        $ret = $this->sys_check_log->lists($params);
//        $this->sys_check_log->sqlDebug();
        foreach ($ret as $v) {
            $v->item_name = $this->sys_item->name($v->item_id);
            $v->place_name = $this->sys_place->name($v->place_id);
            $v->team_name = $this->sys_team->name($v->team_id);
            $v->realname = $this->sys_user->get_name($v->check_user_id, 'realname');
        }
        /***分页***/
        $this->_data ['page_tpl'] = $this->page($this->sys_check_log, $params);
        /***分页结束***/
        $this->_data ['data'] = $ret;
        $this->_data ['item'] = $this->sys_item->get_kv();
        $this->_data ['team'] = $this->sys_team->get_kv();
        $this->_data ['place'] = $this->sys_place->get_kv();
        $params['ajax'] == 'true' ? $this->_v() : $this->_v('report/checklog/index.tpl.php');
    }

    public function user()
    {
        /**
         * 如果参数不满足，则返回错误信息
         */

        $params = $this->p(array('check_user_id'), array('page', 'pagenums', 'ajax'), true, function () {
            show_error("页面错误");
        });
        $this->_page_title = '报表';
        $this->_page_subtitle = '危险品类统计';
        $total = $this->sys_check_log->group('check_user_id', 'nums', 'check_user_id', array("check_user_id" => $params["check_user_id"]));
        $day = $this->sys_check_log->group('check_user_id', 'nums', 'check_user_id', array("check_user_id" => $params["check_user_id"], "date_format(FROM_UNIXTIME(created),'%Y-%m-%d') = date_format(now(),'%Y-%m-%d')" => null));
        $this->_data ['data'] = array("total" => @is_vail($total[0]->nums), "day" => @is_vail($day[0]->nums));
        $this->_params['ajax'] == 'true' ? $this->_v() : $this->_v('report/itemlog/index.tpl.php');
    }

    public function save()
    {
        $required = array(
            'check_user_id',
            'team_id',
            'item_id',
            'place_id',
            'img_url',
            'nums',

        );
        $optional = array(
            'check_log_id',
            'remark',
            'ajax'
        );

        /**
         * 如果参数不满足，则返回错误信息
         */
        $params = $this->p($required, $optional, true, function () {
            $this->_params['ajax'] == 'true' ? api_error(404, "param is not set: error") : show_error("param is not set: error");
        });
        $params['modified'] = time();
        if ($params['check_log_id']) {
            $this->sys_check_log->assign($params);
            $this->_data ['data'] = $this->sys_check_log->u();
        } else {
            $params['created'] = time();
            $this->sys_check_log->assign($params);
            $this->_data ['data'] = $this->sys_check_log->a();
        }

        if (!$this->_data ['data']) {
            $this->_params['ajax'] == 'true' ? api_error(false, '操作失败') : show_error('操作失败');
        } else {
            if ($this->_params['ajax'] == 'true') {
                $this->_data ['msg'] = '操作成功';
                $this->_v();
            } else {
                $this->redirect('report/checklog/index', '操作成功');
            }
        }
    }


}

/* End of file supplier.php */
/* Location: ./application/controllers/sys/supplier.php */