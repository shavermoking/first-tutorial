<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class Service extends Controller
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);


            $tagIds = $this->getTagIds($tags);
            $data['category_id'] = $this->getCategoryId($category);

            $post = Post::query()->create($data);
            $post->tags()->attach($tagIds);

            DB::commit();
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception->getMessage();
        }
        return $post;
    }

    public function update($data, Post $post)
    {
        try {
            DB::beginTransaction();

            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $tagIds = $this->getTagIdsWithUpdate($tags);
            $data['category_id'] = $this->getCategoryIdWithUpdate($category);

            $post->update($data);
            $post->tags()->sync($tagIds);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }
        return $post->fresh();
    }

    private function getTagIds(array $tags): array
    {
        $tagIds = [];
        foreach ($tags as $tag){
            $tag = !isset($tag['id']) ? Tag::query()->create($tag) : Tag::query()->find($tag['id']);
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }

    private function getCategoryId($item): int
    {
        $category = !isset($item['id']) ? Category::query()->create($item) : Category::query()->find($item['id']);

        return $category->id;
    }

    private function getCategoryIdWithUpdate($item): int
    {
        if (!isset($item['id'])) {
            $category = Category::query()->create($item);
        } else {
            $category = Category::query()->find($item['id']);
            $category->update($item);
            $category = $category->fresh();
        }

        return $category->id;

    }

    private function getTagIdsWithUpdate(array $tags): array
    {
        $tagIds = [];
        foreach ($tags as $tag){
            if(!isset($tag['id'])) {
                $tag =Tag::create($tag);
            } else {
                $currentTag = Tag::find($tag['id']);
                $currentTag->update($tag);
                $tag = $currentTag->fresh();
            }
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }
}
