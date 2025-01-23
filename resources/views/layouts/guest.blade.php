<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>OCODAS - CORP</title>
    <meta
        content="OCODAS est une entreprise informatique basée
    en République Démocratique du Congo, spécialisée dans le développement
     de solutions technologiques innovantes et sur mesure.
     Forte d'une équipe dynamique et passionnée, OCODAS s'engage à fournir des
      services de haute qualité
    pour répondre aux besoins variés de ses clients"
        name="description">
    <meta content="OCODAS, TECHNOLOGIE, informatique, Bunia" name="keywords">
    <meta content="UZASHOP POS" name="authors">

    <!-- Favicons -->
    <link href="/assets/logoocodas/logo.png" rel="icon">
    <link href="/assets/logoocodas/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


    <style>
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Roboto:wght@300;400;500;900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
        }

        #hero main {
            position: relative;
            width: calc(min(90rem, 90%));
            margin: 0 auto;
            min-height: 100vh;
            column-gap: 3rem;
            padding-block: min(20vh, 3rem);
        }

        #hero .bg {
            position: fixed;
            top: -4rem;
            left: -12rem;
            z-index: -1;
            opacity: 0;
        }

        #hero .bg2 {
            position: fixed;
            bottom: -2rem;
            right: -3rem;
            z-index: -1;
            width: 9.375rem;
            opacity: 0;
        }

        #hero main>div span {
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 1rem;
            color: #717171;
        }

        #hero main>div h1 {
            text-transform: capitalize;
            letter-spacing: 0.8px;
            font-family: "Roboto", sans-serif;
            font-weight: 900;
            font-size: clamp(3.4375rem, 3.25rem + 0.75vw, 4rem);
            background-color: #be914f;
            background-image: linear-gradient(45deg, #be914f, #000000);
            background-size: 100%;
            background-repeat: repeat;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            -moz-background-clip: text;
            -moz-text-fill-color: transparent;
        }

        #hero main>div hr {
            display: block;
            background: #be914f;
            height: 0.25rem;
            width: 6.25rem;
            border: none;
            margin: 1.125rem 0 1.875rem 0;
        }

        #hero main>div p {
            line-height: 1.6;
        }

        #hero main a {
            display: inline-block;
            text-decoration: none;
            text-transform: uppercase;
            color: #717171;
            font-weight: 500;
            background: #fff;
            border-radius: 3.125rem;
            transition: 0.3s ease-in-out;
        }

        #hero main>div>a {
            border: 2px solid #c2c2c2;
            margin-top: 2.188rem;
            padding: 0.625rem 1.875rem;
        }

        #hero main>div>a:hover {
            border: 0.125rem solid #be914f;
            color: #be914f;
        }

        #hero .swiper {
            width: 100%;
            padding-top: 3.125rem;
        }

        #hero .swiper-pagination-bullet,
        #hero .swiper-pagination-bullet-active {
            background: #fff;
        }

        #hero .swiper-pagination {
            bottom: 1.25rem !important;
        }

        #hero .swiper-slide {
            width: 18.75rem;
            height: 28.125rem;
            display: flex;
            flex-direction: column;
            justify-content: end;
            align-items: self-start;
        }

        #hero .swiper-slide h2 {
            color: #fff;
            font-family: "Roboto", sans-serif;
            font-weight: 400;
            font-size: 1.4rem;
            line-height: 1.4;
            margin-bottom: 0.625rem;
            padding: 0 0 0 1.563rem;
            text-transform: uppercase;
        }

        #hero .swiper-slide p {
            color: #dadada;
            font-family: "Roboto", sans-serif;
            font-weight: 300;
            padding: 0 1.563rem;
            line-height: 1.6;
            font-size: 0.75rem;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        #hero .swiper-slide a {
            margin: 1.25rem 1.563rem 3.438rem 1.563rem;
            padding: 0.438em 1.875rem;
            font-size: 0.9rem;
        }

        #hero .swiper-slide a:hover {
            color: #be914f;
        }

        #hero .swiper-slide div {
            display: none;
            opacity: 0;
            padding-bottom: 0.625rem;
        }

        #hero .swiper-slide-active div {
            display: block;
            opacity: 1;
        }



        #hero .swiper-3d .swiper-slide-shadow-left,
        #hero .swiper-3d .swiper-slide-shadow-right {
            background-image: none;
        }

        @media screen and (min-width: 48rem) {
            #hero main {
                display: flex;
                align-items: center;
            }

            #hero .bg,
            #hero .bg2 {
                opacity: 0.1;
            }
        }

        @media screen and (min-width: 93.75rem) {
            #hero .swiper {
                width: 85%;
            }
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <a href="/" class="logo me-auto"><img src="assets/logoocodas/logo.png" alt=""></a>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Acceuil</a></li>
                    <!-- <li><a class="nav-link scrollto" href="#about">A Propos</a></li> -->
                    <li><a class="nav-link scrollto" href="#services">Nos Services</a></li>
                    <li><a class="nav-link scrollto " href="#portfolio">Nos Réalisations</a></li>
                    <li><a class="nav-link scrollto " href="#testimonials">Témoignages</a></li>
                    <!-- <li><a class="nav-link scrollto" href="#team">Equipe</a></li> -->
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            <!-- <a href="#about" class="get-started-btn scrollto">Get Started</a> -->
        </div>
    </header><!-- End Header -->

    <!-- preloader end -->
    {{ $slot }}

    <x-project-drawer />

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 footer-contact">
                        <h3>OCODAS<span>-</span>CORP</h3>
                        <p>
                            Av. Adam Street <br>
                            Bunia, Ituri<br>
                            RD-CONGO <br><br>
                            <strong>Phone:</strong> +243 975 152 592<br>
                            <strong>Email:</strong> info@ocodas.com<br>
                        </p>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Liens</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Acceuil</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Pourquoi nous </a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Nos Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Developpement Logiciel</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Infrastructure Réseau</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Gestions des Projets</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Internet Haut Débit</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Formation</a></li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>OCODAS</span></strong>. All Rights Reserved
                </div>
                <!-- <div class="credits">Powered by <a target="_blank" href="https://uzashop.co">UZASHOP POS</a></div> -->
            </div>
            <div class="social-links text-center text-md-end pt-3 pt-md-0">
                <!-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> -->
                <!-- <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a> -->
                <a href="https://www.instagram.com/ocodascorp/" class="instagram"><i class="bx bxl-instagram"></i></a>
                <!-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a> -->
                <a href="https://www.linkedin.com/company/ocodas-corporation/posts/?feedView=all" class="linkedin"><i
                        class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>


    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="app.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Add these to your layout if not already present -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        /*
            inspiration
            https://dribbble.com/shots/4684682-Aquatic-Animals
            */

        var swiper = new Swiper(".home-swiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 3,
                slideShadows: true
            },
            keyboard: {
                enabled: true
            },
            mousewheel: {
                thresholdDelta: 70
            },
            loop: true,
            autoplay: {
                delay: 3000, // Delay between transitions in milliseconds
                disableOnInteraction: false // Continue autoplay after user interactions
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 1
                },
                1024: {
                    slidesPerView: 2
                },
                1560: {
                    slidesPerView: 3
                }
            }
        });
    </script>
</body>

</html>
