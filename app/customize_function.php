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

// function show_content($str)
// {
//     return preg_replace("/<br.*>/U", "\r\n", $str);
// }

?>