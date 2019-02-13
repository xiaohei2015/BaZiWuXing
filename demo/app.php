<?php

require __DIR__ . "/../src/index.php";

use Xiaohei2015\BaZiWuXing\TianGanEntity;
use Xiaohei2015\BaZiWuXing\DiZhiEntity;

//Tian Gan testing
echo TianGanEntity::getPropertyByTianGan('甲');
echo TianGanEntity::getStrengthByTianGanAndMonth('癸','亥');

//DiZhi testing
echo DiZhiEntity::getPropertyByDiZhi('酉');
var_export(DiZhiEntity::getStrengthByDiZhiAndMonth('戌','申'));