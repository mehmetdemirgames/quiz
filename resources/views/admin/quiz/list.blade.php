<x-app-layout>
    <x-slot name="header">Quiz Listesi</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title float-right">
                <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                    Quiz Oluştur
                </a>
            </h5>

            <form method="GET" action="">

                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="title" class="form-control" value="{{request()->get('title')}}"
                            placeholder="Quiz Adı">
                    </div>

                    <div class="col-md-2">
                        <select name="status" onchange="this.form.submit()" class="form-control">
                            <option value="">Durum Seçiniz</option>
                            <option @if (request()->get('status')=='publish') selected @endif value="publish">Aktif
                            </option>
                            <option @if (request()->get('status')=='passive') selected @endif value="passive">Pasif
                            </option>
                            <option @if (request()->get('status')=='draft') selected @endif value="draft">Taslak
                            </option>
                        </select>
                    </div>
                    @if (request()->get('title') || request()->get('status'))
                    <div class="col-md-2">
                        <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-secondary">Filtreyi Sıfırla</a>
                    </div>
                    @endif
                </div>
            </form>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Quiz Adı</th>
                        <th scope="col">Durumu</th>
                        <th scope="col">Soru Sayısı</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                    <tr>
                        <td>{{$quiz->title}}</td>
                        <td>
                            @switch($quiz->status)
                            @case('publish')
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-green-900 rounded-full">Aktif</span>
                            @break
                            @case('draft')
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-black bg-amber-400 rounded-full">Taslak</span>
                            @break
                            @case('passive')
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">Pasif</span>
                            @break
                            @endswitch

                        </td>
                        <td> {{$quiz->questions_count}} </td>
                        <td>{{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() : 'Belirtilmemiş'}}</td>
                        <td>
                            <a href="{{route('questions.index', $quiz->id)}}" class="btn btn-sm btn-warning"><i
                                    class="fa fa-question"></i></a>
                            <a href="{{route('quizzes.edit', $quiz->id)}}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-edit"></i></a>

                            <form action="{{route('quizzes.destroy', $quiz->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$quizzes->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>
