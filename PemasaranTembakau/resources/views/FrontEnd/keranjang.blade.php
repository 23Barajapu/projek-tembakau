<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Penjualan Tembakau</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="Template FrontEnd/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="Template FrontEnd/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="Template FrontEnd/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="Template FrontEnd/css/style.css" rel="stylesheet">
    <style>
        .text-left-center {
            text-align: left;
            /* Align text to the left */
            vertical-align: middle;
            /* Center the content vertically */
        }

        .img-fluid {
            /* You can keep your existing styles for images */
            width: 80px;
            height: 50px;
        }
    </style>
</head>

<body>

    <script>
        function toggleSelection(source) {
            let checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source
                    .checked; // Setiap checkbox akan disesuaikan dengan status checkbox "Select All"
            });

            // Panggil updateSubtotal untuk menghitung subtotal berdasarkan checkbox yang terpilih
            updateSubtotal();
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Mengatur checkbox "Select All" untuk checked
            const selectAllCheckbox = document.getElementById('select-all');
            selectAllCheckbox.checked = true; // Atur checkbox "Select All" menjadi checked

            // Panggil toggleSelection untuk mencentang semua item
            toggleSelection(selectAllCheckbox);
        });

        function updateSubtotal() {
            let total = 0; // Total keseluruhan
            let checkboxes = document.querySelectorAll('.select-item'); // Ambil semua checkbox

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) { // Jika checkbox terpilih
                    let row = checkbox.closest('tr'); // Ambil baris terkait
                    let price = parseFloat(row.querySelector('.price').getAttribute('data-price')) ||
                        0; // Ambil harga
                    let qty = parseInt(row.querySelector('.qty').value) || 0; // Ambil kuantitas
                    let subtotal = price * qty; // Hitung subtotal
                    row.querySelector('.subtotal').textContent = formatRupiah(subtotal); // Update subtotal di UI
                    total += subtotal; // Tambahkan subtotal ke total keseluruhan
                }
            });

            // Update total keseluruhan di checkout
            document.getElementById('checkout-total').textContent = formatRupiah(total);
        }

        // Fungsi untuk memformat rupiah
        function formatRupiah(value) {
            return `Rp${value.toLocaleString('id-ID')},00`; // Format ke format rupiah
        }


        // Fungsi untuk menghitung total keseluruhan
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(function(subtotalElement) {
                let subtotal = parseFloat(subtotalElement.getAttribute('data-subtotal')) || 0;
                total += subtotal;
            });

            // Update total di tampilan
            document.getElementById('checkout-total').textContent = formatRupiah(total);
        }

        // Update quantity and update the cart in the database
        function updateCart(id, qty) {
            // AJAX untuk memperbarui keranjang di server
            $.ajax({
                url: '/update-cart', // Your route to update the cart
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token for Laravel
                    id: id,
                    qty: qty
                },
                success: function(response) {
                    if (response.updated) {
                        // Update subtotal and total when successful
                        let row = document.querySelector(`tr[data-id='${id}']`);
                        if (row) {
                            let price = parseFloat(row.querySelector('.price').getAttribute('data-price')) ||
                                0; // Get price
                            let subtotal = price * qty; // Calculate new subtotal
                            row.querySelector('.subtotal').textContent = formatRupiah(
                                subtotal); // Update subtotal in UI
                            row.querySelector('.subtotal').setAttribute('data-subtotal',
                                subtotal); // Update data-subtotal
                            updateSubtotal(); // Call to update total overall
                        }
                    } else {
                        console.log('No changes made to the cart.');
                    }
                },
                error: function(xhr) {
                    console.error('Error updating cart');
                }
            });
        }

        // Initialize cart items when the page loads from the server
        window.onload = function() {
            $.ajax({
                url: '/cart-items', // Your route to get cart items
                type: 'GET',
                success: function(response) {
                    response.forEach(item => {
                        const id = item.id;
                        const qty = item.jumlah; // Assuming jumlah is the quantity in your database
                        // Update quantity in UI based on data from server
                        const row = document.querySelector(`tr[data-id='${id}']`);
                        if (row) {
                            row.querySelector('.qty').value = qty;
                            updateCart(id, qty); // Call to update subtotal
                        }
                    });
                },
                error: function(xhr) {
                    console.error('Error loading cart items');
                }
            });
        };

        // Fungsi untuk menghapus barang dari keranjang
        function deleteItem(button) {
            let row = button.closest('tr');
            let id = row.querySelector('.select-item').getAttribute('data-id');

            $.ajax({
                url: '/delete-cart', // Update with the correct route for your Laravel application
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token for Laravel
                    id: id
                },
                success: function(response) {
                    if (response.deleted) { // Assuming your response has a deleted property
                        row.remove(); // Remove the row from the table
                        updateSubtotal(); // Update subtotal after deletion
                        location.reload();
                        console.log('Item removed successfully');
                    } else {
                        console.log('Failed to remove item.');
                    }
                },
                error: function(xhr) {
                    console.error('Error deleting item');
                }
            });
        }

        function proceedCheckout() {
            let selectedItems = [];
            let checkboxes = document.querySelectorAll('.select-item');

            // Ambil semua checkbox yang dipilih
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    let id = checkbox.getAttribute('data-id');
                    selectedItems.push(id);
                }
            });

            // Cek apakah ada barang yang dipilih
            if (selectedItems.length > 0) {
                // Redirect ke form pembelian dengan ID yang dipilih sebagai parameter
                let url = `/form-pembelian?ids=${selectedItems.join(',')}`;
                window.location.href = url;
            } else {
                alert('Silakan pilih barang terlebih dahulu!');
            }
        }
    </script>


    <x-navpengunjung></x-navpengunjung>


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" id="select-all" onclick="toggleSelection(this)"> Select All
                            </th>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>

                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjangs as $keranjang)
                            <tr data-id="{{ $keranjang->id }}">
                                <td class="text-left-center">
                                    <input type="checkbox" class="select-item" data-id="{{ $keranjang->id }}"
                                        onchange="updateSubtotal(this)">
                                </td>
                                <td>
                                    <img src="{{ asset('images/' . $keranjang->barang->gambar_brg) }}" class="img-fluid"
                                        style="width: 80px; height:50px">
                                </td>
                                <td class="text-left-center">{{ $keranjang->barang->nama }}</td>
                                <td class="text-left-center price" data-price="{{ $keranjang->barang->harga }}">
                                    Rp{{ number_format($keranjang->barang->harga, 0, ',', '.') }}
                                </td>
                                <td class="text-left-center">
                                    <input type="number" class="form-control qty" value="{{ $keranjang->jumlah }}"
                                        min="1"
                                        onchange="updateCart('{{ $keranjang->id }}', this.value); updateSubtotal(this);">
                                </td>
                                <td class="text-left-center subtotal" data-subtotal="{{ $keranjang->sub_total }}">
                                    Rp{{ number_format($keranjang->sub_total, 0, ',', '.') }}
                                </td>
                                <td class="text-left-center">
                                    <button class="btn btn-md rounded-circle bg-light border"
                                        onclick="deleteItem(this)">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p id="checkout-total" class="mb-0 pe-4">Rp 0,00</p> <!-- Changed to Rp -->
                        </div>
                        <button
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button" onclick="proceedCheckout()">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->

    <x-footer></x-footer>
    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your
                            Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Template FrontEnd/libeasing/easing.min.js"></script>
    <script src="Template FrontEnd/libwaypoints/waypoints.min.js"></script>
    <script src="Template FrontEnd/liblightbox/js/lightbox.min.js"></script>
    <script src="Template FrontEnd/libowlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
