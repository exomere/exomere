<?php

namespace App\Exports;

use App\Models\ExStatementsMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommissionTermExport implements FromCollection, WithHeadings
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {

        $statementsQuery = ExStatementsMember::where("code", $this->request->code)->where('site_code', session()->get('site_code', "exomere"))->where('nation', session()->get('member_nation'))->where("type", "term")->where("actual_amount", ">", 0)->orderBy('id', 'desc');
        $statements = $statementsQuery->get();

        return $statements->map(function ($statement) {

            return [
                'id' => $statement->member_seq,
                'memer_id' => $statement->member_id,
                'name' => $statement->member_name,
                'pv' => number_format($statement->pv),
                'total_amount' => number_format($statement->total_amount),
                'recruitment_amount' => number_format($statement->recruitment_amount),
                'settlement_subsidy' => number_format($statement->settlement_subsidy),
                'total_payment' => number_format($statement->total_payment),
                'income_tax' => number_format($statement->income_tax),
                'residence_tax' => number_format($statement->residence_tax),
                'total_deduction' => number_format($statement->total_deduction),
                'actual_amount' => number_format($statement->actual_amount)
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
            __('erp.actual_payment_amount'),
            __('erp.recruitment_congratulatory_money'),
            __('erp.settlement_subsidy_money'),
            __('erp.payment_total'),
            __('erp.income_tax'),
            __('erp.residence_tax'),
            __('erp.total_deduction')
        ];
    }
}
