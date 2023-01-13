<?php

function print_a($value){
    
    echo "<pre>";
    print_r($value);
    echo "</pre>";

}

function unfilterHtmlChars($str)
{
	return str_replace(array('&lt;', '&gt;'), array('<', '>'), $str);
}

function filterHtmlChars($str)
{
	return str_replace(array('<', '>'), array('&lt;', '&gt;'), $str);
}

function LineNotify($Data = []){

    $headers = array(
        'Content-Type: multipart/form-data',
        'Authorization: Bearer xRExHpqwzyuu7HEpm5pH7T6iwgsTAXRM7h9u4Csd7bR'
    );
    $message = array(
        'message' => "\n登入位置:".$Data['local']."\n登入帳號:".$Data['account']."\n登入者IP:".$Data['cliect_ip']."\n是否成功:".$Data['enter']."。"
    );
    $ch = curl_init();
    curl_setopt($ch , CURLOPT_URL , "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    
    $result = curl_exec($ch);
    curl_close($ch);

}

// function show_content($str)
// {
//     return preg_replace("/<br.*>/U", "\r\n", $str);
// }

?>