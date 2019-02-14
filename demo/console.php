<?php

require __DIR__ . "/../src/index.php";

use Xiaohei2015\BaZiWuXing\TianGanEntity;
use Xiaohei2015\BaZiWuXing\DiZhiEntity;
use Xiaohei2015\BaZiWuXing\WuXingJudger;
use Xiaohei2015\BaZiWuXing\GladUseGod;

//Tian Gan testing
echo TianGanEntity::getPropertyByTianGan('甲');
echo TianGanEntity::getStrengthByTianGanAndMonth('癸','亥');

//DiZhi testing
echo DiZhiEntity::getPropertyByDiZhi('酉');
var_export(DiZhiEntity::getStrengthByDiZhiAndMonth('戌','申'));

//WuXingJudger testing
$judger = new WuXingJudger('乙丑戊子甲申戊辰');//壬辰甲辰乙巳丁丑
var_export($judger->getStrengthResult());

//GladUseGod testing
var_export(GladUseGod::getGladUseGodDetails('壬辰甲辰乙巳丁丑'));