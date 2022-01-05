<x-app-layout>
    <x-slot name="header">Quiz Listesi</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                    Quiz Oluştur
                </a>
            </h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Quiz Adı</th>
                        <th scope="col">Durumu</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                    <tr>
                        <td>{{$quiz->title}}</td>
                        <td class="">{{$quiz->status}}</td>
                        <td>{{$quiz->finished_at}}</td>
                        <td>
                            <a href="{{route('quizzes.edit', $quiz->id)}}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-edit"></i></a>

                            <form action="{{route('quizzes.destroy', $quiz->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$quizzes->links()}}
        </div>
    </div>
</x-app-layout>
