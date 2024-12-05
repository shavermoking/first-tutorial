<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\BaseController;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);

        $posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        return PostResource::collection($posts);
    }
}
