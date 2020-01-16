function loadHistory() {
    if (localStorage.list_data && localStorage.id_data) {
        list_data = JSON.parse(localStorage.getItem('list_data'));
        var data_app = "";
        if (list_data.length > 0) {
            data_app = '<table class="table table-striped table-dark">';
            data_app += '<thead>' +
                '<th>Waktu</th>' +
                '<th>Bacaan</th>' +
                '<th>Jumlah</th>' +
                '<th>Keterangan</th>' +
                '<th>Aksi</th>' +
                '</thead> <tbody>';

            for (i in list_data) {
                data_app += '<tr>';
                data_app +=
                    '<td>' + list_data[i].waktu + ' </td>' +
                    '<td>' + list_data[i].bacaan + ' </td>' +
                    '<td>' + list_data[i].jumlah + 'x </td>' +
                    '<td>' + list_data[i].keterangan + ' </td>' +
                    '<td><a class="btn btn-danger btn-small" href="javascript:void(0)" onclick="hapusData(\'' + list_data[i].id_data + '\')">Hapus</a></td>';
                data_app += '</tr>';
            }

            data_app += '</tbody></table>';

        }
        else {
            data_app = "History kosong";
        }


        $('#history-dzikir').html(data_app);
        $('#history-dzikir').hide();
        $('#history-dzikir').fadeIn(100);
    }
}

function simpanDzikir() {
    jumlah = $('#jumlah').val();
    $("#ketjumlah").val(jumlah);
    document.getElementById('form-data').reset();
    gantiMenu('ket-dialog');
}

function okDzikir() {
    jumlah = $('#ketjumlah').val();
    bacaan = $('#ketbacaan').val();
    waktu = $('#ketwaktu').val();
    keterangan = $('#ketketerangan').val();

    if (localStorage.list_data && localStorage.id_data) {
        list_data = JSON.parse(localStorage.getItem('list_data'));
        id_data = parseInt(localStorage.getItem('id_data'));
    }
    else {
        list_data = [];
        id_data = 0;
    }

    id_data++;
    list_data.push({ 'id_data': id_data, 'jumlah': jumlah, 'bacaan': bacaan, 'waktu': waktu, 'keterangan': keterangan });
    localStorage.setItem('list_data', JSON.stringify(list_data));
    localStorage.setItem('id_data', id_data);

    if (!liff.isInClient()) {
        sendAlertIfNotInClient();
        alert('Dzikir Tersimpan');
    } else {
        liff.sendMessages([{
            'type': 'text',
            'text': "Dzikir baru berhasil disimpan"
        }]).then(function() {
            alert('Dzikir Tersimpan');
        }).catch(function(error) {
            alert('Error!!');
        });
    }


    document.getElementById('ketform-data').reset();
    gantiMenu('history-dzikir');

    return false;
}

function hapusData(id) {
    if (localStorage.list_data && localStorage.id_data) {
        list_data = JSON.parse(localStorage.getItem('list_data'));

        idx_data = 0;
        for (i in list_data) {
            if (list_data[i].id_data == id) {
                list_data.splice(idx_data, 1);
            }
            idx_data++;
        }

        localStorage.setItem('list_data', JSON.stringify(list_data));
        loadHistory();
    }

    if (!liff.isInClient()) {
        sendAlertIfNotInClient();
        alert('History sudah dihapus')
    } else {
        liff.sendMessages([{
            'type': 'text',
            'text': "History terpilih sudah terhapus"
        }]).then(function() {
            alert('History sudah dihapus');
        }).catch(function(error) {
            alert('ERROR!!');
        });
    }

}


function gantiMenu(menu) {
    if (menu == "history-dzikir") {
        loadHistory();
        $('#mulai-dzikir').hide();
        $('#ket-dialog').hide();
        $('#history-dzikir').fadeIn();
    }
    else if (menu == "mulai-dzikir") {
        $('#mulai-dzikir').fadeIn();
        $('#ket-dialog').hide();
        $('#history-dzikir').hide();
    } 
    else if (menu == "ket-dialog") {
        $('#ket-dialog').fadeIn();
        $('#mulai-dzikir').hide();
        $('#history-dzikir').hide();
    }
}