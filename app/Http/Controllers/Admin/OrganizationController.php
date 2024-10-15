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
        return view('pages.organization.list');
    }

    /**
     * Get the organization data for the org chart.
     *
     * @return JsonResponse
     */
    public function getOrgData()
    {
        //$user = auth()->user();
        $user = ExMember::where('id', 1511)->first();;

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
