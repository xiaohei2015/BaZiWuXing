<?php

namespace Xiaohei2015\BaZiWuXing;

/**
 * 计算喜用神
 */
class GladUseGod
{
    private static $relationship = [
        WuXingJudger::JIN => [
            'same' => [WuXingJudger::JIN, WuXingJudger::TU],
            'diff' => [WuXingJudger::MU, WuXingJudger::SHUI, WuXingJudger::HUO],
        ],
        WuXingJudger::MU => [
            'same' => [WuXingJudger::MU, WuXingJudger::SHUI],
            'diff' => [WuXingJudger::JIN, WuXingJudger::HUO, WuXingJudger::TU],
        ],
        WuXingJudger::SHUI => [
            'same' => [WuXingJudger::SHUI, WuXingJudger::JIN],
            'diff' => [WuXingJudger::MU, WuXingJudger::HUO, WuXingJudger::TU],
        ],
        WuXingJudger::HUO => [
            'same' => [WuXingJudger::HUO, WuXingJudger::MU],
            'diff' => [WuXingJudger::JIN, WuXingJudger::SHUI, WuXingJudger::TU],
        ],
        WuXingJudger::TU => [
            'same' => [WuXingJudger::TU, WuXingJudger::HUO],
            'diff' => [WuXingJudger::JIN, WuXingJudger::MU, WuXingJudger::SHUI],
        ],
    ];

    public static function getSameKind($day_gan)
    {
        $wu_xing = WuXingJudger::getProperty($day_gan);
        return self::$relationship[$wu_xing]['same'];
    }

    public static function getDiffKind($day_gan)
    {
        $wu_xing = WuXingJudger::getProperty($day_gan);
        return self::$relationship[$wu_xing]['diff'];
    }

    public static function getGladUseGod($ba_zi)
    {
        $judger = new WuXingJudger($ba_zi);
        $arr_strength = $judger->getStrengthResult();
        $arr_wx_same = self::getSameKind($judger->getDayGan());
        $arr_wx_diff = self::getDiffKind($judger->getDayGan());
        $strength_same = 0;
        foreach($arr_wx_same as $v){
            $strength_same += $arr_strength[$v];
        }
        $strength_diff = 0;
        foreach($arr_wx_diff as $v){
            $strength_diff += $arr_strength[$v];
        }

        if($strength_same > $strength_diff){
            return $arr_wx_diff;
        }elseif($strength_same < $strength_diff){
            return $arr_wx_same;
        }else{
            return array_merge($arr_wx_same,$arr_wx_diff);
        }
    }

    public static function getGladUseGodDetails($ba_zi)
    {
        $judger = new WuXingJudger($ba_zi);
        $arr_strength = $judger->getStrengthResult();
        $arr_wx_same = self::getSameKind($judger->getDayGan());
        $arr_wx_diff = self::getDiffKind($judger->getDayGan());
        $strength_same = 0;
        foreach($arr_wx_same as $v){
            $strength_same += $arr_strength[$v];
        }
        $strength_diff = 0;
        foreach($arr_wx_diff as $v){
            $strength_diff += $arr_strength[$v];
        }

        return [
            'same' => $arr_wx_same,
            'diff' => $arr_wx_diff,
            'strength_same' => sprintf('%.3f', $strength_same),
            'strength_diff' => sprintf('%.3f', $strength_diff),
            'strength_all'  => $arr_strength,
            'glad_use_god' => self::getGladUseGod($ba_zi),
        ];
    }
}