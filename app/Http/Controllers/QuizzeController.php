<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizzeRequest;
use App\Http\Requests\UpdateQuizzeRequest;
use App\Models\Quiz;

class QuizzeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuizzeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quizze)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quizze)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuizzeRequest $request, Quiz $quizze)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quizze)
    {
        //
    }
}
