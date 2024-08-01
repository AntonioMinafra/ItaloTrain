
async function updateData(){
    try {
        const response = await fetch('/TrainStatus');
        const data = await response.json();

        const lastUpdateElement = document.getElementById('lastUpdate');
        const trainsContainer = document.getElementById('trains');

        if (lastUpdateElement && trainsContainer){

            document.getElementById('lastUpdate').innerText = data.lastUpdate;

            trainsContainer.innerHTML = ''; // Pulisce il contenuto esistente

            // Aggiungi righe alla tabella

            data.trains.forEach((train, index) => {
                // Nuova riga
                const row = document.createElement('tr');

                let status = '';
                if (train.Distruption.DelayAmount < 0) {
                    status = `<i class="bi fs-6 text-warning bi-circle-fill"></i> <span>In anticipo</span>`;
                } else if (train.Distruption.DelayAmount >= 0 && train.Distruption.DelayAmount <= 10) {
                    status = `<i class="bi fs-6 text-success bi-circle-fill"></i> <span>In orario</span>`;
                } else {
                    status = `<i class="bi fs-6 text-danger bi-circle-fill"></i> <span>Ritardo ${train.Distruption.DelayAmount} minuti</span>`;
                }

                // Costruisci il contenuto della riga
                row.innerHTML = `
                    <th class="text-danger" scope="row">
                        <i class="bi bi-train-front fs-3 text-danger mx-2"></i>Italo ${train.TrainNumber}
                    </th>
                    <td>
                        ${train.DepartureStationDescription} <strong class="text-uppercase">${train.DepartureDate}</strong>
                        <i class="bi bi-arrow-right"></i>
                        ${train.ArrivalStationDescription} <strong>${train.ArrivalDate}</strong>
                    </td>
                    <td>${status}</td>
                    <td>
                        <button class="btn save-btn" data-index="${index}">
                                <i class="bi text-danger bi-save"></i>
                            </button>
                    </td>
                `;

                // appendo la riga alla tabella
                trainsContainer.appendChild(row);
            });

            // Aggiungi listener per il salvataggio
            document.querySelectorAll('.save-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const index = this.getAttribute('data-index');
                    const train = data.trains[index];
                    saveTrainData(train);
                });
            });

        }

    } catch (error) {

        console.log('Errore nel try');

    }

}

function saveTrainData(train) {
    fetch('/trains/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(train)
    })
}

// appena carichi pagina parte la funzione updateData
window.onload = function() {
    updateData(); // viene eseguita
    setInterval(updateData, 60000); // eseguita ogni 60 secondi
};
