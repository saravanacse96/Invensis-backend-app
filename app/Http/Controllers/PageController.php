<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.form');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'type' => 'required',
            'title' => 'required_if:type,Normal Page',
            'description' => 'required',
            'image' => 'required|image',
            'product' => 'required_if:type,Payment Page',
            'price' => ['required_if:type,Payment Page', 'nullable', 'numeric'],
            'currency' => 'required_if:type,Payment Page',
        ]);

        $page = new Page($request->all());
        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('/pages/images', $fileName);
            $page->image = $fileName;
        }
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        // dd(basename($page->image));
        // dd(Storage::exists('app/images/' . basename($page->image)));
        return view('pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required_if:type,Normal Page',
            'description' => 'required',
            'image' => 'image', // Not required, but must be an image if provided
            'product' => 'required_if:type,Payment Page',
            'price' => ['required_if:type,Payment Page', 'nullable', 'numeric'],
            'currency' => 'required_if:type,Payment Page',
        ]);

        $page->update($request->all());
        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('/pages/images', $fileName);
            $page->image = $fileName;
            $page->save();
        }

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
