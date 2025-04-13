<?php

namespace App\Exports;

use App\Models\ExMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $membersQuery = ExMember::where("site_code", session()->get('site_code', "exomere"))->where('nation', session()->get('member_nation', 'KR'))
            ->orderBy('id', 'desc');

        if (session()->get('member_level') != 99) {
            $membersQuery->whereIn("member_position", ["최우수총판", "우수총판", "총판1", "총판", "회원"]);
        }

        if ($this->request->filled('search_text') ) {
            $search_text = $this->request->get('search_text');
            $membersQuery->where(function ($q) use ($search_text) {
                $q->where('name', 'like', '%' . $search_text . '%')
                    ->orWhere('member_id', 'like', '%' . $search_text . '%')
                    ->orWhere('tel', 'like', '%' . $search_text . '%')
                    ->orWhere('phone', 'like', '%' . $search_text . '%');
            });
        }

        $members = $membersQuery->get();

        return $members->map(function ($member) {

            $member_position =[
                "최우수총판" => "최우수 FC",
                "우수총판" => "우수 FC",
                "총판1" => "FC1",
                "총판" => "FC",
                "회원" => "회원",
                "대리점" => "대리점",
            ];

            return [
                'id' => $member->id,
                'memer_id' => $member->member_id,
                'name' => $member->name,
                'email' => $member->email,
                'member_position' => $member_position[$member->member_position],
                'centerName' => $member->getCenterName(),
                'created_at' => date("Y-m-d",strtotime($member->created_at)),
                'phone' => $member->phone,
                'zip_code' => $member->zip_code,
                'address' => $member->address,
                'address_detail' => $member->address_detail,
                'AmountSum' => number_format($member->getMemberOrderAmountSum()),
                'recommend_seq' => $member->recommend_seq,
                'recommend_id' => $member->recommend_id,
                'recommend_name' => $member->recommend_name,
                'remark' => $member->remark,
            
            ];
        });
    } 
    public function headings(): array
    {
        return [
            //            'NO',
            __('erp.member_number'),
            __('erp.id'),
            __('erp.name'),
            __('erp.email'),
            __('erp.member_classification'),
            // __('erp.sale_mall'),
            __('erp.local_branch'),
            __('erp.subscription_date'),
            __('erp.contact_information'),
            __('erp.zip_code'),
            __('erp.basic_address'),
            __('erp.detailed_address'),
            __('erp.sales_total'),
            __('erp.recruiter') . " " . __('erp.member_number'),
            __('erp.recruiter') . " " . __('erp.id'),
            __('erp.recruiter') . " " . __('erp.name'),
            __('erp.remarks'),
        ];
    }
}
