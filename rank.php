<?php
// vim: set expandtab cindent tabstop=4 shiftwidth=4 fdm=marker:
 
/**
 * @file     initRank.php
 * @version  1.0
 * @author   wade
 * @date     2014-12-02 21:26:11
 * @desc     本文讲述如何基本redis有序集合生成游戏排行榜数据
 */

$redis = new Redis();
$redis->connect('127.0.0.1', '6379');

$scoreKey = 'user:score';

// init rank
$uidList = range(10000, 20000); // 初始化列表
shuffle($uidList);
foreach ($uidList as $uid) {
    $score = mt_rand(1, 10000000);
    $redis->zAdd($scoreKey, $score, $uid);
}

// get top 50
// zrange user:score -50 -1 withscores
$top50List = $redis->zRange($scoreKey, -50, -1, TRUE);
var_export($top50List);
