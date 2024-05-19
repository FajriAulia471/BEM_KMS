<div class="nav-mobile block lg:hidden md:hidden sm:hidden">

    <div class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 border shadow-xl border-gray-300 rounded-full bottom-4 left-1/2 "
        style="background-color: #FAF7F5">
        <div class="flex h-full max-w-lg mx-auto justify-around">
            <?php if ($_SESSION['login']['kementerian'] === "KOMINFO"): ?>
                <a href="../anggota/anggota.php" data-tooltip-target="tooltip-home" type="button"
                    class="inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50 group anggota transition-all duration-100 ease-in-out transform active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        class="humbleicons hi-users w-9 h-9 text-gray-500 <?php echo $_menuAktif === 'anggota' ? 'text-red-500' : ''; ?>">
                        <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M13 19v-1.25C13 15.679 11.081 14 8.714 14H7.286C4.919 14 3 15.679 3 17.75V19m12.286-5h1.428C19.081 14 21 15.679 21 17.75V19M15 5.17a3 3 0 110 5.659M11 8a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sr-only">Anggota</span>
                </a>

                <div id="tooltip-home" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-100 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip font-body">
                    Anggota
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            <?php endif; ?>

            <a href="../repository/repository.php" data-tooltip-target="tooltip-repository" type="button"
                class="inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50 group anggota transition-all duration-100 ease-in-out transform active:scale-90">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-archive w-9 h-9 text-gray-500 <?php echo $_menuAktif === 'repository' ? 'text-red-500' : ''; ?>">
                    <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2">
                        <path stroke-linejoin="round" d="M3 5a1 1 0 011-1h16a1 1 0 011 1v3H3V5z" />
                        <path stroke-linecap="round" d="M9.5 13h5" />
                        <path stroke-linejoin="round" d="M4 8h16v11a1 1 0 01-1 1H5a1 1 0 01-1-1V8z" />
                    </g>
                </svg>
                <span class="sr-only">Repository</span>
            </a>
            <div id="tooltip-repository" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-100 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip font-body">
                Repository
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            <a href="../forum/forum.php" data-tooltip-target="tooltip-forum" type="button"
                class="inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50 group anggota transition-all duration-100 ease-in-out transform active:scale-90">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-chats w-9 h-9 text-gray-500 <?php echo $_menuAktif === 'forum' ? 'text-red-500' : ''; ?>">
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
                <span class="sr-only">Forum Diskusi</span>
            </a>
            <div id="tooltip-forum" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-100 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip font-body">
                Forum Diskusi
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            <?php if ($_SESSION['login']['kementerian'] === "ADVOKASI" || $_SESSION['login']['kementerian'] === "KOMINFO"): ?>
                <a href="../aspirasi/aspirasi.php" data-tooltip-target="tooltip-aspirasi" type="button"
                    class="inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50 group anggota transition-all duration-100 ease-in-out transform active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        class="humbleicons hi-rocket w-9 h-9 text-gray-500 <?php echo $_menuAktif === 'aspirasi' ? 'text-red-500' : ''; ?>">
                        <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M15 14l2.045-1.533C19.469 10.648 20.542 6.98 20 4c-2.981-.542-6.649.531-8.467 2.955L10 9m5 5l-3.5 2.5-4-4L10 9m5 5v2.667a4 4 0 01-.8 2.4l-.7.933-1-1M10 9H7.333a4 4 0 00-2.4.8L4 10.5l1 1M8.5 18L5 19l1.166-3.5m9.334-6a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>
                    <span class="sr-only">Aspirasi</span>
                </a>
                <div id="tooltip-aspirasi" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-100 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip font-body">
                    Aspirasi
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            <?php endif; ?>

            <?php if ($_SESSION['login']['kementerian'] != "KOMINFO"): ?>
                <a href="../profile/profile.php" data-tooltip-target="tooltip-profile" type="button"
                    class="inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50 group anggota transition-all duration-100 ease-in-out transform active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        class="humbleicons hi-user w-9 h-9 text-gray-500 <?php echo $_menuAktif === 'profile' ? 'text-red-500' : ''; ?>">
                        <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M18 19v-1.25c0-2.071-1.919-3.75-4.286-3.75h-3.428C7.919 14 6 15.679 6 17.75V19m9-11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sr-only">Profile</span>
                </a>
                <div id="tooltip-profile" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-100 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip font-body">
                    Profile
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            <?php endif; ?>

        </div>

    </div>

</div>