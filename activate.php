<?php

$resource = Mage::getSingleton('core/resource');
$read = $resource->getConnection('core_read');
$write = $resource->getConnection('core_write');

$sql = "SELECT entity_id FROM temp_customers WHERE hash = '". $_GET['hash'] ."' and active = '0'";
$sqlQuery = $read->fetchAll($sql);

if( count($sqlQuery)>0 ){
    // update active
    $data = array("active" => "1");
    $where = "hash = '". $_GET['hash'] ."'";
    $write->update("temp_customers", $data, $where);
    $message = array(
        'code' => 200,
        'status' => API_STATUS_SUCCESS,
        'message' => API_MESSAGE_SUCCESS,
        'data' => true
    );
    echo json_encode($message);die;
} else {
    $message = array(
        'code' => 301,
        'status' => API_STATUS_FAIL,
        'message' => API_MESSAGE_FAIL,
        'data' => false
    );
    echo json_encode($message);die;
}