<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} 'a ait sorular
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-sm btn-primary"><i
                        class="fa fa-plus"></i>
                    Soru Oluştur
                </a>
            </h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Soru Adı</th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">1.Cevap</th>
                        <th scope="col">2.Cevap</th>
                        <th scope="col">3.Cevap</th>
                        <th scope="col">4.Cevap</th>
                        <th scope="col">Doğru Cevap</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quiz->questions as $question)
                    <tr>
                        <td>{{$question->question}}</td>
                        <td>
                            @if ($question->image)
                                <a class="btn btn-secondary w-14" href="{{ asset($question->image) }}" target="_blank">Görüntüle</a>
                            @endif
                        </td>
                        <td>{{$question->answer1}}</td>
                        <td>{{$question->answer2}}</td>
                        <td>{{$question->answer3}}</td>
                        <td>{{$question->answer4}}</td>
                        <td class="text-green-900">{{substr($question->correct_answer, -1)}}.Cevap</td>
                        <td>
                            <a href="{{ route('questions.edit', [$quiz->id, $question->id]) }}"
                                class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                            <form action="{{ route('questions.destroy', [$quiz->id, $question->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
