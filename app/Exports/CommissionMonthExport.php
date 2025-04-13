<?php

namespace App\Exports;

use App\Models\ExStatementsMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommissionMonthExport implements FromCollection, WithHeadings
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {

        $statementsQuery = ExStatementsMember::where("code", $this->request->code)->where('site_code',session()->get('site_code', "exomere"))->where('nation', session()->get('member_nation'))->where("type", "month")->where("actual_amount", ">", 0)->orderBy('id', 'desc');
        $statements = $statementsQuery->get();

        return $statements->map(function ($statement) {

            return [
                'id' => $statement->member_seq,
                'memer_id' => $statement->member_id,
                'name' => $statement->member_name,
                'pv' => number_format($statement->pv),
                'total_amount' => number_format($statement->total_amount),
                'recruitment_amount' =>number_format($statement->recruitment_amount),
                'promote_price' =>number_format($statement->promote_price),
                'center_amount' =>number_format($statement->center_amount),
                'incentives' =>number_format($statement->incentives),
                'contribution_amount' =>number_format($statement->contribution_amount),
                'contribution_amount2' =>number_format($statement->contribution_amount2),
                'total_payment' => number_format($statement->total_payment) ,
                'payment_points' => number_format($statement->payment_points) ,
                'income_tax' => number_format($statement->income_tax) ,
                'residence_tax' => number_format($statement->residence_tax) ,
                'total_deduction' => number_format($statement->total_deduction) ,
                'actual_amount' => number_format($statement->actual_amount) ,
            ];
        });
    }

    public function headings(): array
    {

        return [
            __('erp.member_number'),
            __('erp.id'),
            __('erp.member_name'),
            'PV',
            __('erp.accumulated_sales'),
            __('erp.allowment_deduction'),
            __('erp.actual_payment_amount'),
            __('erp.direct_recruitment_fee'),
            __('erp.incentive_money'),
            __('erp.local_office_support_fund'),
            __('erp.incentive'),
            __('erp.excellent_exclusive_distributor_contribution'),
            __('erp.best_exclusive_distributor_contribution'),
            __('erp.payment_total'),
            __('erp.points_total_payment'),
            __('erp.income_tax'),
            __('erp.residence_tax'),
            __('erp.total_deduction')
        ];
    }
}
