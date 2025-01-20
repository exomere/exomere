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
//        $user = ExMember::where('id', 1509)->first();
        $orgData = [];

        // Add top member (if exists)
        $topMember = ExMember::where('id', $user->recommend_seq)->first();
        if ($topMember) {
            $orgData[] = [
                'v' => (string) $topMember->id,
                'f' => $topMember->name . '<div style="color:red; font-style:italic">' . $topMember->member_position . '</div>',
                'manager' => '',
                'tooltip' => 'Top Member'
            ];
        }

        // Add current user
        $orgData[] = [
            'v' => (string) $user->id,
            'f' => $user->name . '<div style="color:red; font-style:italic">' . $user->member_position . '</div>',
            'manager' => $topMember ? (string) $topMember->id : '',
            'tooltip' => 'Current User'
        ];

        // Add lower members
        $lowerMembers = ExMember::where('recommend_seq', $user->id)->get();
        foreach ($lowerMembers as $member) {
            $orgData[] = [
                'v' => (string) $member->id,
                'f' => $member->name . '<div style="color:red; font-style:italic">' . $member->member_position . '</div>',
                'manager' => (string) $user->id,
                'tooltip' => 'Lower Member'
            ];
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
        dd($topMember);
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
