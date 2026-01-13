<?php

namespace App\Exports;

use App\Models\ExOrder;
use App\Models\ExItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // 추가

class OrderDetailExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $orderId    = $this->request->get('order_id');
        $order_data = ExOrder::findOrFail($orderId);
        $item_info  = json_decode($order_data->item_info);

        $itemArray = [];
        foreach ($item_info as $item) {
            $item_data = ExItem::find($item->pd_seq);
            $itemArray[$item->pd_seq]['seq']             = $item->pd_seq;
            $itemArray[$item->pd_seq]['qty']             = $item->pd_qty;
            $itemArray[$item->pd_seq]['pd_name']         = $item->pd_name;
            $itemArray[$item->pd_seq]['capacity']        = $item_data->capacity;
            $itemArray[$item->pd_seq]['exclusive_price'] = $item_data->exclusive_price;
            $itemArray[$item->pd_seq]['price']           = $item_data->price;
        }

        $rows = [];
        foreach ($itemArray as $pdSeq => $item) {
            $rows[] = [
                '',        // 오더코드
                '',        // 릴리즈코드
                '',        // 택배사
                '',        // 송장번호
                '(주)엑소미어',                          // 회사명
                'YNR-' . $item['seq'],                   // 고유코드
                $item['pd_name'] ?? '',                  // 판매상품명
                $item['qty'] ?? '',                      // 수량
                '택배',                                   // 배송방식
                $order_data->member_name ?? '',          // 주문자 이름
                $order_data->delivery_name ?? '',        // 받는분 이름
                $order_data->delivery_phone ?? '',       // 전화번호1
                '',                                      // 전화번호2
                $order_data->zipcode ?? '',              // 우편번호
                trim(($order_data->address ?? '') . ' ' . ($order_data->address_detail ?? '')), // 주소
                '',                                      // 배송메시지
                $orderId,                                      // 주문번호
                '',
                '',
                '',
                '',
                '',                      // 관리메모1~5
                '',
                '',
                '',                              // 상품별 메모1~3
                '',
                '',
                '',
                '',
                '',
                '',                  // 정보1~6
                '',                                      // 발주 타입
                '',                                      // 공급사명
                date('Y-m-d'),                           // 출고희망일
                date('Y-m-d H:i:s'),                     // 발주일자
                '30568861',                              // 신용번호(계약코드)
                '안성',                                   // 택배구분
            ];
        }

        return collect($rows);
    }

    public function headings(): array
    {
        return [
            "오더코드",
            "릴리즈코드",
            "택배사",
            "송장번호",
            "회사명",
            "고유코드",
            "판매상품명",
            "수량",
            "배송방식",
            "주문자 이름",
            "받는분 이름",
            "전화번호1",
            "전화번호2",
            "우편번호",
            "주소",
            "배송메시지",
            "주문번호",
            "관리메모1",
            "관리메모2",
            "관리메모3",
            "관리메모4",
            "관리메모5",
            "상품별 메모1",
            "상품별 메모2",
            "상품별 메모3",
            "정보1",
            "정보2",
            "정보3",
            "정보4",
            "정보5",
            "정보6",
            "발주 타입",
            "공급사명",
            "출고희망일",
            "발주일자",
            "신용번호(계약코드)",
            "택배구분"
        ];
    }
}
