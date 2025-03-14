<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ExMember;
use App\Models\ExOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $member_level = request()->session()->get('member_level');

    $member_type = request()->session()->get('member_type');

    $site_code = request()->session()->get('site_code');

    $member_nation = request()->session()->get('member_nation');

    $memberid = request()->session()->get('member_id');

    // if($memberid == 'admin' || $member_level > 90 ){
      // $business_new = ExOrder::where('order_type','new')
    // }
    
    $yy = date("Y", strtotime(date('Y-m-d')));
    $mm = date("m", strtotime(date('Y-m-d')));

    $month_start = date("Y-m-d", strtotime($yy."-".$mm."-01 00:00:00"));
    $month_end = date("Y-m-d", strtotime($yy."-".$mm."-".date("t", strtotime(date('Y-m-d')))." 23:59:59" ));
    $year_start = date("Y")."-01-01 00:00:00";
    $year_end = date("Y")."-12-31 23:59:59";

    if($member_type == 'admin'){
      $fc_member_count = ExMember::where('member_position','총판')->where('site_code',$site_code)->where('nation',$member_nation)->count();
      $fc1_member_count = ExMember::where('member_position','총판1')->where('site_code',$site_code)->where('nation',$member_nation)->count();
      $fc2_member_count = ExMember::where('member_position','우수총판')->where('site_code',$site_code)->where('nation',$member_nation)->count();
      $fc3_member_count = ExMember::where('member_position','최우수총판')->where('site_code',$site_code)->where('nation',$member_nation)->count();

      // $fc_member_month_count = ExMember::where('member_position','총판')->where('site_code',$site_code)->where('nation',$member_nation)->whereBetWeen('created_at',[$month_start,$month_end])->count();
      // $fc1_member_month_count = ExMember::where('member_position','총판1')->where('site_code',$site_code)->where('nation',$member_nation)->whereBetWeen('created_at',[$month_start,$month_end])->count();
      // $fc2_member_month_count = ExMember::where('member_position','우수총판')->where('site_code',$site_code)->where('nation',$member_nation)->whereBetWeen('created_at',[$month_start,$month_end])->count();
      // $fc3_member_month_count = ExMember::where('member_position','최우수총판')->where('site_code',$site_code)->where('nation',$member_nation)->whereBetWeen('created_at',[$month_start,$month_end])->count();

      $fc_order_month = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$month_start,$month_end])->where('ex_members.member_position','총판')->SUM('ex_orders.total_amount');
      $fc_1_order_month = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$month_start,$month_end])->where('ex_members.member_position','총판1')->SUM('ex_orders.total_amount');
      $fc_2_order_month = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$month_start,$month_end])->where('ex_members.member_position','우수총판')->SUM('ex_orders.total_amount');
      $fc_3_order_month = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$month_start,$month_end])->where('ex_members.member_position','최우수총판')->SUM('ex_orders.total_amount');
      
      $fc_order_year = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$year_start,$year_end])->where('ex_members.member_position','총판')->SUM('ex_orders.total_amount');
      $fc_1_order_year = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$year_start,$year_end])->where('ex_members.member_position','총판1')->SUM('ex_orders.total_amount');
      $fc_2_order_year = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$year_start,$year_end])->where('ex_members.member_position','우수총판')->SUM('ex_orders.total_amount');
      $fc_3_order_year = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$year_start,$year_end])->where('ex_members.member_position','최우수총판')->SUM('ex_orders.total_amount');

      $position_chart = [
          "business" => [
              ["name" => "FC I", "total_members" => (1*$fc1_member_count)],
              ["name" => "FC", "total_members" => (1*$fc_member_count)],
              ["name" => "우수FC", "total_members" => (1*$fc2_member_count)],
              ["name" => "최우수FC", "total_members" => (1*$fc3_member_count)]
          ],
          "beauty" => [
            ["name" => "FC I", "month" => (1*$fc_1_order_month), "year" => (1*$fc_1_order_year)],
            ["name" => "FC", "month" => (1*$fc_order_month), "year" => (1*$fc_order_year)],
            ["name" => "우수FC", "month" => (1*$fc_2_order_month), "year" => (1*$fc_2_order_year)],
            ["name" => "최우수FC", "month" => (1*$fc_3_order_month), "year" => (1*$fc_3_order_year)]
          ],
          "category" => ["FC I", "FC", "우수FC", "최우수FC",],
      ];

    }else if($member_type == 'director'){
      $fc_member_count = ExMember::where('member_position','뷰티플래너')->where('site_code',$site_code)->where('nation',$member_nation)->count();
      $fc1_member_count = ExMember::where('member_position','대리점')->where('site_code',$site_code)->where('nation',$member_nation)->count();
    
      $fc_order_month = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$month_start,$month_end])->where('ex_members.member_position','뷰티플래너')->SUM('ex_orders.total_amount');
      $fc_1_order_month = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$month_start,$month_end])->where('ex_members.member_position','대리점')->SUM('ex_orders.total_amount');
      
      $fc_order_year = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$year_start,$year_end])->where('ex_members.member_position','뷰티플래너')->SUM('ex_orders.total_amount');
      $fc_1_order_year = DB::table('ex_orders')->join('ex_members', 'ex_members.id', '=', 'ex_orders.member_seq')->where('ex_orders.site_code',$site_code)->where('ex_orders.nation',$member_nation)->whereBetWeen('ex_orders.order_date',[$year_start,$year_end])->where('ex_members.member_position','대리점')->SUM('ex_orders.total_amount');
    
      $position_chart = [
        "business" => [
            ["name" => "대리점", "total_members" => (1*$fc1_member_count)],
            ["name" => "뷰티플래너", "total_members" => (1*$fc_member_count)],
        ],
        "beauty" => [
          ["name" => "대리점", "month" => (1*$fc_1_order_month), "year" => (1*$fc_1_order_year)],
          ["name" => "뷰티플래너", "month" => (1*$fc_order_month), "year" => (1*$fc_order_year)],
        ],
        "category" => ["대리점", "뷰티플래너"],
      ];
    }



    $new_order_month = ExOrder::where('order_type','new')->where('site_code',$site_code)->where('nation',$member_nation)->whereBetWeen('order_date',[$month_start,$month_end])->SUM('total_amount');
    $repurchase_order_month = ExOrder::where('order_type','repurchase')->where('site_code',$site_code)->where('nation',$member_nation)->whereBetWeen('order_date',[$month_start,$month_end])->SUM('total_amount');

    $new_order_year = ExOrder::where('order_type','new')->where('site_code',$site_code)->where('nation',$member_nation)->whereBetWeen('order_date',[$year_start,$year_end])->SUM('total_amount');
    $repurchase_order_year = ExOrder::where('order_type','repurchase')->where('site_code',$site_code)->where('nation',$member_nation)->whereBetWeen('order_date',[$year_start,$year_end])->SUM('total_amount');

    // 예제 데이터
    $chart_data = [
      //회원
      "fc_data" => $position_chart,
      //실적
      "perform" => [
          "business" => [
              "new" => 1*$new_order_month,
              "repurchase" => 1*$repurchase_order_month
          ],
          "beauty" => [
              "new" => 1*$new_order_year,
              "repurchase" => 1*$repurchase_order_year
          ]
      ]
    ];

    $json_chart_data = json_encode($chart_data, JSON_UNESCAPED_UNICODE);

    $with_data = [
      'new_order_month' => $new_order_month,
      'repurchase_order_month' => $repurchase_order_month,
      'new_order_year' => $new_order_year,
      'repurchase_order_year' => $repurchase_order_year,
      'json_chart_data' => $json_chart_data,
      'chart_data' => $chart_data,
    ];
    return view('content.dashboard.dashboards-analytics')->with($with_data);
  }
}
