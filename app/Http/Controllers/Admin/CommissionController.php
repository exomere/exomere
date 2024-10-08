<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use App\Models\ExOrder;
use App\Models\ExMember;
use App\Models\ExCenter;
use App\Models\ExStatementsMember;
use App\Models\ExStatements;

use Illuminate\View\View;

class CommissionController extends Exomere
{
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function termClosing (Request $request)
    {
        $s_date = $request->start_date ?? date('Y-m-d');
        $e_date = $request->end_date ?? date('Y-m-d');

        // $statements = ExStatementsMember::where("type","term")->orderBy('id', 'desc')->whereBetWeen('created_at',[$s_date,$e_date]);
        $statements = ExStatementsMember::where("type","term")->where("member_seq",$request->session()->get('member_seq'))->orderBy('id', 'desc');

        $output_data = [];
        $total_count = $statements->count();
        foreach($statements->get() as $statement){
            $output_data[$statement->code]['no'] = $total_count--;
            $output_data[$statement->code]['code'] = $statement->code;
            $output_data[$statement->code]['recruitment_amount'] = ($output_data[$statement->code]['recruitment_amount'] ?? 0) + $statement->recruitment_amount;
            $output_data[$statement->code]['settlement_subsidy'] = ($output_data[$statement->code]['settlement_subsidy'] ?? 0) + $statement->settlement_subsidy;
            $output_data[$statement->code]['income_tax'] = ($output_data[$statement->code]['income_tax'] ?? 0) + $statement->income_tax;
            $output_data[$statement->code]['residence_tax'] = ($output_data[$statement->code]['residence_tax'] ?? 0) + $statement->residence_tax;
            $output_data[$statement->code]['total_deduction'] = ($output_data[$statement->code]['total_deduction'] ?? 0) + $statement->total_deduction;
            $output_data[$statement->code]['actual_amount'] = ($output_data[$statement->code]['actual_amount'] ?? 0) + $statement->actual_amount;
        }
        
        $datas = [
            "output_data" => $output_data ?? [],
        ];

        return view('pages.commission.termClosing')->with($datas);
    }

    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function monthlyClosing (Request $request)
    {
        $s_date = $request->start_date ?? date('Y-m-d');
        $e_date = $request->end_date ?? date('Y-m-d');

        // $statements = ExStatementsMember::where("type","month")->orderBy('id', 'desc')->whereBetWeen('created_at',[$s_date,$e_date]);
        $statements = ExStatementsMember::where("type","month")->where("member_seq",$request->session()->get('member_seq'))->orderBy('id', 'desc');
        
        $output_data = [];
        $total_count = $statements->count();
        foreach($statements->get() as $statement){
            $output_data[$statement->code]['no'] = $total_count--;
            $output_data[$statement->code]['code'] = $statement->code;

            $output_data[$statement->code]['recruitment_amount'] = ($output_data[$statement->code]['recruitment_amount'] ?? 0) + $statement->recruitment_amount;
            $output_data[$statement->code]['promote_prive'] = ($output_data[$statement->code]['promote_prive'] ?? 0) + $statement->promote_prive;
            $output_data[$statement->code]['center_amount'] = ($output_data[$statement->code]['center_amount'] ?? 0) + $statement->center_amount;
            $output_data[$statement->code]['education_amount'] = ($output_data[$statement->code]['education_amount'] ?? 0) + $statement->education_amount;
            $output_data[$statement->code]['settlement_subsidy'] = ($output_data[$statement->code]['settlement_subsidy'] ?? 0) + $statement->settlement_subsidy;
            $output_data[$statement->code]['wages'] = ($output_data[$statement->code]['wages'] ?? 0) + $statement->wages;
            $output_data[$statement->code]['incentives'] = ($output_data[$statement->code]['incentives'] ?? 0) + $statement->incentives;
            $output_data[$statement->code]['bonus'] = ($output_data[$statement->code]['bonus'] ?? 0) + $statement->bonus;
            $output_data[$statement->code]['contribution_amount'] = ($output_data[$statement->code]['contribution_amount'] ?? 0) + $statement->contribution_amount;
            $output_data[$statement->code]['contribution_amount2'] = ($output_data[$statement->code]['contribution_amount2'] ?? 0) + $statement->contribution_amount2;

            $output_data[$statement->code]['income_tax'] = ($output_data[$statement->code]['income_tax'] ?? 0) + $statement->income_tax;
            $output_data[$statement->code]['residence_tax'] = ($output_data[$statement->code]['residence_tax'] ?? 0) + $statement->residence_tax;
            $output_data[$statement->code]['total_deduction'] = ($output_data[$statement->code]['total_deduction'] ?? 0) + $statement->total_deduction;
            $output_data[$statement->code]['actual_amount'] = ($output_data[$statement->code]['actual_amount'] ?? 0) + $statement->actual_amount;
        }
        
        $datas = [
            "output_data" => $output_data ?? [],
        ];

        return view('pages.commission.monthlyClosing')->with($datas);
    }
}
