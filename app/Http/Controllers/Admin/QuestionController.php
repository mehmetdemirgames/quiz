<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($quiz_id)
    {
        $quiz = Quiz::whereId($quiz_id)->with('questions')->first() ?? abort(404, 'Quiz bulunamadı');
        $quiz->setRelation('questions', $quiz->questions()->paginate(5)); // https://stackoverflow.com/questions/33507581/how-to-paginate-a-has-many-relationship-that-is-ordered
        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quiz_id)
    {
        $quiz = Quiz::find($quiz_id) ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, $quiz_id)
    {
        if($request->hasFile('image')){
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload,
            ]);

        }

        Quiz::find($quiz_id)->questions()->create($request->post()) ?? abort(404, 'Quiz bulunamadı veya soru eklenemedi');

        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($quiz_id, $question_id)
    {
        return $quiz_id. '-'. $question_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id, $question_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Quiz veya Soru bulunamadı');
        
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id, $question_id)
    {
         if($request->hasFile('image')){
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload,
            ]);

        }

        Quiz::find($quiz_id)->questions()->whereId($question_id)->first()->update($request->post()) ?? abort(404, 'Quiz bulunamadı veya soru güncellenemedi');

        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru başarıyla güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id, $question_id)
    {

        $quiz = Quiz::find($quiz_id)->questions()->whereId($question_id) ?? abort(404, 'Quiz veya Soru Bulunamadı');
        $quiz->delete();

        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru başarıyla silindi');
    }
}
