<?php
// Tangkap parameter kategori dari URL
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Masakan Tradisional'; // Default jika tidak ada parameter
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ResepKu - Website Resep Masakan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-danger" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0" id="home">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0 mt-3 mb-1">
                    <h1 class="m-0">ResepKu</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                    </div>
                    <div class="flex-shrink-0 btn-square rounded-circle ms-2 bg-danger">
                        <a href="profile.php" class="fa fa-user text-white" style="text-decoration: none;"></a>
                    </div>                    
                    <div class="flex-shrink-0 btn-square rounded-circle ms-2 bg-danger">
                        <a href="tambah.php" class="fa fa-plus text-white" style="text-decoration: none;"></a>
                    </div> 
                </div>
            </nav> 

            <div class="container-xxl bg-danger hero-header">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="container py-5">
                        <!-- Tampilkan kategori yang dipilih -->
                        <h1 class="text-center mb-4 text-white"><?php echo htmlspecialchars($kategori); ?></h1> 

                        <div class="breadcrumb-con">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    <i class="fa-solid fa-angles-right"></i>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($kategori); ?></li>
                            </ol>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Resep Start -->
        <div class="container wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
            <div class="container">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="tabs-box tabs-options">
                        <ul class="nav nav-tabs justify-content-center align-items-center">
                        <li><a class="active" data-toggle="tab" href="#all">All</a></li>
                        <li><a data-toggle="tab" href="#ayam">Ayam</a></li>
                        <li><a data-toggle="tab" href="#sapi">Sapi</a></li>
                        <li><a data-toggle="tab" href="#kambing">Kambing</a></li>
                        <li><a data-toggle="tab" href="#nasi">Nasi</a></li>
                        </ul>
                        <div class="tab-content">
                            <!--all-->
                            <div id="all" class="tab-pane fade show active">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 mb-2 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>  
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div> 
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div> 
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>                                      
                                </div>
                            </div>

                            <div id="ayam" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>  
                                                                  
                                </div>
                            </div>

                            <div id="sapi" class="tab-pane fade">
                                <div class="row">
                                    <!-- Data Sapi Pertama -->
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>  
                                    <!-- Data Sapi Kedua -->
                                    <!-- <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>   -->
                                </div>
                            </div>

                            <div id="kambing" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>  
                                </div>
                            </div>

                            <div id="nasi" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="recipe-box">
                                            <div class="img-outer position-relative">
                                                <img class="img-fluid" alt="img" src="img/carousel.png">
                                            </div>
                                            <div class="course-bottom-con">
                                                <h5 class="font-weight-600 mt-2">Rendang</h5>
                                                <p>Hidangan berbahan dasar daging yang dihasilkan dari proses memasak suhu rendah dalam waktu lama dengan menggunakan aneka rempah-rempah dan santan.</p>
                                            </div>
                                            <br>
                                            <a href="resep.php" class="">Show <i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Resep End -->  

        

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-body footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Address<span></span></p>
                        <p><i class="fa fa-map-marker-alt me-3"></i>Jawa Tengah, Indonesia</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+6285 4323 1896</p>
                        <p><i class="fa fa-envelope me-3"></i>ResepKu@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Quick Link<span></span></p>
                        <a class="btn btn-link" href="">Beranda</a>
                        <a class="btn btn-link" href="">Tentang</a>
                        <a class="btn btn-link" href="">Resep</a>
                        <a class="btn btn-link" href="">Resep Terbaru</a>
                        <a class="btn btn-link" href="">Penggunaan</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Layanan<span></span></p>
                        <a class="btn btn-link" href="">Tips</a>
                        <a class="btn btn-link" href="">Kursus</a>
                        <a class="btn btn-link" href="">Komunitas</a>
                        <a class="btn btn-link" href="">Pengalaman</a>
                        <a class="btn btn-link" href="">Karir</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Hubungi Kami<span></span></p>
                        <p>Hubungi kami untuk mengirimkan kritik dan saran</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Your Email" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy Copyright <a class="border-bottom" href="#">ResepKu</a>. All Right Reserved. 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-light btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>


    <!--JS Code-->
       

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>