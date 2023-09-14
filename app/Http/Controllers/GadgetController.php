<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use Illuminate\Http\Request;

class GadgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  onlyTrashed
    // withTrashed

    public function index()
    {
        $data = [

            'posts' => Gadget::get(),

        ];

        return view('gadget.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gadget.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gadgetType' => 'required',
            'price' => 'required',
        ]);



        Gadget::create([
            'gadgetType' => $request->input('gadgetType'),
            'price' => $request->input('price'),

        ]);
        return redirect()->route('gadget.index')->with('success', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'name' => 'Showing detail of  ',
            'post' => Gadget::where('id', $id)->first(),
            
        ];
        // dd($data);
        return view('gadget.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'post' => Gadget::where('id', $id)->first(),
        ];
        return view('gadget.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'gadgetType' => 'required',
            'price' => 'required',
        ]);

        $post = Gadget::find($id);
        if($post) {

            $post->update([
                'gadgetType' => $request->input('gadgetType'),
                'price' => $request->input('price'),
            ]);
            return redirect()->route('gadget.index')->with('success', 'Successfully Updated');
        }
        return redirect()->route('gadget.index')->with('warning', 'Nothing to update!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Gadget::find($id);

        if($post) {

            $post->delete();
            return redirect()->route('gadget.index')->with('success', 'Successfully Deleted');
        }
        return redirect()->route('gadget.index')->with('warning', 'Nothing to delete!!');
    }
}
