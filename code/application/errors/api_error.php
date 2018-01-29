<?php
$data ['response'] = array(
    'code' => 0,
    'msg' => 'ok'
);
$data ['response'] ['code'] = $error_code;
$data ['response'] ['msg'] = $error_msg . implode(', ', $error_args);
echo json_encode($data);
?>