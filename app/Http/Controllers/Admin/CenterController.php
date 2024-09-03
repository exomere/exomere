<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;
use App\Models\ExCenter;
use Illuminate\Support\Facades\Storage;
class CenterController extends Exomere
{
    public function centerList(Request $request)
    {

        $centers = new ExCenter;
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
            $centers->where('name','LIKE',"%{$request->get('search_text')}%");
        }
      
        $centers->limit($limitPage)->orderBy('id', 'desc');
        
        $data = [
          "search_text" => $search_text ?? '',
          "centers" =>  $centers ?? [], 
          "row_num" => $this->getPageRowNumber($centers->count(), $page, $limitPage) ?? null,
          "paga_nation" => $this->pagaNation($centers, $limitPage),
        ];

        return view('pages.center.list')->with($data);
    }
    
    
    public function centerRegister(Request $request)
    {
  
      if (isset($request->seq)) {
        $center = ExCenter::find($request->seq);
        $director_info = $center->director_id." | ". $center->director_name;
        $recommended_info = $center->recommended_id." | ". $center->recommended_name;
      }
      
      $data = [
        "center_seq" => $request->seq ?? null,
        "center" => $center ?? [],
        "director_info" => $director_info ?? '',
        "recommended_info" => $recommended_info ?? '',
      ];

      return view('pages.center.register')->with($data);
    }

    public function centerSave(Request $request)
    {

      $center_seq = $request->center_seq ?? null;

      // dd($request->input());
      $input_data = [
        "name" => $request->name,
        "director_seq" => $request->director_seq,
        "director_id" => explode(" | ",$request->director_info)[0],
        "director_name" => explode(" | ",$request->director_info)[1],
        "recommended_seq" => $request->recommended_seq,
        "recommended_id" => explode(" | ",$request->recommended_info)[0],
        "recommended_name" => explode(" | ",$request->recommended_info)[1],
        "phone" => $request->phone,
        "fax" => $request->fax,
        "zipcode" => $request->zipcode,
        "address" => $request->address,
        "address_detail" => $request->address_detail,
        "remark" => $request->remark,
        "is_active" => $request->is_active,
      ];

      if($request->hasFile('thum_img')){
        $fileName = time().'_'.$request->file('thum_img')->getClientOriginalName();
        $input_data['thum_img'] = $request->file('thum_img')->storeAs('public/data', $fileName);
        $input_data['thum_img'] = $fileName;
        
      }
      if($request->hasFile('img')){
        $fileName = time().'_'.$request->file('img')->getClientOriginalName();
        $request->file('img')->storeAs('public/data', $fileName);
        $input_data['img'] = $fileName;
      }

      ExCenter::UpdateOrCreate(
        [
          'id' => $center_seq,
        ],
          $input_data
      );

      return redirect()->route('basic-layouts-center-list');
    }

    public function centerDel(Request $request)
    {
        ExCenter::find($request->seq)->delete();
      return redirect()->route('basic-layouts-center-list');
    }

    

    
}
