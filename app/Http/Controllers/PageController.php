<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

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
        return view('pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required_if:type,Normal Page',
            'description' => 'required',
            'image' => 'image',
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
