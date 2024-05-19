<div class="nav-dekstop hidden lg:block md:block sm:block">
    <nav class=" border-gray-200 rounded-b-lg shadow-xl" style="background-color: #FAF7F5">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-start gap-5 mx-auto p-4">
            <!-- drawer init and show -->
            <div class="text-center">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-bars h-7 w-7 transition-all duration-300 ease-in-out transform active:scale-90 text-header"
                    type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                    aria-controls="drawer-navigation">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

            </div>
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../assets/img/bem.webp" class="h-8" alt="BEM Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-header font-header">BEM Kabinet
                    Samarathata</span>
            </a>

        </div>

    </nav>

    <!-- drawer component -->
    <div id="drawer-navigation"
        class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64"
        tabindex="-1" aria-labelledby="drawer-navigation-label">
        <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase font-body">Menu
        </h5>
        <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                class="humbleicons hi-times h-6 w-6 transition-all duration-300 ease-in-out transform active:scale-90">
                <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                    <path d="M6 18L18 6M18 18L6 6" />
                </g>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <?php if ($_SESSION['login']['kementerian'] == "KOMINFO"): ?>
                    <li>
                        <a href="../dashboard/dashboard.php"
                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                class="humbleicons hi-dashboard h-8 w-8 text-header">
                                <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2"
                                    d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zm10-3a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z" />
                            </svg>
                            <span
                                class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-header font-header <?php echo $_menuAktif === 'dashboard' ? 'text-red-500' : 'text-secondary'; ?>">
                                Dashboard
                            </span>


                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($_SESSION['login']['kementerian'] == "KOMINFO"): ?>
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                            aria-controls="dropdown-example-1" data-collapse-toggle="dropdown-example-1">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                class="humbleicons hi-users h-8 w-8 text-header">
                                <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"
                                    d="M13 19v-1.25C13 15.679 11.081 14 8.714 14H7.286C4.919 14 3 15.679 3 17.75V19m12.286-5h1.428C19.081 14 21 15.679 21 17.75V19M15 5.17a3 3 0 110 5.659M11 8a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span
                                class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-header font-header <?php echo $_menuAktif === 'anggota' ? 'text-red-500' : 'text-secondary'; ?>">Anggota</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                class="humbleicons hi-chevron-down h-5 w-5 text-secondary group-hover:text-header">
                                <path xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-width="2"
                                    d="M5 10l7 7 7-7" />
                            </svg>
                        </button>
                        <ul id="dropdown-example-1" class="hidden py-2 space-y-2">
                            <li>
                                <a href="../anggota/anggota.php"
                                    class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group  font-body <?php echo $_submenuAktif === 'lihat_anggota' ? 'text-red-500' : 'text-secondary'; ?>">Daftar
                                    Anggota</a>
                            </li>
                            <li>
                                <a href="../anggota/add.php"
                                    class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group  font-body <?php echo $_submenuAktif === 'tambah_anggota' ? 'text-red-500' : 'text-secondary'; ?>">Tambah
                                    Anggota</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                        aria-controls="dropdown-example-2" data-collapse-toggle="dropdown-example-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-archive h-8 w-8 text-header">
                            <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2">
                                <path stroke-linejoin="round" d="M3 5a1 1 0 011-1h16a1 1 0 011 1v3H3V5z" />
                                <path stroke-linecap="round" d="M9.5 13h5" />
                                <path stroke-linejoin="round" d="M4 8h16v11a1 1 0 01-1 1H5a1 1 0 01-1-1V8z" />
                            </g>
                        </svg>
                        <span
                            class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-header font-header <?php echo $_menuAktif === 'repository' ? 'text-red-500' : 'text-secondary'; ?>">Repository</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-chevron-down h-5 w-5 text-secondary group-hover:text-header">
                            <path xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-width="2"
                                d="M5 10l7 7 7-7" />
                        </svg>

                    </button>
                    <ul id="dropdown-example-2" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../repository/repository.php"
                                class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group  font-body <?php echo $_submenuAktif === 'lihat_repository' ? 'text-red-500' : 'text-secondary'; ?>">Daftar
                                Repository</a>
                        </li>
                        <li>
                            <a href="../repository/add.php"
                                class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group  font-body <?php echo $_submenuAktif === 'tambah_repository' ? 'text-red-500' : 'text-secondary'; ?>">Tambah
                                Repository</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                        aria-controls="dropdown-example-3" data-collapse-toggle="dropdown-example-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-chats h-8 w-8 text-header">
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9.882 15C13.261 15 16 12.538 16 9.5S13.261 4 9.882 4C6.504 4 3.765 6.462 3.765 9.5c0 .818.198 1.594.554 2.292L3 15l3.824-.736c.9.468 1.944.736 3.058.736z" />
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M10.804 18.124a6.593 6.593 0 003.314.876 6.623 6.623 0 003.059-.736L21 19l-1.32-3.208a5.02 5.02 0 00.555-2.292c0-1.245-.46-2.393-1.235-3.315-.749-.89-1.792-1.569-3-1.92" />
                            <circle xmlns="http://www.w3.org/2000/svg" r="1" fill="currentColor"
                                transform="matrix(-1 0 0 1 13 9.5)" />
                            <circle xmlns="http://www.w3.org/2000/svg" r="1" fill="currentColor"
                                transform="matrix(-1 0 0 1 10 9.5)" />
                            <circle xmlns="http://www.w3.org/2000/svg" r="1" fill="currentColor"
                                transform="matrix(-1 0 0 1 7 9.5)" />
                        </svg>
                        <span
                            class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-header font-header <?php echo $_menuAktif === 'forum' ? 'text-red-500' : 'text-secondary'; ?>">Forum
                            Diskusi</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-chevron-down h-5 w-5 text-secondary group-hover:text-header">
                            <path xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-width="2"
                                d="M5 10l7 7 7-7" />
                        </svg>

                    </button>
                    <ul id="dropdown-example-3" class="hidden py-2 space-y-2">
                        <li>
                            <a href="../forum/forum.php"
                                class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group font-body <?php echo $_submenuAktif === 'lihat_forum' ? 'text-red-500' : 'text-secondary'; ?>">Daftar
                                Forum</a>
                        </li>
                        <li>
                            <a href="../forum/add.php"
                                class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group  font-body <?php echo $_submenuAktif === 'tambah_topik' ? 'text-red-500' : 'text-secondary'; ?> ">Tambah
                                Topik</a>
                        </li>
                    </ul>
                </li>

                <?php if ($_SESSION['login']['kementerian'] === "ADVOKASI" || $_SESSION['login']['kementerian'] === "KOMINFO"): ?>
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                            aria-controls="dropdown-example-4" data-collapse-toggle="dropdown-example-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                class="humbleicons hi-rocket h-8 w-8 text-header">
                                <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"
                                    d="M15 14l2.045-1.533C19.469 10.648 20.542 6.98 20 4c-2.981-.542-6.649.531-8.467 2.955L10 9m5 5l-3.5 2.5-4-4L10 9m5 5v2.667a4 4 0 01-.8 2.4l-.7.933-1-1M10 9H7.333a4 4 0 00-2.4.8L4 10.5l1 1M8.5 18L5 19l1.166-3.5m9.334-6a1 1 0 100-2 1 1 0 000 2z" />
                            </svg>
                            <span
                                class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-header font-header <?php echo $_menuAktif === 'Aspirasi' ? 'text-red-500' : 'text-secondary'; ?>">Proses
                                Aspirasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                class="humbleicons hi-chevron-down h-5 w-5 text-secondary group-hover:text-header">
                                <path xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-width="2"
                                    d="M5 10l7 7 7-7" />
                            </svg>

                        </button>
                        <ul id="dropdown-example-4" class="hidden py-2 space-y-2">
                            <li>
                                <a href="../aspirasi/aspirasi.php"
                                    class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group  font-body <?php echo $_submenuAktif === 'lihat_aspirasi' ? 'text-red-500' : 'text-secondary'; ?>">Aspirasi
                                    Mahasiswa</a>
                            </li>
                            <li>
                                <a href="../aspirasi/add.php"
                                    class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group  font-body <?php echo $_submenuAktif === 'tambah_asirasi' ? 'text-red-500' : 'text-secondary'; ?> ">Tambah
                                    Aspirasi</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="../profile/profile.php"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-user h-8 w-8 text-header">
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M18 19v-1.25c0-2.071-1.919-3.75-4.286-3.75h-3.428C7.919 14 6 15.679 6 17.75V19m9-11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span
                            class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap group-hover:text-header font-header <?php echo $_menuAktif === 'profile' ? 'text-red-500' : 'text-secondary'; ?>">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="../auth/logout.php"
                        class="flex items-center w-full p-2 text-base text-rose-500 transition duration-75 rounded-lg group hover:bg-rose-100"
                        onclick="return confirm('Apakah yakin ingin melakukan logout?')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-logout  h-8 w-8 text-rose-600">
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M20 12h-9.5m7.5 3l3-3-3-3m-5-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h5a2 2 0 002-2v-1" />
                        </svg>
                        <span
                            class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap text-rose-500 font-header">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>