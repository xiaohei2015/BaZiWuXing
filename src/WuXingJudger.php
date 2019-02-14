<?php

namespace Xiaohei2015\BaZiWuXing;

/**
 * 根据八字推算五行
 */
class WuXingJudger
{
    private $year_gan = '';
    private $year_zhi = '';

    private $month_gan = '';
    private $month_zhi = '';

    private $day_gan = '';
    private $day_zhi = '';

    private $hour_gan = '';
    private $hour_zhi = '';

    const JIN = '金';
    const MU = '木';
    const SHUI = '水';
    const HUO = '火';
    const TU = '土';

    public function __construct($ba_zi)
    {
        $this->init($ba_zi);
    }

    private function init($ba_zi)
    {
        if(mb_strlen($ba_zi, 'UTF-8') <> 8){
            throw new \Exception('参数有误，参数个数为：'.mb_strlen($ba_zi));
        }

        $this->year_gan = mb_substr($ba_zi,0,1,'UTF-8');
        $this->year_zhi = mb_substr($ba_zi,1,1,'UTF-8');

        $this->month_gan = mb_substr($ba_zi,2,1,'UTF-8');
        $this->month_zhi = mb_substr($ba_zi,3,1,'UTF-8');

        $this->day_gan = mb_substr($ba_zi,4,1,'UTF-8');
        $this->day_zhi = mb_substr($ba_zi,5,1,'UTF-8');

        $this->hour_gan = mb_substr($ba_zi,6,1,'UTF-8');
        $this->hour_zhi = mb_substr($ba_zi,7,1,'UTF-8');
    }

    public static function isProperty($name, $expect_property)
    {
        $property = TianGanEntity::getPropertyByTianGan($name);
        if($property){
            return $property==$expect_property;
        }else{
            $property = DiZhiEntity::getPropertyByDiZhi($name);
            if($property){
                return $property==$expect_property;
            }else
                return false;
        }
    }

    public static function getProperty($name)
    {
        $property = TianGanEntity::getPropertyByTianGan($name);
        if($property){
            return $property;
        }else{
            $property = DiZhiEntity::getPropertyByDiZhi($name);
            if($property){
                return $property;
            }else
                return false;
        }
    }

    public function getStrengthByWuXing($wu_xing)
    {
        $strength = 0;
        //天干
        $arr_gan = [$this->year_gan, $this->month_gan, $this->day_gan, $this->hour_gan];
        foreach($arr_gan as $v){
            if(self::isProperty($v, $wu_xing)){
                $strength += TianGanEntity::getStrengthByTianGanAndMonth($v, $this->month_zhi);
            }
        }
        //地支
        $arr_zhi = [$this->year_zhi, $this->month_zhi, $this->day_zhi, $this->hour_zhi];
        foreach($arr_zhi as $v){
            $arr_cang = DiZhiEntity::getStrengthByDiZhiAndMonth($v, $this->month_zhi);
            foreach($arr_cang as $k=>$v){
                if(self::isProperty($k, $wu_xing)){
                    $strength += $v;
                }
            }
        }

        return sprintf('%.3f', $strength);
    }

    public function getStrengthResult()
    {
        return [
            self::JIN   => $this->getStrengthByWuXing(self::JIN),
            self::MU    => $this->getStrengthByWuXing(self::MU),
            self::SHUI  => $this->getStrengthByWuXing(self::SHUI),
            self::HUO   => $this->getStrengthByWuXing(self::HUO),
            self::TU    => $this->getStrengthByWuXing(self::TU),
        ];
    }

    public function getDayGan()
    {
        return $this->day_gan;
    }
}