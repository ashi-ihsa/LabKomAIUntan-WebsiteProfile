<?php
namespace App\Services\Impl;

use App\Models\Tag;
use App\Services\TagService;

class TagServiceImpl implements TagService
{
    function createTag (string $name): void
    {
        Tag::create([
            'nama' => $name
        ]);
    }
    function getTag()
    {
        return Tag::query()
        ->get(['id','nama']);
    }
    function updateTag(string $id, string $name): void
    {
        $tag = Tag::query()
        ->where('id',$id)
        ->firstOrFail();

        $tag->nama = $name;
        $tag->save();
    }
    function deleteTag(string $id): void
    {
        $tag = Tag::query()
        ->where('id',$id)
        ->firstOrFail();

        $tag->delete();
    }
}