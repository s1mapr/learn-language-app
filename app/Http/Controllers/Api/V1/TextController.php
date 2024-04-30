<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreTextRequest;
use App\Http\Resources\V1\TextResource;
use App\Http\Resources\V1\TextCollection;
use App\Models\Text;
use App\Services\TextService;

class TextController extends Controller
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Text::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTextRequest $request)
    {
        return $this->textService->saveText($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(Text $text)
    {
        return new TextResource($text);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Text $text)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTextRequest $request, Text $text)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Text $text)
    {
        //
    }
}
