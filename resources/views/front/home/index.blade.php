<x-client.layout>
    <header id="hero">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center text-lg-start">
                
                <section class="col-lg-7 animate-on-scroll fade-in-left">
                    <h1 class="header-1 color-navy fw-bold mb-0">Service Laptop</h1>
                    <h1 class="header-1 color-accent fw-bold mb-4">Cepat, Jujur, dan Bergaransi</h1>
                    <img src="{{ asset('images\HeroImage.png') }}" class="img-fluid d-lg-none hero-img" alt="Teknisi sedang bekerja">
                    <p class="body-1 color-navy fw-normal mb-4 ">Kami siap membantu mengatasi berbagai masalah pada perangkat Anda, mulai dari laptop standar hingga laptop gaming, dengan layanan profesional dan terpercaya. Percayakan kepada ahlinya!</p>
                    <a href="https://api.whatsapp.com/send/?phone=6287823330830&text&type=phone_number&app_absent=0" target="_blank" class="btn btn-secondary mb-2">
                        <i class="fab fa-whatsapp me-2"></i>Consult with Us
                    </a>
                </section>

                <section class="col-lg-5 d-none d-lg-block animate-on-scroll fade-in-right">
                    <img src="{{ asset('images\HeroImage.png') }}" class="img-fluid mb-32 mx-auto d-block hero-img" alt="Teknisi sedang bekerja">
                </section>

            </div>
        </div>
    </header>

    <section id="keunggulan">
        <div class="container">
            <h2 class="header-2 color-navy fw-bold mb-5 text-center">Kenapa Memilih Kami?</h2>
            <div class="row gy-4">
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="keunggulan-item-box animate-on-scroll fade-in-up">
                        <div class="keunggulan-ic-container flex-shrink-0 me-2 ">
                            <img src="{{ asset('images/garansi.png') }}" class="img-fluid" alt="garansi">
                        </div> 
                        <div>
                            <h3 class="body-1 color-navy fw-bold mb-2">Garansi Service</h3>
                            <p class="body-1 color-navy mb-0">Garansi hingga 30 hari setelah service.</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-3">
                    <div class="keunggulan-item-box animate-on-scroll fade-in-up delay-1">
                        <div class="keunggulan-ic-container flex-shrink-0 me-2 ">
                            <img src="{{ asset('images/teknisi.png') }}" class="img-fluid" alt="teknisi">
                        </div>
                        <div>
                            <h3 class="body-1 color-navy fw-bold mb-2">Teknisi Berpengalaman</h3>
                            <p class="body-1 color-navy mb-0">Dikerjakan oleh teknisi profesional.</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-3">
                    <div class="keunggulan-item-box animate-on-scroll fade-in-up delay-2">
                        <div class="keunggulan-ic-container flex-shrink-0 me-2">
                            <img src="{{ asset('images/gear.png') }}" class="img-fluid" alt="sparepart">
                        </div>
                        <div>
                            <h3 class="body-1 color-navy fw-bold mb-2">Sparepart Original</h3>
                            <p class="body-1 color-navy mb-0">Hanya menggunakan komponen original.</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-3">
                    <div class="keunggulan-item-box animate-on-scroll fade-in-up delay-3">
                        <div class="keunggulan-ic-container flex-shrink-0 me-2">
                            <img src="{{ asset('images/konsul.png') }}" class="img-fluid" alt="konsultasi">
                        </div>
                        <div>
                            <h3 class="body-1 color-navy fw-bold mb-2">Gratis Cek & Konsultasi</h3>
                            <p class="body-1 color-navy mb-0">Konsultasi bebas biaya, langsung WA.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan">
        <div class="container">
            <h2 class="header-2 color-navy fw-bold mb-2 text-center animate-on-scroll fade-in-up">Semua Kebutuhan Service dalam Satu Tempat</h2>
            <p class="body-1 color-navy fw-normal mb-5 text-center animate-on-scroll fade-in-up delay-1">Solusi lengkap untuk semua masalah perangkat elektronik Anda</p>

            <div class="glide-layanan animate-on-scroll fade-in-up delay-2">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <li class="glide__slide">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('images/hardware.png') }}" class="card-img-top" alt="Service Hardware">
                                <div class="card-body text-center">
                                    <h3 class="card-title header-4 color-navy fw-semibold mb-2">Service Hardware</h3>
                                    <p class="body-1-card color-navy">Ganti LCD, keyboard, upgrade RAM/SSD, dll.</p>
                                </div>
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('images/software.png') }}" class="card-img-top" alt="Service Software">
                                <div class="card-body text-center">
                                    <h3 class="card-title header-4 color-navy fw-semibold mb-2">Service Software</h3>
                                    <p class="body-1-card color-navy">Install ulang, recovery data, pasang antivirus.</p>
                                </div>
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('images/clean.png') }}" class="card-img-top" alt="Maintenance & Cleaning">
                                <div class="card-body text-center">
                                    <h3 class="card-title header-4 color-navy fw-semibold mb-2">Maintenance & Cleaning</h3>
                                    <p class="body-1-card color-navy">Bersihkan laptop dari debu, thermal paste, dll.</p>
                                </div>
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('images/printer.png') }}" class="card-img-top" alt="Service Printer & PC">
                                <div class="card-body text-center">
                                    <h3 class="card-title header-4 color-navy fw-semibold mb-2">Service Printer & PC</h3>
                                    <p class="body-1-card color-navy">Untuk printer rumah/kantor, juga PC rakitan.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div class="glide__bullets" data-glide-el="controls[nav]">
                    <button class="glide__bullet" data-glide-dir="=0"></button>
                    <button class="glide__bullet" data-glide-dir="=1"></button>
                    <button class="glide__bullet" data-glide-dir="=2"></button>
                    <button class="glide__bullet" data-glide-dir="=3"></button>
                </div>
            </div>
        </div>
    </section>
 
    <section id="alur" style="background-image: url('{{ asset('images/BGalur.png') }}');">
        <div class="container">
            <div class="row gx-4 gy-4 animate-on-scroll fade-in-left"> 
                <div class="col-lg-4">
                    <h2 class="header-2 color-neutral fw-bold mb-3">3 Langkah Mudah Layanan Kami</h2>
                    <p class="body-1 color-neutral fw-normal">Ikuti alur sederhana kami untuk mendapatkan layanan perbaikan yang cepat dan efisien.</p>
                </div>

                <div class="col-lg-8">
                    <div class="row aligm-items-start gx-4 gy-4">

                        <div class="col-md-4 mb-3 animate-on-scroll fade-in-up">
                            <div class="card border-0 text-center h-100">
                                <div class="card-body p-4">
                                    <div class="justify-content-center d-flex mb-2">
                                        <img src="{{ asset('images\konsultasi.png') }}" class="img-fluid mb-2" alt="konsultasi">
                                    </div>
                                    <h4 class="header-4 color-accent fw-semibold mb-3">Konsultasi Kerusakan</h4>
                                    <p class="body-1-card color-navy">Hubungi kami dan sampaikan masalah yang terjadi pada perangkat Anda</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 animate-on-scroll fade-in-up delay-1">
                            <div class="card border-0 text-center h-100">
                                <div class="card-body p-4">
                                    <div class="justify-content-center d-flex mb-2">
                                        <img src="{{ asset('images\pengerjaan.png') }}" class="img-fluid mb-2" alt="pengerjaan teknisi">
                                    </div>
                                    <h4 class="header-4 color-accent fw-semibold mb-3">Pengerjaan Teknisi</h4>
                                    <p class="body-1-card color-navy">Teknisi ahli kami akan segera menganalisa dan memperbaiki masalahnya.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 animate-on-scroll fade-in-up delay-2">
                            <div class="card border-0 text-center h-100">
                                <div class="card-body p-4">
                                    <div class="justify-content-center d-flex mb-2">
                                        <img src="{{ asset('images\selesai.png') }}" class="img-fluid mb-2" alt="unit siap diambil">
                                    </div>
                                    <h4 class="header-4 color-accent fw-semibold mb-3">Unit Siap Diambil</h4>
                                    <p class="body-1-card color-navy">Kami akan menghubungi Anda jika perangkat sudah selesai diperbaiki.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="proses">
        <div class="container">
            <div class="row gx-4 gy-4 justify-content-center">
                <div class="col-lg-6 col-md-6 animate-on-scroll fade-in-left">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h4 class="card-title header-4 color-navy fw-semibold mb-4 text-center">Lihat Proses Pengerjaan Teknisi Kami</h4>
                            <div class="embed-responsive embed-responsive-16by9 justify-content-center d-flex mb-2">
                                <iframe class="embed-responsive-item mb-3" src="https://www.youtube.com/embed/OBBMF_9oD5g?si=G8AqVrmW8rOFdgIJ" allowfullscreen></iframe>
                            </div>
                            <p class="body-1-card color-navy text-center mb-0">Video menunjukkan proses service laptop secara profesional dan transparan</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 animate-on-scroll fade-in-right">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h4 class="card-title header-4 color-navy fw-semibold mb-4 text-center">Lihat Proses Pengerjaan Teknisi Kami</h4>
                            <div class="embed-responsive embed-responsive-16by9 justify-content-center d-flex mb-2">
                                <iframe class="embed-responsive-item mb-3" src="https://www.youtube.com/embed/3edtMfPl_kM?si=InXH8nmx5KUx2XbN" allowfullscreen></iframe>
                            </div>
                            <p class="body-1-card color-navy text-center mb-0">Video menunjukkan proses service laptop secara profesional dan transparan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="promo">
        <div class="container">
            <h2 class="header-2 color-navy fw-bold mb-2 text-center">Promo Spesial Bulan Ini</h2>
            <p class="body-1 color-navy fw-normal mb-5 text-center">Penawaran Terbatas Untuk Anda!</p>
            <div class="row gx-4 gy-4 justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <div class="card shadow">
                        <img class="card-img-top" src="{{ asset('images\diskon1.png') }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="header-2 color-navy fw-bold text-center mb-3">Hemat hingga 20% untuk Maintenance Rutin</h4>
                            <p class="body-1-card color-navy text-center mb-3">Rawat laptop Anda secara berkala dan dapatkan diskon menarik untuk setiap kunjungan ke-2 dan seterusnya.</p>
                            <ul class="body-1-card color-navy mb-5">
                                <li>Pembersihan menyeluruh sistem</li>
                                <li>Update software terbaru</li>
                                <li>Optimasi performa</li>
                                <li>Garansi layanan 30 hari</li>
                            </ul>
                            <div class="d-grid">
                                <a href="#" class="btn btn-primary mb-0">Jadwalkan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="card shadow">
                        <img class="card-img-top" src="{{ asset('images\diskon2.png') }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="header-2 color-navy fw-bold mb-3 text-center">Voucher Khusus untuk Perusahaan</h4>
                            <p class="body-1-card color-navy mb-3 text-center">Kami menyediakan voucher service dan layanan on-site untuk kebutuhan kantor dan perusahaan Anda.</p>
                            <ul class="body-1-card color-navy mb-5">
                                <li>Layanan on-site gratis</li>
                                <li>Harga khusus untuk bulk service</li>
                                <li>Support teknis 24/7</li>
                                <li>Maintenance kontrak tahunan</li>
                            </ul>
                            <div class="d-grid">
                                <a href="#" class="btn btn-primary mb-0">Hubungi Tim Corporate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimoni"style="background-image: url('{{ asset('images/BGtesti.png') }}'); ">
        <div class="container">
            <h2 class="header-2 color-neutral fw-bold mb-5 text-center animate-on-scroll fade-in-up">Apa Kata Pelanggan Kami?</h2>

            <div class="glide-testimoni animate-on-scroll fade-in-up delay-1">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <li class="glide__slide">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('images/sari.png') }}" class="card-img-top" alt="Testimoni Sari">
                                <div class="card-body text-center">
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="card-title header-4 color-navy fw-semibold mb-1">Sari Indrawati</h4>
                                </div>
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('images/rizky.png') }}" class="card-img-top" alt="Testimoni Rizky">
                                <div class="card-body text-center">
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="card-title header-4 color-navy fw-semibold mb-1">Rizky Pratama</h4>
                                </div>
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('images/athar.png') }}" class="card-img-top" alt="Testimoni Athar">
                                <div class="card-body text-center">
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="card-title header-4 color-navy fw-semibold mb-1">Athar Hilman</h4>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fas fa-arrow-left"></i></button>
                    <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fas fa-arrow-right"></i></button>
                </div>
                <div class="glide__bullets" data-glide-el="controls[nav]">
                    <button class="glide__bullet" data-glide-dir="=0"></button>
                    <button class="glide__bullet" data-glide-dir="=1"></button>
                    <button class="glide__bullet" data-glide-dir="=2"></button>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang-kami">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6 d-none d-lg-block animate-on-scroll fade-in-left">
                    <img src="{{ asset('images\aboutUS.png') }}" class="img-fluid tim-img" alt="Tim Teknisi">
                </div>
                <div class="col-lg-6 animate-on-scroll fade-in-right">
                    <h2 class="header-2 color-navy fw-bold mb-3">Tentang Kami</h2>
                    <img src="{{ asset('images\aboutUS.png') }}" class="img-fluid d-lg-none tim-img mb-3" alt="Teknisi sedang bekerja">
                    <p class="body-1 color-navy">Kami adalah tim teknisi laptop profesional yang berdedikasi untuk memberikan layanan terbaik sejak 2010. Dengan pengalaman bertahun-tahun dan ribuan laptop yang telah kami tangani, kami mengutamakan kejujuran, transparansi, dan kualitas.</p>
                    <p class="body-1 color-navy">Kami percaya bahwa laptop Anda bukan sekadar alat kerja, tapi aset penting yang harus dijaga. Setiap perangkat memiliki cerita dan memori berharga bagi pemiliknya. Itulah mengapa kami memperlakukan setiap perbaikan dengan penuh perhatian dan profesionalisme.</p>
                    <p class="body-1 color-navy">Tim kami terdiri dari teknisi bersertifikat yang terus mengikuti perkembangan teknologi terbaru. Kami menggunakan alat diagnostik mutakhir dan komponen berkualitas tinggi untuk memastikan laptop Anda kembali berfungsi optimal.</p>
                    <ul class="body-1-card color-navy mb-3">
                        <li><b>Kejujuran - </b>Diagnosa masalah yang transparan tanpa biaya tersembunyi.</li>
                        <li><b>Profesionalisme - </b>Teknisi bersertifikasi dengan pelatihan berkala.</li>
                        <li><b>Garansi - </b>Jaminan 90 hari untuk setiap perbaikan.</li>
                        <li><b>Efisiensi - </b>Waktu perbaikan cepat tanpa mengorbankan kualitas.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="cta-penutup" style="background-image: url('{{ asset('images/BGalur.png') }}'); ">
        <div class="container text-center">
            <h1 class="header-2 fw-bold mb-4">Jangan tunggu kerusakan makin parah, segera hubungi kami sekarang!</h1>
            <a href="#kontak" class="btn btn-primary btn-lg ">Pesan Layanan
                <i class="fas fa-arrow-down"></i>
            </a>
        </div>
    </section>

    <section id="kontak">
        <div class="container">
            <h2 class="header-2 color-navy fw-bold mb-1 text-center">Hubungi Kami</h2>
            <p class="body-1 color-navy fw-normal mb-5 text-center">Hubungi kami untuk pemesanan layanan service atau kunjungi workshop kami untuk perbaikan langsung</p>
            <div class="row gy-5 justify-content-center">
                <div class="col-lg-5 animate-on-scroll fade-in-left">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="header-4 color-navy fw-semibold mb-5">Formulir Pemesanan Service</h3>
                            <form id="service-order-form" method="POST" action="{{ route('front.service-order.store') }}">
                                @csrf
                                <div class="body-1 color-navy mb-3">
                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" required placeholder="Contoh: Rizky Maulana">
                                    <div class="invalid-feedback" id="error-name"></div>
                                </div>
                                <div class="body-1 color-navy mb-3">
                                    <label for="phone" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control" id="phone" required placeholder="Contoh: 081234567890">
                                    <div class="invalid-feedback" id="error-phone"></div>
                                </div>
                                <div class="body-1 color-navy mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" required placeholder="Contoh: rizky@mail.com">
                                    <div class="invalid-feedback" id="error-email"></div>
                                </div>
                                <div class="body-1 color-navy mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" id="address" rows="3" required placeholder="Contoh: Jl. Melati No. 10, RT 03 RW 02, Bandung"></textarea>
                                    <div class="invalid-feedback" id="error-address"></div>
                                </div>
                                <div class="body-1 color-navy mb-3">
                                    <label for="brand" class="form-label">Merk Perangkat <span class="text-danger">*</span></label>
                                    <select name="brand" id="brand" class="form-select" required>
                                        <option value="">Pilih merk Perangkat</option>
                                        <option value="Asus">Asus</option>
                                        <option value="Acer">Acer</option>
                                        <option value="Lenovo">Lenovo</option>
                                        <option value="HP">HP</option>
                                        <option value="Dell">Dell</option>
                                        <option value="Toshiba">Toshiba</option>
                                        <option value="Samsung">Samsung</option>
                                        <option value="Apple">Apple (MacBook)</option>
                                        <option value="MSI">MSI</option>
                                        <option value="Alienware">Alienware</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <small class="form-text" style="color: #9ca3af; font-size: 0.8rem;">
                                        Merk perangkat Anda tidak ada dalam daftar? 
                                        <a href="https://api.whatsapp.com/send/?phone=6287823330830&text=Halo,%20merk%20laptop%20saya%20tidak%20ada%20dalam%20daftar.%20Apakah%20masih%20bisa%20diservice?" target="_blank" class="text-decoration-none" style="color: #16a085;">
                                            <i class="fab fa-whatsapp me-1"></i>Hubungi kami via WhatsApp
                                        </a>
                                    </small>
                                    <div class="invalid-feedback" id="error-brand"></div>
                                </div>
                                <div class="body-1 color-navy mb-3">
                                    <label for="model" class="form-label">Model / Series <span class="text-danger">*</span></label>
                                    <input type="text" name="model" class="form-control" id="model" required placeholder="Contoh: Vivobook A416MA">
                                    <div class="invalid-feedback" id="error-model"></div>
                                </div>
                                <div class="body-1 color-navy mb-3">
                                    <label for="serial_number" class="form-label">Nomor Seri Perangkat <span class="text-danger">*</span></label>
                                    <input type="text" name="serial_number" class="form-control" id="serial_number" required placeholder="Contoh: SN1234567890">
                                    <small class="form-text" style="color: #9ca3af; font-size: 0.8rem;">Biasanya terdapat di bagian bawah laptop atau dalam menu About This PC/Mac</small>
                                    <div class="invalid-feedback" id="error-serial_number"></div>
                                </div>
                                <div class="body-1 color-navy mb-3">
                                    <label for="reported_issue" class="form-label">Keluhan / Kerusakan <span class="text-danger">*</span></label>
                                    <textarea name="reported_issue" class="form-control" id="reported_issue" rows="3" required placeholder="Contoh: Laptop tiba-tiba mati total saat digunakan"></textarea>
                                    <small class="form-text" style="color: #9ca3af; font-size: 0.8rem;">Jelaskan sedetail mungkin masalah yang dialami</small>
                                    <div class="invalid-feedback" id="error-reported_issue"></div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" id="submit-btn">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Permintaan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 animate-on-scroll fade-in-right">
                    <h3 class="header-4 color-navy fw-semibold mb-4">Informasi Kontak</h3>
                    <div class="d-flex mb-3">
                        <i class="fab fa-whatsapp fa-2x color-accent me-2"></i>
                        <div>
                            <h4 class="header-4 color-navy fw-semibold mb-1">WhatsApp</h4>
                            <a href="https://wa.me/6281234567890" target="_blank" class="body-1-card text-decoration-none color-navy">+62 812-3456-7890</a>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="far fa-envelope fa-2x color-accent me-2"></i>
                        <div>
                            <h4 class="header-4 color-navy fw-semibold mb-1">Email</h4>
                            <p class="body-1-card color-navy mb-0">support@servicelaptop.com</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="fas fa-map-marker-alt fa-2x color-accent me-3"></i>
                        <div>
                            <h4 class="header-4 color-navy fw-semibold mb-1">Lokasi</h4>
                            <p class="body-1-card color-navy mb-3">
                                Jalan traktor 123 dekat cicukang belakang kantor PU ujung berung, Kec. Arcamanik, Kota Bandung, Jawa Barat 42094
                            </p>
                        </div>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8093.253222490186!2d107.67920589074849!3d-6.915002802991967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68dda5a21cc6bb%3A0xb7248e14780c4720!2sCV%20Lingkar%20Rasio%20Teknologi!5e0!3m2!1sid!2sid!4v1755229414217!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    
    @push('css')
        @vite(['resources/css/client/pages/home/styles.css'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Glide('.glide-layanan', {
                    type: 'carousel',
                    startAt: 0,
                    perView: 3,
                    gap: 5,
                    autoplay: 3500,
                    hoverpause: true,
                    breakpoints: {
                        992: { perView: 2 },
                        768: { perView: 1 }
                    }
                }).mount();

                new Glide('.glide-testimoni', {
                    type: 'carousel',
                    startAt: 0,
                    perView: 3,
                    gap: 5,
                    autoplay: 3500,
                    hoverpause: true,
                    breakpoints: {
                        992: { perView: 2 },
                        768: { perView: 1 }
                    }
                }).mount();
            });
            // Animasi On-Scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1 
            });

            const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');
            elementsToAnimate.forEach((el) => observer.observe(el));

            // Service Order Form Handler
            const serviceOrderForm = document.getElementById('service-order-form');
            const submitBtn = document.getElementById('submit-btn');

            if (serviceOrderForm) {
                serviceOrderForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Clear previous errors
                    clearErrors();
                    
                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Konfirmasi Pengiriman',
                        text: 'Apakah Anda yakin ingin mengirim permintaan service ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Ya, Kirim!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            submitForm();
                        }
                    });
                });
            }

            function submitForm() {
                // Disable submit button
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                
                // Get form data
                const formData = new FormData(serviceOrderForm);
                
                // Submit via AJAX
                fetch(serviceOrderForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 422) {
                            // Validation error
                            return response.json().then(errorData => {
                                throw { type: 'validation', errors: errorData.errors };
                            });
                        } else {
                            throw { type: 'server', message: 'Server error occurred' };
                        }
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            html: `
                                <p>${data.message}</p>
                                <p class="mt-2"><strong>Nomor Nota: ${data.nota_number}</strong></p>
                                <p class="text-muted">Simpan nomor nota ini untuk referensi Anda.</p>
                            `,
                            icon: 'success',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Reset form
                            serviceOrderForm.reset();
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat mengirim permintaan.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                    // Handle validation errors
                    if (error.type === 'validation') {
                        showValidationErrors(error.errors);
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan jaringan. Silakan coba lagi.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .finally(() => {
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Kirim Permintaan';
                });
            }

            function showValidationErrors(errors) {
                Object.keys(errors).forEach(field => {
                    const errorElement = document.getElementById(`error-${field}`);
                    const inputElement = document.getElementById(field) || document.querySelector(`[name="${field}"]`);
                    
                    if (errorElement && inputElement) {
                        errorElement.textContent = errors[field][0];
                        errorElement.style.display = 'block';
                        inputElement.classList.add('is-invalid');
                    }
                });
                
                // Scroll to first error
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }

            function clearErrors() {
                // Clear all error messages
                document.querySelectorAll('[id^="error-"]').forEach(element => {
                    element.textContent = '';
                    element.style.display = 'none';
                });
                
                // Remove invalid classes
                document.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
            }
        </script>
    @endpush
</x-client.layout>