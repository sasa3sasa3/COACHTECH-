<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('contact.index', compact('categories', 'tags'));
    }

    public function confirm(StoreContactRequest $request)
    {
        $validated = $request->validated();
        $category = Category::findOrFail($request->category_id);
        $tags = Tag::whereIn('id', $validated['tag_ids'] ?? [])->get();
        
        return view('contact.confirm', compact('validated', 'category', 'tags'));

    }

    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();

        $tag_ids = $validated['tag_ids'] ?? []; //タグIDをとりだす
        unset($validated['tag_ids']); //contactsテーブルに存在しない項目を除外(tags_id)

        $contact = Contact::create($validated);

        $contact->tags()->attach($tag_ids); //中間テーブルにタグを登録

        return redirect()->route('contacts.thanks');

    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}
