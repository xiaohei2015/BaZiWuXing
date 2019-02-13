<?php

require __DIR__ . "/../src/index.php";

use Xiaohei2015\BaZiWuXing\TianGanEntity;
use Xiaohei2015\BaZiWuXing\DiZhiEntity;
use Xiaohei2015\BaZiWuXing\WuXingJudger;

//Tian Gan testing
echo TianGanEntity::getPropertyByTianGan('甲');
echo TianGanEntity::getStrengthByTianGanAndMonth('癸','亥');

//DiZhi testing
echo DiZhiEntity::getPropertyByDiZhi('酉');
var_export(DiZhiEntity::getStrengthByDiZhiAndMonth('戌','申'));

//WuXingJudger testing
$judger = new WuXingJudger('戊申辛酉壬寅甲辰');
var_export($judger->getStrengthResult());