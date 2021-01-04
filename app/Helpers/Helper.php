<?php

if (!function_exists('responData')){
    function responData($pesan, $data, $status) {
        $res = array();
        $res['sukses'] = $status;
        $res['pesan'] = $pesan;
        $res['data'] = $data;
        return response()->json($res);
    }
}

?>
