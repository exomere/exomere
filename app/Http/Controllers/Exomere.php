<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Exomere extends Controller
{

    private $pageLimit = 10;

    /**
     * query 확인 함수
     * @author oley
     * @param Model $modelQuery
     * @return void
     */
    public function getQuery($modelQuery): void
    {
        DB::enableQueryLog();
        $modelQuery->get();
        dd(DB::getQueryLog());
    }

    /**
     * 리스트 row Number 계산식
     * @author oley
     * @access public
     * @param int $total
     * @param int $page
     * @param int $limitNum
     * @return int
     */
    public function getPageRowNumber(int $total, int $page, int $limitNum): int
    {
        return ((int)$total - (((int)$page - 1)) * (int)$limitNum);
    }

    /**
     * 리스트 페이지 갯수 불러오기
     * @return int
     */
    public function getPageLimit(): int
    {
        return $this->pageLimit;
    }

    /**
     * 리스트 페이지 갯수 셋팅
     * @param int
     * @return void
     */
    public function setPageLimit(int $page)
    {
        $this->pageLimit = $page;
    }

    /**
     * 지난 시간 구하기
     * @param $date
     * @return string
     */
    public function getDateDiff($date)
    {

        $diff = time() - strtotime($date);

        $s = 60; //1분 = 60초
        $h = $s * 60; //1시간 = 60분
        $d = $h * 24; //1일 = 24시간
        $y = $d * 30; //1달 = 30일 기준
        $a = $y * 12; //1년

        if ($diff < $s) {
            $result = $diff . '초전';
        } elseif ($h > $diff && $diff >= $s) {
            $result = round($diff / $s) . '분전';
        } elseif ($d > $diff && $diff >= $h) {
            $result = round($diff / $h) . '시간전';
        } elseif ($y > $diff && $diff >= $d) {
            $result = round($diff / $d) . '일전';
        } elseif ($a > $diff && $diff >= $y) {
            $result = round($diff / $y) . '달전';
        } else {
            $result = round($diff / $a) . '년전';
        }

        return $result;
    }

    public function divideCheck($divisior, $div)
    {

        if ($div != 0 && $divisior != 0) {
            $result = $divisior / $div;
        } else {
            $result = 0;
        }

        return $result;
    }
}
