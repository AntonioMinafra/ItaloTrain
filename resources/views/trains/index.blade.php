<x-layout>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Treni in Circolazione</th>
                        <th></th>
                        <th scope="col">
                            Ultimo aggiornamento: <span id="lastUpdate">--</span>
                        </th>
                    </tr>
                </thead>
                <tbody id="trains">
                     {{-- qui aggiungo le righe dei treni --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

<x-footer></x-footer>

<script src="{{ asset('js/datatrains.js') }}"></script>

</x-layout>
