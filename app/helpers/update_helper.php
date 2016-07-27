<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(! function_exists('get_remote_contents')) {
    function get_remote_contents($url, $post_fields = NULL) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if($post_fields) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
        }
        $resp = curl_exec($curl);
        if($resp) { $result = $resp; }
        else { $result = json_encode(array('status' => 'Failed', 'message' => 'Curl Error: "' .curl_error($curl).'"')); }
        curl_close($curl);
        return $result;
    }
}

if(! function_exists('save_remote_file')) {
    function save_remote_file($file) {
        $protocol = is_https() ? 'https://' : 'http://';
        file_put_contents('./files/updates/'.$file, fopen($protocol.'tecdiary.com/api/v1/download/file/'.$file, 'r'));
        return true;
    }
}
