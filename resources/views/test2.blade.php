<script>
    $(document).ready(function() {
        $('#sendMessageForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ route('message.store') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: response.message,
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            window.location.href = response
                            .redirect; // This should work
                        }
                    });
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.error :
                        'An error occurred.';
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: errorMessage,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: true
                    });
                }
            });
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>