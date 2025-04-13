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

        // admin: 모든 하위 멤버 재귀적으로 가져오기
        $getLowerMembersAll = function($parentId, $managerId) use (&$orgData, &$getLowerMembersAll) {
            $members = ExMember::where('recommend_seq', $parentId)->get();
            foreach ($members as $member) {
                $orgData[] = [
                    'v' => (string)$member->id,
                    'f' => $member->name . '<div style="color:red; font-style:italic">' . $member->member_position . '</div>',
                    'manager' => (string)$managerId,
                    'tooltip' => 'Lower Member'
                ];
                // 재귀 호출
                $getLowerMembersAll($member->id, $member->id);
            }
        };

        // 일반 유저: 하위 멤버 2단계만 가져오기
        $getLowerMembersTwoLevels = function($parentId, $managerId) use (&$orgData) {
            // 1단계 하위 멤버
            $firstLevelMembers = ExMember::where('recommend_seq', $parentId)->get();
            foreach ($firstLevelMembers as $member) {
                $orgData[] = [
                    'v' => (string)$member->id,
                    'f' => $member->name . '<div style="color:red; font-style:italic">' . $member->member_position . '</div>',
                    'manager' => (string)$managerId,
                    'tooltip' => 'Lower Member'
                ];

                // 2단계 하위 멤버
                $secondLevelMembers = ExMember::where('recommend_seq', $member->id)->get();
                foreach ($secondLevelMembers as $subMember) {
                    $orgData[] = [
                        'v' => (string)$subMember->id,
                        'f' => $subMember->name . '<div style="color:red; font-style:italic">' . $subMember->member_position . '</div>',
                        'manager' => (string)$member->id,
                        'tooltip' => 'Lower Member'
                    ];
                }
            }
        };

        // 본인 추가
        $orgData[] = [
            'v' => (string)$user->id,
            'f' => $user->name . '<div style="color:red; font-style:italic">' . $user->member_position . '</div>',
            'manager' => '',
            'tooltip' => (trim($user->member_id) == "admin") ? 'Admin' : 'Current User'
        ];

        // admin과 일반 유저 구분해서 호출
        if (trim($user->member_id) == "admin") {
            $getLowerMembersAll($user->id, $user->id);
        } else {
            $getLowerMembersTwoLevels($user->id, $user->id);
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
