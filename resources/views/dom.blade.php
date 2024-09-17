<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AJAX Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

Alamat IP : <input type="text" id="satu">
<button id="loadData">Get IP</button>

<script>
    $(document).ready(function() {
        $('#loadData').click(function() {
            $.ajax({
                url: 'https://api.ipify.org/?format=json',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#satu').val(data.ip);
                },
                error: function(error) {
                    $('#result').html('Terjadi kesalahan dalam memuat data');
                }
            });
        });
    });
</script>

</body>
</html>