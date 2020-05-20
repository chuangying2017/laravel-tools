<?php
/**
 * Created by PhpStorm.
 * User: 张伟
 * Date: 2020/5/2
 * Time: 21:45
 */

namespace Tools\Tools;


class MarketBox
{

    /**
     * 获取数组中相同的键=>值
     * @param array $array
     * @return array
     */
    public function theSame(array $array): array
    {
        $sameArr = [];

        foreach ($array as $k => $v)
        {
            $count = count($array) - 1;

            $corrue = false;

            for ($i = $k + 1; $i <= $count; $i++)
            {
                if ($v == $array[$i] && !in_array($k , $sameArr))
                {
                    $corrue = true;

                    $sameArr[] = $i;
                }
            }

            if ($corrue)
            {
                $sameArr[] = $k;
            }
        }

        return array_reduce($sameArr,function($carry, $keys)use($array){
            $carry[$keys] = $array[$keys];
            return $carry;
        }, []);
    }

    /**
     * 简单递推算法
     * @param int $int
     * @param array $array
     * @return array
     */
    public function hanNuoTaAlgorithm(int $int = 59, array $array = [])
    {
        $head = range('A','Z');

        if (empty($array))
            $array = $head;
        $int -= 26;

        foreach ($head as $k => $value)
        {
            for ($i=0,$forNum=$int;$forNum > 0; $forNum--,$i++)
            {
                if ($i >= 26)
                {
                    break;
                }

                $array[] = $value . $array[$i];
            }

            if ($forNum < 1) break;
            $int = $forNum;
        }

        return $array;
    }
}