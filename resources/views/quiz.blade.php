<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>

    <div class="card">
        <div class="card-body">

            <form action="{{route('quiz.result', $quiz->slug)}}" method="POST">
            @csrf
            @foreach($quiz->questions as $question)
            <strong>#{{$loop->iteration}} {{$question->question}}</strong>
            
            @if ($question->image)
                <img src="{{asset($question->image)}}" style="width: 200px">
            @endif

            <div class="custom-control custom-radio mt-2">
                <input type="radio" id="quiz{{$question->id}}1" value="answer1" name="{{$question->id}}" class="custom-control-input" required>
                <label class="form-check-label" for="quiz{{$question->id}}1">{{$question->answer1}}</label>
            </div>

            <div class="custom-control custom-radio">
                <input type="radio" id="{{$question->id}}2" value="answer2" name="{{$question->id}}" class="custom-control-input" required>
                <label class="form-check-label" for="quiz{{$question->id}}2">{{$question->answer2}}</label>
            </div>

            <div class="custom-control custom-radio">
                <input type="radio" id="{{$question->id}}3" value="answer3" name="{{$question->id}}" class="custom-control-input" required>
                <label class="form-check-label" for="quiz{{$question->id}}3">{{$question->answer3}}</label>
            </div>

            <div class="custom-control custom-radio">
                <input type="radio" id="{{$question->id}}4" value="answer4" name="{{$question->id}}" class="custom-control-input" required>
                <label class="form-check-label" for="quiz{{$question->id}}4">{{$question->answer4}}</label>
            </div>
            <hr>
             @endforeach
            <button class="btn btn-success w-full" type="submit">Sınavı Bitir</button>

             </form>
        </div>
    </div>




</x-app-layout>
