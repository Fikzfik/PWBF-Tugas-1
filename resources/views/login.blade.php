<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../../assets/images/logo.svg" alt="logo">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form id="loginForm" class="pt-3" action="/postlogin" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                        placeholder="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" name="password" required>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Doesn't have an account? <a
                                        href="/register" class="text-primary">Login</a></div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/template.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <script>
      document.getElementById('loginForm').addEventListener('submit', function(e) {
          e.preventDefault(); // Prevent the form from submitting the default way
  
          let formData = new FormData(this);
  
          fetch('/postlogin', {
              method: 'POST',
              body: formData,
              headers: {
                  'X-Requested-With': 'XMLHttpRequest'
              }
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  // Show success notification
                  Swal.fire({
                      icon: "success",
                      title: "Success!",
                      text: data.message,
                      timer: 2000,
                      timerProgressBar: true,
                      willClose: () => {
                          window.location.href = data.redirect; // Redirect after a short delay
                      }
                  });
              } else {
                  // Show error notification
                  Swal.fire({
                      icon: "error",
                      title: "Oops...",
                      text: data.message,
                  });
              }
          })
          .catch(error => {
              console.error('Error:', error);
              Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Something went wrong! Please try again later.",
              });
          });
      });
  </script>
  

</body>

</html>
