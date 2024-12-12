<?php

namespace App\Http\Controllers;

use App\Http\Services\NotionService;
use Illuminate\Http\Request;

class NotionApiController extends Controller
{
    protected $notionService;

    public function __construct(NotionService $notionService)
    {
        $this->notionService = $notionService;
    }

    public function fetchDatabase()
    {
        $notionData = $this->notionService->getDatabase();
        return view("notion",["notionData" =>$notionData["results"]]);
    }

    public function addPage(Request $request)
    {
        $data = [
            'parent' => ['database_id' => env('NOTION_DATABASE_ID')],
            'properties' => $request->input('properties'),
        ];
        return response()->json($this->notionService->addPage($data));
    }
}
