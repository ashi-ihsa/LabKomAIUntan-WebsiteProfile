<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{
    protected TagService $tagService;
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }
    public function index(Request $request): Response
    {
        $TagData = $this->tagService->getTag();
        return response()
        -> view('admin.tag',[
            'title' => 'Tag Management',
            'tagData' => $TagData
        ]);
    }
    public function createTag(Request $request)
    {
        $nama = $request->input('nama');
        if(empty($nama))
        {
            $TagData = $this->tagService->getTag();
            return response()->view('admin.tag',[
                'title' => 'Tag Management',
                'tagData' => $TagData,
                'error' => 'Tag Data is Required'
            ]);
        }
        $this->tagService->createTag($nama);
        return redirect()->action([TagController::class, 'index']);
    }

    public function editTag(Request $request, string $id)
    {
        $nama = $request->input('nama');
        if(empty($nama))
        {
            $TagData = $this->tagService->getTag();
            return response()->view('admin.tag',[
                'title' => 'Tag Management',
                'tagData' => $TagData,
                'error' => 'Tag Data is Required'
            ]);
        }
        $this->tagService->updateTag($id, $nama);
        return redirect()->action([TagController::class, 'index']);
    }
    public function deleteTag(Request $request, string $id): RedirectResponse
    {
        $this->tagService->deleteTag($id);
        return Redirect()->action([TagController::class, 'index']);
    }

}
