<?php

namespace App\Models;

use App\Models\ExomereModel;
use App\Models\ExOrder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExStatementsMember extends ExomereModel
{

    protected $table = 'ex_statements_member';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [
        "type",
        "code",
        "member_seq",
        "member_id",
        "member_name",
        "pre_position",
        "position",
        "pv",
        "total_amount",
        "recruitment_amount",
        "promote_price",
        "promote_score",
        "center_amount",
        "education_amount",
        "settlement_subsidy",
        "standing_contribution",
        "contributions_sales",
        "wages",
        "incentives",
        "bonus",
        "contribution_amount",
        "contribution_amount2",
        "payment_points",
        "total_payment",
        "income_tax",
        "residence_tax",
        "total_deduction",
        "actual_amount",
        "is_confirmation",
        "created_at",
        "updated_at",
        "site_code",
        "nation",
    ];
  
    public function getTotalAmount($seq,$s_date,$e_date)
    {
        return ExOrder::where('member_seq',$seq)->whereBetween('order_date',[$s_date,$e_date])->SUM('total_amount');
    }

    public function getTotalPV($seq,$s_date,$e_date)
    {
        return ExOrder::where('member_seq',$seq)->whereBetween('order_date',[$s_date,$e_date])->SUM('total_pv');
    }
}
