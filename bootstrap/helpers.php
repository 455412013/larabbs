<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/8 0008
 * Time: 14:28
 */


function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
function make_excerpt($value, $length = 200)
{
//    strip_tags剥去字符串中的 HTML 标签：
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}
