<?php

namespace App\Http\Controllers;

use App\ User;
use App\ Category;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        return view('backend.usercategory.index', compact('user'));
    }

    /**
     * @param Category $category
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Category $category, User $user)
    {
        $userCategories = $user->categories()->get();
        $users = $user->whereNotIn('id', $userCategories->pluck('id'))->get();

        return view('backend.usercategories.create', compact('users', 'category'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user)
    {
        $categories = array_flatten($request->category_id);
        $user->categories()->attach($categories);

        return redirect()->route('users.index');
    }
}
