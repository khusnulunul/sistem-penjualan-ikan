@extends('components.head.user')

<body>

    <!-- Topbar Start -->
    <div class="container-fluid">
        {{-- <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div> --}}
    </div>
    <div class="col-lg-6 text-center text-lg-right">
        {{-- <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div> --}}
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{ route('pembeli') }}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">Sisi Arloji</span></h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            {{-- <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form> --}}
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="{{ route('pembeli') }}" class="btn">
                <i class="fa fa-home text-primary"></i>
                <span class="badge">Home</span>
            </a>
            <a href="{{ route('belanja') }}" class="btn">
                <i class="fa fa-shopping-bag text-primary"></i>
                <span class="badge">Shop</span>
            </a>
            <a href="{{ route('checkout') }}" class="btn">
                <h4><i class="fas fa-shopping-cart text-primary"></i></h4>
            </a>
        </div>
    </div>
    </div>
    <!-- Topbar End -->

    <!-- Content start -->
    @yield('content')
    <!-- Content end -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="{{ route('pembeli') }}" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border border-white px-3 mr-1">Sisi Arloji</span></h1>
                </a>
                <p class="text-justify">Sisi Arloji merupakan toko yang menjual aksesoris seperti kacamata dan jam tangan, tetapi saat ini
                    dalam pengelolaannya masih dilakukan secara manual yaitu dengan datang langsung ke toko tersebut
                    untuk mengetahui informasI dan melakukan pemesanan khusuSnya pemesanan kacamata dan jam.</p>
                {{-- <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA
                </p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p> --}}
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Link</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="{{ route('pembeli') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="{{ route('belanja') }}"><i class="fa fa-angle-right mr-2"></i>Belanja</a>
                            <a class="text-dark mb-2" href="{{ route('checkout') }}"><i class="fa fa-angle-right mr-2"></i>Troli</a>
                            <a class="text-dark mb-2" href="{{ route('riwayat') }}"><i class="fa fa-angle-right mr-2"></i>Riwayat</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Lokasi</h5>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.0946103918614!2d108.29013371413917!3d-6.381788564197812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb8f0bec34e59%3A0x54b14775e30ff465!2sSisi%20Arloji!5e0!3m2!1sid!2sid!4v1668495189020!5m2!1sid!2sid"
                            width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                {{-- <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All
                    Rights
                    Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a>
                </p> --}}
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('gambar/payments.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->

    <!-- Main Footer -->
    @extends('components.footer')
    <!-- ./wrapper -->

    @extends('components.script')
</body>

</html>
