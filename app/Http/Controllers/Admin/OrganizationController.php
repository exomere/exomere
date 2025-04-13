<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;
use Illuminate\View\View;

class OrganizationController extends Exomere
{
    /**
     * Display the organization chart page.
     *
     * @return View
     */
    public function list(): View
    {
        $user = auth()->user();
//        $user = ExMember::where('id', 1973)->first();
        $orgData = [];

        // 재귀적으로 하위 멤버들을 가져오는 함수
        $getLowerMembers = function($parentId, $managerId) use (&$orgData, &$getLowerMembers) {
            $members = ExMember::where('recommend_seq', $parentId)->get();
            foreach ($members as $member) {
                $orgData[] = [
                    'v' => (string)$member->id,
                    'f' => $member->name . '<div style="color:red; font-style:italic">' . $member->member_position . '</div>',
                    'manager' => (string)$managerId,
                    'tooltip' => 'Lower Member'
                ];
                // 재귀 호출
                $getLowerMembers($member->id, $member->id);
            }
        };

        if (trim($user->member_id) == "admin") {
            // Add admin user as top node
            $orgData[] = [
                'v' => (string)$user->id,
                'f' => $user->name . '<div style="color:red; font-style:italic">' . $user->member_position . '</div>',
                'manager' => '',
                'tooltip' => 'Admin'
            ];

            // 하위 멤버 재귀적으로 추가
            $getLowerMembers($user->id, $user->id);
        } else {
            // 상위 멤버 추가
            $topMember = ExMember::where('id', $user->recommend_seq)->first();
            if ($topMember) {
                $orgData[] = [
                    'v' => (string)$topMember->id,
                    'f' => $topMember->name . '<div style="color:red; font-style:italic">' . $topMember->member_position . '</div>',
                    'manager' => '',
                    'tooltip' => 'Top Member'
                ];
            }

            // 현재 유저 추가
            $orgData[] = [
                'v' => (string)$user->id,
                'f' => $user->name . '<div style="color:red; font-style:italic">' . $user->member_position . '</div>',
                'manager' => $topMember ? (string)$topMember->id : '',
                'tooltip' => 'Current User'
            ];

            // 하위 멤버 재귀적으로 추가
            $getLowerMembers($user->id, $user->id);
        }


        return view('pages.organization.list', ['orgData' => json_encode($orgData)]);
    }

    /**
     * Get the organization data for the org chart.
     *
     * @return JsonResponse
     */
    public function getOrgData()
    {
        $user = auth()->user();
        //$user = ExMember::where('id', 1511)->first();

        $orgData = [];
        $topMember = ExMember::where('id', $user->recommend_seq)->first();
        
        if ($topMember) {
            $orgData[] = ['id' => $topMember->id, 'name' => $topMember->name, 'title' => $topMember->member_position];
        }

        $orgData[] = ['id' => $user->id, 'pid' => $user->recommend_seq, 'name' => $user->name, 'title' => $user->member_position];


        $lowerMembers = ExMember::where('recommend_seq', $user->id)->get();
        if ($lowerMembers) {
            foreach ($lowerMembers as $member) {
                $orgData[] = ['id' => $member->id, 'pid' => $member->recommend_seq, 'name' => $member->name, 'title' => $member->member_position];
            }
        }

        return response()->json($orgData);
    }
}
