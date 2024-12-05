<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Post;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class ImportJsonPlaceholderCommand extends Command
{
    protected $signature = 'import:jsonplaceholder';

    protected $description = 'Request fake api';


    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $importClass = new ImportDataClient();

        $response = $importClass->client->request('GET', '/posts');
        $data = json_decode($response->getBody()->getContents());

        foreach ($data as $datum){
            Post::query()->firstOrCreate([
                'title' => $datum->title
            ],
            [
                'title' => $datum->title,
                'content' => $datum->body,
                'category_id' => 1
            ]);
        }

        dd('finish');
    }
}
