<?php
/**
 * Created by PhpStorm.
 * User: lance
 * Date: 2017/12/12
 * Time: 21:46
 */

namespace App\Observers;

use App\Models\Link;
use Cache;

class LinkObserver
{
    // 在保持时清空 cache_key 对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }
}