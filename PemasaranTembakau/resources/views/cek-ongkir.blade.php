<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ongkir dan Resi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h2>Cek Ongkir</h2>
    <form id="cek-ongkir-form">
        <label for="province_origin">Provinsi Asal:</label>
        <select id="province_origin" name="origin" required>
            <option value="">Pilih Provinsi</option>
        </select>

        <label for="city_origin">Kota Asal:</label>
        <select id="city_origin" name="origin_city" required>
            <option value="">Pilih Kota</option>
        </select>

        <label for="province_destination">Provinsi Tujuan:</label>
        <select id="province_destination" name="destination" required>
            <option value="">Pilih Provinsi</option>
        </select>

        <label for="city_destination">Kota Tujuan:</label>
        <select id="city_destination" name="destination_city" required>
            <option value="">Pilih Kota</option>
        </select>

        <label for="weight">Berat (gram):</label>
        <input type="number" name="weight" id="weight" required>

        <label for="courier">Kurir:</label>
        <select id="courier" name="courier" required>
            <option value="jne">JNE</option>
            <option value="pos">POS</option>
            <option value="tiki">TIKI</option>
        </select>

        <button type="submit">Cek Ongkir</button>
    </form>

    <div id="result"></div>

    <script>
        $(document).ready(function() {
            // Load provinces
            $.get('/provinces', function(data) {
                $.each(data.rajaongkir.results, function(index, value) {
                    $('#province_origin, #province_destination').append(
                        `<option value="${value.province_id}">${value.province}</option>`
                    );
                });
            }).fail(function(xhr, status, error) {
                alert('Gagal memuat provinsi.');
            });

            // Load cities when province is selected
            $('#province_origin').on('change', function() {
                let province_id = $(this).val();
                $('#city_origin').empty().append('<option value="">Pilih Kota</option>');
                if (province_id) {
                    $.get(`/cities/${province_id}`, function(data) {
                        $.each(data.rajaongkir.results, function(index, value) {
                            $('#city_origin').append(
                                `<option value="${value.city_id}">${value.city_name}</option>`
                            );
                        });
                    }).fail(function() {
                        alert('Gagal memuat kota asal.');
                    });
                }
            });

            $('#province_destination').on('change', function() {
                let province_id = $(this).val();
                $('#city_destination').empty().append('<option value="">Pilih Kota</option>');
                if (province_id) {
                    $.get(`/cities/${province_id}`, function(data) {
                        $.each(data.rajaongkir.results, function(index, value) {
                            $('#city_destination').append(
                                `<option value="${value.city_id}">${value.city_name}</option>`
                            );
                        });
                    }).fail(function() {
                        alert('Gagal memuat kota tujuan.');
                    });
                }
            });

            // Handle form submission
            $('#cek-ongkir-form').submit(function(e) {
                e.preventDefault();
                let origin = $('#city_origin').val();
                let destination = $('#city_destination').val();
                let weight = $('#weight').val();
                let courier = $('#courier').val();

                $.post('/cost', {
                    origin: origin,
                    destination: destination,
                    weight: weight,
                    courier: courier
                }, function(data) {
                    $('#result').empty();
                    if (data.rajaongkir && data.rajaongkir.results.length) {
                        $.each(data.rajaongkir.results[0].costs, function(index, value) {
                            $('#result').append(
                                `<p>Service: ${value.service}, Cost: ${value.cost[0].value}, Estimated Delivery: ${value.cost[0].etd} days</p>`
                            );
                        });
                    } else {
                        $('#result').append('<p>Tidak ada data ongkos kirim.</p>');
                    }
                }).fail(function() {
                    $('#result').append('<p>Gagal memuat ongkos kirim.</p>');
                });
            });
        });
    </script>
</body>

</html>
