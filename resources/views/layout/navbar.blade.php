<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo me-5" href="index.html"><img src="assets/images/logo.svg" class="me-2"
                alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
                alt="logo" /></a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                        aria-label="search" aria-describedby="search">
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <!-- Button to trigger SweetAlert modal -->
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showMessageModal()">
                    <i class="icon-bell mx-0"></i> Notification
                </a>
            </li>
            <!-- Profile dropdown remains the same -->
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img src="assets/images/faces/face28.jpg" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/setting" method="GET">
                        <i class="ti-settings text-primary"></i> Settings
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off text-primary"></i> Logout
                    </a>
                </div>
            </li>
            <!-- Additional settings button -->
            <li class="nav-item nav-settings d-none d-lg-flex">
                <a class="nav-link" href="#">
                    <i class="icon-ellipsis"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
<!-- SweetAlert Modal Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showMessageModal() {
        // Mengambil pesan yang belum dibaca dari server
        $.ajax({
            url: '{{ route('unread.messages') }}', // Ganti dengan route yang sesuai
            method: 'GET',
            success: function(response) {
                // Jika tidak ada pesan yang belum dibaca
                if (response.length === 0) {
                    Swal.fire({
                        position: "top-end",
                        title: "Message",
                        text: "Tidak ada pesan baru.",
                        showClass: {
                            popup: `
                                animate__animated
                                animate__fadeInUp
                                animate__faster
                            `
                        },
                        hideClass: {
                            popup: `
                                animate__animated
                                animate__fadeOutDown
                                animate__faster
                            `
                        },
                        confirmButtonText: 'Tutup' // Menambahkan tombol tutup
                    });
                    return; // Keluar dari fungsi
                }

                // Mengumpulkan pesan dalam format HTML
                let messageList = response.map(message => 
                    `<div style="padding: 10px; border-bottom: 1px solid #e0e0e0;">${message.text}</div>`
                ).join('');

                // Tampilkan modal dengan pesan yang belum dibaca
                Swal.fire({
                    position: "top-end",
                    title: "Pesan Baru",
                    html: messageList,
                    showClass: {
                        popup: `
                            animate__animated
                            animate__fadeInUp
                            animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                            animate__animated
                            animate__fadeOutDown
                            animate__faster
                        `
                    },
                    confirmButtonText: 'Tutup' // Menambahkan tombol tutup
                });
            },
            error: function(xhr) {
                console.error('Error fetching messages:', xhr);
                Swal.fire({
                    position: "top-end",
                    title: "Error",
                    text: "Terjadi kesalahan saat mengambil pesan.",
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    }
</script>
