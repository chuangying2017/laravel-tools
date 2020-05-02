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
}