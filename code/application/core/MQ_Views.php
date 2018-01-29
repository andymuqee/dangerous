<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * TTZG_View Class
 *
 * @package TTZG
 * @subpackage Libraries
 * @category Libraries
 * @author xzd Dev Team
 * @version $Id: MQ_Viewshp 106 2014-05-07 07:13:11Z wudi $
 * @link
 *
 */
class MQ_Views extends CI_Loader
{
    public function __construct()
    {
        parent::__construct();
    }

    public function output($data, $out_format = 'json')
    {
        switch ($out_format) {
            case 'json' :
                json_encode($data);
                break;
            case 'xml' :
                ;
            default :
                break;
        }
    }
}

?>
