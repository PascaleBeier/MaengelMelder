<?php

namespace App\Http\Controllers;

use App\ User;
use App\ Category;
use Illuminate\Http\Request;

class CategoryUserController extends Controller
{
    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Category $category)
    {
        return view('backend.categoryuser.index', compact('category'));
    }

    /**
     * @param Category $category
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Category $category, User $user)
    {
        $categoryUsers = $category->users()->get();
        $users = $user->whereNotIn('id', $categoryUsers->pluck('id'))->get();

        return view('backend.categoryuser.create', compact('users', 'category'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Category $category)
    {
        $users = array_flatten($request->user_id);

        $category->users()->attach($users);

        return redirect()->route('categories.index');
    }
}
