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
     * 计算excel表格 行对应的key
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

    /**
     * 加密算法
     * @param $string
     * @param $operation
     * @param string $key
     * @return false|string|string[]
     */
    public function encrypt($string, $operation, $key = '') {
        $key = md5($key);
        $key_length = strlen($key);
        $string = $operation == 'D' ? base64_decode($string) : substr(md5($string . $key), 0, 8) . $string;
        $string_length = strlen($string);
        $rndkey = $box = array();
        $result = '';
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($key[$i % $key_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result.=chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation == 'D') {
            if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
                return substr($result, 8);
            } else {
                return'';
            }
        } else {
            return str_replace('=', '', base64_encode($result));
        }
    }
}