<?php
$ret ['code'] = 200;
$ret ['data'] = @is_vail($data) ? $data : array();
$ret ['msg'] = @is_vail($msg) ? $msg : "";
echo json_encode($ret);
?>