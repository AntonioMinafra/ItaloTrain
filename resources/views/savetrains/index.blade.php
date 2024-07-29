<x-layout>
    {{-- messaggio avviso --}}
    @if (session('success'))
    <div class="alert rounded-3  alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container mt-5">
        <div class="row align-items-center justify-content-center">
            {{-- form dei filtri --}}
            <form  method="GET" action="{{ route('save.trains') }}" class="mb-4">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="creation_date" class="form-label">Data di salvataggio:</label>
                        <input type="date" id="creation_date" name="creation_date" class="form-control" value="{{ request('creation_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="train_number" class="form-label">Codice treno:</label>
                        <input type="text" id="train_number" name="train_number" class="form-control " value="{{ request('train_number') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success bg-primary">Filtra</button>
                    </div>
                </div>
            </form>

            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Treni salvati</th>
                            <th></th>
                            <th></th>
                            <th>
                                {{-- form btn elimina tutti --}}
                                <form method="POST" action="{{ route('train.deleteAll') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina tutti</button>
                                </form>
                            </th>
                        </tr>
                    </thead>
                    {{-- corpo tabella --}}
                    <tbody>
                        @foreach ($trains as $train)
                        <tr>
                            <th class="text-danger" scope="row">
                                <i class="bi bi-train-front fs-3 text-danger mx-2"></i>Italo {{$train->TrainNumber}}
                            </th>
                            <td>{{$train->DepartureStationDescription}} <strong>{{$train->DepartureDate}}</strong> <i class="bi bi-arrow-right"></i> {{$train->ArrivalStationDescription}} <strong>{{$train->ArrivalDate}}</strong></td>
                            <th>{{\Carbon\Carbon::parse($train->created_at)->format('d/m/Y H:i') }}</th>
                            <td>
                                <form action="{{route('train.destroy', $train->id)}}" method="post">
                                    @method('Delete')
                                    @csrf
                                    <button class="btn" type="submit">
                                        <i class="bi bi-trash text-danger fs-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $trains->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</x-layout>