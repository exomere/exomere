<?php

namespace App\Exports;

use App\Models\ExOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    const ORDER_KIND = [
        'new' => "신규주문",
        'repurchase' => "재구매주문",
        'distribute_new' => "분양몰신규",
        'distribute_repurchase' => "분양몰재구문",
    ];

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $ordersQuery = ExOrder::where("site_code", session()->get('site_code', "exomere"))
            ->orderBy('order_date', 'desc');

        if ($this->request->filled('approval_status')) {
            $ordersQuery->where('is_approval', $this->request->get('approval_status'));
        }

        if ($this->request->filled('order_type')) {
            $ordersQuery->where('order_type', $this->request->get('order_type'));
        }

        if ($this->request->filled('start_date')) {
            $ordersQuery->where('order_date', '>=', $this->request->get('start_date'));
        }

        if ($this->request->filled('end_date')) {
            $ordersQuery->where('order_date', '<=', $this->request->get('end_date'));
        }

        if ($this->request->filled('search_text') && $this->request->filled('search_field')) {
            $searchField = $this->request->get('search_field');
            $searchText = $this->request->get('search_text');
            $ordersQuery->where($searchField, 'LIKE', "%{$searchText}%");
        }

        $orders = $ordersQuery->get();

        return $orders->map(function ($order) {
            $isApprovalText = "-";
            if ($order->is_approval == 'Y') {
                $isApprovalText = __('erp.approval');
            } else if (($order->is_approval == 'C')) {
                $isApprovalText = __('erp.cancel');
            }
            $product_receipt = [
                'delivery' => '택배수령',
                'scene' => '현장수령',
            ];
            return [
                'is_approval' => $isApprovalText,
                'order_kind' => self::ORDER_KIND[$order->order_type] ?? "",
                'total_amount' => number_format($order->total_amount),
                'total_pv' => number_format($order->total_pv),
                'delivery_name' => $order->delivery_name ?? $order->member_name,
                'order_date' => date("Y-m-d",strtotime($order->order_date)),
                'id' => $order->id,
                'member_id' => $order->member_id,
                'member_name' => $order->member_name,
                'product' => "상품",
                'product_receipt' =>  $product_receipt[$order->receipt_method],
                'zip_code' => $order->zipcode,
                'address' => $order->address,
                'address_detail' => $order->address_detail,
                'centerName' => $order->getCenterName(),
                'recommend_id' => $order->findByMemberRecommend()->get()->value('recommend_id'),
                'recommend_name' => $order->findByMemberRecommend()->get()->value('recommend_name'),
                'remark' => $order->remark,
                'reg_name' => $order->reg_name ?? 'oley',
            ];
        });

    }

    public function headings(): array
    {
        return [
//            'NO',
            __('erp.is_approval'),
            __('erp.order_classification'),
            __('erp.order_amount'),
            'PV1',
            __('erp.orderer'),
            __('erp.order_date'),
            __('erp.order_number'),
            __('erp.id'),
            __('erp.name'),
            __('erp.local_branch'),
            __('erp.product'),
            __('erp.product_receipt'),
            __('erp.zip_code'),
            __('erp.basic_address'),
            __('erp.detailed_address'),
            __('erp.recruiter').'-'.__('erp.id'),
            __('erp.recruiter').'-'.__('erp.name'),
            __('erp.remarks'),
            __('erp.registrant')
        ];
    }
}
