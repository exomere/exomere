<?php

namespace App\Http\Controllers\Admin;

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
    public function index(): View
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
        $orgData = [
            ['id' => 1, 'name' => 'CEO', 'title' => 'Chief Executive Officer'],
            ['id' => 2, 'pid' => 1, 'name' => 'CTO', 'title' => 'Chief Technology Officer'],
            ['id' => 3, 'pid' => 1, 'name' => 'CFO', 'title' => 'Chief Financial Officer'],
            ['id' => 4, 'pid' => 2, 'name' => 'Dev Manager', 'title' => 'Development Manager'],
            ['id' => 5, 'pid' => 2, 'name' => 'QA Manager', 'title' => 'QA Manager'],
            ['id' => 6, 'pid' => 3, 'name' => 'Accountant', 'title' => 'Accountant']
        ];

        return response()->json($orgData);
    }
}
