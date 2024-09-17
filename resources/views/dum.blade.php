<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Example - Data Gempa BMKG</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<h1>Data Gempa Terkini</h1>
<!-- Input Field untuk menampilkan salah satu data -->
Alamat IP: <input type="text" id="satu"><br><br>

<!-- Tombol untuk mengambil data -->
<button id="loadData">Get Data</button>

<!-- Area untuk menampilkan hasil data gempa -->
<div id="result"></div>

<script>
    $(document).ready(function() {
        $('#loadData').click(function() {
            $.ajax({
                url: 'https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Menampilkan URL di input field
                    $('#satu').val(data.Infogempa.gempa.Shakemap);

                    // Menampilkan data lainnya di dalam div 'result'
                    $('#result').html(`
                        <h3>Informasi Gempa</h3>
                        <p><strong>Waktu:</strong> ${data.Infogempa.gempa.Tanggal} ${data.Infogempa.gempa.Jam}</p>
                        <p><strong>Magnitude:</strong> ${data.Infogempa.gempa.Magnitude}</p>
                        <p><strong>Kedalaman:</strong> ${data.Infogempa.gempa.Kedalaman}</p>
                        <p><strong>Wilayah:</strong> ${data.Infogempa.gempa.Wilayah}</p>
                        <p><strong>Potensi:</strong> ${data.Infogempa.gempa.Potensi}</p>
                    `);
                },
                error: function(error) {
                    $('#result').html('Terjadi kesalahan dalam memuat data.');
                }
            });
        });
    });
</script>

</body>
</html>
