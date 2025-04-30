<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    protected AuthorService $authorService;
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request): Response
    {
        $authorData = $this->authorService->getAuthor();
        return response()
        -> view("admin.author",[
            "title" => "Author Management",
            "authorData" => $authorData
        ]);
    }

    public function createAuthor(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        if(empty($name) || empty($email) || empty($password))
        {
            $authorData = $this->authorService->getAuthor();
            return response()->view('admin.author',[
                "title" => "Author Management",
                "authorData" => $authorData,
                'error' => "All data are Required"
            ]);
        }
        $this->authorService->createAuthor($email, $name, $password);
        return redirect()->action([AuthorController::class, 'index']);
    }

    public function editAuthorById(Request $request, string $id)
    {

        $author = $this->authorService->findById($id);
        return view('admin.author_edit', [
            'author' => $author,
            'title' => 'Edit Author'
        ]);
    }

    public function updateAuthor(Request $request, string $id)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        if(empty($name) || empty($email))
        {
            $authorData = $this->authorService->getAuthor();
            return response()->view('admin.editAuthor',[
                "title" => "Edit Author",
                "authorData" => $authorData,
                'error' => "All data are Required"
            ]);
        }

        $this->authorService->updateAuthor($id, $email, $name, $password);
        return redirect()->action([AuthorController::class, 'index']);
    }

    public function deleteAuthor(Request $request, string $id): RedirectResponse
    {
        $this->authorService->deleteAuthor($id);
        return redirect()->action([AuthorController::class, 'index']);
    }
}
