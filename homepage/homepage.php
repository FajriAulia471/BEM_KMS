<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BEM | KMS</title>
  <link rel="icon" href="../assets/img/bem.webp" type="image/x-icon" />
  <link rel="shortcut icon" href="../assets/img/bem.webp" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Ubuntu:wght@300;400;500;700&family=Figtree:wght@300..900&display=swap"
    rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link href="../build.css" rel="stylesheet" />
</head>

<body>
  <!-- Nav :Start -->
  <nav class="bg-primary border-gray-200 container mx-auto">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://bem-amikompurwokerto.my.id/" class="flex items-center space-x-3">
        <img src="../assets/img/bem.webp" class="h-8" alt="Amikom Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-header font-fancy">BEM | KMS</span>
      </a>
      <div class="flex md:order-2 space-x-3 md:space-x-0">
        <a href="../auth/login.php"
          class="text-white font-body bg-header font-medium rounded-full text-sm px-4 py-2 text-center transition-all duration-100 ease-in-out transform active:scale-90">SIGN
          IN</a>
      </div>
    </div>
  </nav>
  <!-- Nav :End -->

  <!-- Hero Section :Start -->
  <section id="hero">
    <div class="container flex flex-col-reverse items-center px-6 mx-auto mt-10 space-y-0 md:space-y-0 md:flex-row">
      <div class="flex flex-col mb-30 space-y-6 md:w-1/2">
        <h1 class="max-w-md text-4xl font-black text-center md:text-5xl md:text-left font-fancy text-header">
          Badan Eksekutif Mahasiswa
        </h1>
        <p class="max-w-md text-2xl text-center font-header leading-relaxed font-bold md:text-left text-fuchsia-900">
          Universitas Amikom Purwokerto
        </p>
        <div class="flex justify-center md:justify-start">
          <a href="#"
            class="p-3 px-6 pt-2 text-white font-body font-medium bg-header rounded-full baseline transition-all duration-300 ease-in-out transform active:scale-90">Get
            Started</a>
        </div>
      </div>
      <div class="md:w-1/2">
        <img src="../assets/img/amikom.png" alt=""
          class="w-3/4 mx-auto mb-16 transition-all duration-100 ease-in-out transform active:scale-90" />
      </div>
    </div>
  </section>
  <!-- Hero Section :End -->

  <!-- About Section :Start -->
  <section id="about" class="bg-header">
    <div class="container p-8 mx-auto my-4">
      <h2
        class="max-w-md font-fancy text-white font-black text-4xl text-center md:text-left leading-relaxed tracking-wider">
        Tentang Kami!
      </h2>
      <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
        <div class="flex items-center justify-center">
          <img src=" ../assets/img/bem.webp" class="p-6" width="300" height="300" alt="bem" />
        </div>
        <div class="flex flex-col items-start justify-center">
          <h3 class="font-body text-3xl my-2 font-semibold text-rose-500">
            Kabinet Samarthata
          </h3>
          <p class="mb-8 font-body text-xl font-medium text-white leading-relaxed text-justify">
            Samarthata berarti 'kemampuan' atau 'kualifikasi'. Dengan akhiran
            '-ta', kata ini menjadi kata benda yang menunjukkan sifat atau
            keadaan. Nama Kabinet Samarthata diharapkan mencerminkan BEM yang
            mampu merealisasikan visi misi dan menjadi
            <i>support system</i> bagi internal BEM, UKM, ORMAWA, serta
            mahasiswa dalam segala situasi.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- About Section :End -->

  <!-- Kabinet Section :Start -->
  <section id="kabinet" class="mb-10 bg-primary">
    <h2 class="font-fancy text-header font-black text-4xl text-center leading-relaxed tracking-wider">
      Visi & Misi
    </h2>
    <div class="container flex flex-col px-4 mx-auto space-y-12 md:space-y-0 md:flex-row">
      <div class="flex flex-col md:w-1/2">
        <h3 class="font-fancy text-brightRed font-black text-2xl text-center leading-relaxed tracking-wider">
          Visi
        </h3>
        <div class="font-body text-xl text-semibold text-header text-justify">
          <p class="px-2">
            Mewujudkan organisasi kampus di Universitas Amikom Purwokerto yang
            demokratis serta menjadi <i>support system</i> yang bersinergi,
            efisien, efektif dan kolaboratif.
          </p>
        </div>
      </div>

      <div class="flex flex-col md:w-1/2 bg-brightRed rounded-xl">
        <h3 class="font-fancy text-header font-bold text-2xl text-center leading-relaxed tracking-wider">
          Misi
        </h3>
        <div>
          <ul class="space-y-1 list-inside font-body text-xl text-semibold text-white px-4 pb-4">
            <li class="flex items-start">
              <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="500"
                colors="primary:#291334" class="flex-shrink-0 w-6 h-6 me-2">
              </lord-icon>
              <p class="text-justify">
                Menginternalisasi nilai 3s (<i>Support System to People</i>,
                <i>Support System to Time</i>,
                <i>Support System to System</i>).
              </p>
            </li>

            <li class="flex items-start">
              <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="500"
                colors="primary:#291334" class="flex-shrink-0 w-6 h-6 me-2">
              </lord-icon>

              <p class="text-justify">
                Mempererat hubungan Unit Kegiatan Mahasiswa (UKM), Organisasi
                Mahasiswa (ORMAWA) dan Lembaga yang ada di Universitas Amikom
                Purwokerto.
              </p>
            </li>

            <li class="flex items-start">
              <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="500"
                colors="primary:#291334" class="flex-shrink-0 w-6 h-6 me-2">
              </lord-icon>
              <p class="text-justify">
                Mewujudkan BEM sebagai salah satu wadah dan pelaksana aspirasi
                bagi para mahasiswa.
              </p>
            </li>

            <li class="flex items-start">
              <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="500"
                colors="primary:#291334" class="flex-shrink-0 w-6 h-6 me-2">
              </lord-icon>
              <p class="text-justify">
                Mengoptimalisasi program kerja yang sudah ada serta
                meningkatkan kualitas sumber daya anggota Unit Kegiatan
                Mahasiswa(UKM), Organisasi Mahasiswa(ORMAWA) ataupun
                mahasiswa.
              </p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="cta" class="bg-header">
    <div
      class="container flex flex-col items-center justify-between px-6 py-4 mx-auto space-y-12 md:py-1 md:flex-row md:space-y-0">
      <h2 class="text-5xl font-black text-center font-fancy text-white md:text-4xl md:max-w-xl md:text-left text-image"
        style="
            background: url('../assets/img/bg.jpg') no-repeat;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: cover;
          ">
        BEM KABINET SAMARTHATA
      </h2>
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
</body>

</html>