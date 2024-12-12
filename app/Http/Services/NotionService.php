<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
class NotionService
{
    protected $client;
    protected $databaseId;
    protected $apiUrl;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.notion.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('NOTION_API_SECRET'),
                'Notion-Version' => '2022-06-28',
                'Content-Type' => 'application/json',
            ],
        ]);
        $this->databaseId = env('NOTION_DATABASE_ID');
    }

    public function getDatabase()
    {
        $response = $this->client->post("databases/{$this->databaseId}/query");
        $returnData = $this->makeJsonData($response);
        return $returnData;
    }

    public function addPage(array $data)
    {
        $data = [
            'parent' => ['database_id' => $this->databaseId], // データベースIDを指定
            'properties' => $data["properties"], // データベースプロパティ
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('NOTION_API_SECRET'),
            'Content-Type' => 'application/json',
            'Notion-Version' => '2022-06-28', // 最新のNotionバージョンを指定
        ])->post('https://api.notion.com/v1/pages', $data);

        if ($response->failed()) {
            throw new \Exception('Failed to add page to Notion: ' . $response->body());
        }

        return $response->json();
    }

    private function makeJsonData($response)
    {
        $jsonData = json_decode($response->getBody(), true);
        $responseJson = response()->json($jsonData);
        $content = $responseJson->content();
        $returnData = json_decode( $content, true );
        return $returnData;
    }
}
