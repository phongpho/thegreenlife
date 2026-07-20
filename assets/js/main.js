document.addEventListener('DOMContentLoaded', function () {

    var header = document.getElementById('siteHeader');
    var toggleBtn = document.getElementById('navbarToggle');
    var menu = document.getElementById('navbarMenu');

    // --- 1. Mở / đóng menu mobile ---
    if (toggleBtn && menu) {
        toggleBtn.addEventListener('click', function () {
            var isOpen = menu.classList.toggle('is-open');
            toggleBtn.classList.toggle('is-open', isOpen);
            toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    // --- 2. Mở / đóng dropdown "Lĩnh vực hoạt động" khi chạm (mobile) ---
    var dropdownToggles = document.querySelectorAll('.has-dropdown > .dropdown-toggle');
    dropdownToggles.forEach(function (link) {
        link.addEventListener('click', function (e) {
            // Chỉ áp dụng hành vi "chạm để mở" ở màn hình nhỏ (menu mobile đang mở)
            if (window.innerWidth <= 992) {
                e.preventDefault();
                var parentLi = link.closest('.has-dropdown');
                var isOpen = parentLi.classList.toggle('is-open');

                // Đóng các dropdown khác đang mở
                document.querySelectorAll('.has-dropdown.is-open').forEach(function (openLi) {
                    if (openLi !== parentLi) {
                        openLi.classList.remove('is-open');
                    }
                });
            }
        });
    });

    // --- 3. Đóng menu mobile khi resize về desktop ---
    window.addEventListener('resize', function () {
        if (window.innerWidth > 992 && menu) {
            menu.classList.remove('is-open');
            toggleBtn.classList.remove('is-open');
            toggleBtn.setAttribute('aria-expanded', 'false');
            document.querySelectorAll('.has-dropdown.is-open').forEach(function (li) {
                li.classList.remove('is-open');
            });
        }
    });

    // --- 4. Thu nhỏ navbar khi cuộn trang ---
    if (header) {
        var onScroll = function () {
            if (window.scrollY > 40) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
        };
        window.addEventListener('scroll', onScroll);
        onScroll();
    }

    // --- 5. Banner slider tự động đọc ảnh từ PHP ---
    var BANNER_AUTOPLAY_DELAY = 15000; // 👉 Chỉnh thời gian tự chuyển ảnh ở đây (đơn vị: mili giây, 5000 = 5 giây)

    var bannerSection = document.getElementById('bannerSection');
    var bannerPrev = document.getElementById('bannerPrev');
    var bannerNext = document.getElementById('bannerNext');
    var bannerImages = [];
    if (bannerSection && bannerSection.dataset.bannerImages) {
        try {
            bannerImages = JSON.parse(bannerSection.dataset.bannerImages);
        } catch (e) {
            bannerImages = [];
        }
    }
    var currentBannerIndex = 0;
    var bannerAutoplayTimer = null;

    function updateBannerImage() {
        if (!bannerSection || bannerImages.length === 0) {
            return;
        }
        bannerSection.style.backgroundImage = 'url("' + bannerImages[currentBannerIndex] + '")';
    }

    function showNextBanner() {
        if (bannerImages.length === 0) return;
        currentBannerIndex = (currentBannerIndex + 1) % bannerImages.length;
        updateBannerImage();
    }

    function showPrevBanner() {
        if (bannerImages.length === 0) return;
        currentBannerIndex = (currentBannerIndex - 1 + bannerImages.length) % bannerImages.length;
        updateBannerImage();
    }

    function startBannerAutoplay() {
        if (bannerImages.length <= 1) return; // chỉ 1 ảnh thì không cần tự chuyển
        bannerAutoplayTimer = setInterval(showNextBanner, BANNER_AUTOPLAY_DELAY);
    }

    function restartBannerAutoplay() {
        if (bannerAutoplayTimer) {
            clearInterval(bannerAutoplayTimer);
        }
        startBannerAutoplay();
    }

    if (bannerSection) {
        updateBannerImage();
        startBannerAutoplay();
    }

    if (bannerPrev) {
        bannerPrev.addEventListener('click', function () {
            showPrevBanner();
            restartBannerAutoplay(); // bấm tay xong thì đếm lại giờ, tránh vừa bấm xong lại tự nhảy tiếp
        });
    }

    if (bannerNext) {
        bannerNext.addEventListener('click', function () {
            showNextBanner();
            restartBannerAutoplay();
        });
    }


    // --- 6. Agriculture product gallery slider ---
    var productsScroll = document.querySelector('.products-scroll');
    var productsTrack = document.querySelector('.products-scroll .products');
    var prevAgriBtn = document.querySelector('.products-nav--prev');
    var nextAgriBtn = document.querySelector('.products-nav--next');

    if (productsScroll && productsTrack && prevAgriBtn && nextAgriBtn) {
        var productItems = productsTrack.querySelectorAll('.product');
        var agriAnimating = false;

        function getAgriScrollAmount() {
            if (productItems.length === 0) return 0;
            var gap = parseFloat(window.getComputedStyle(productsTrack).gap) || 0;
            return productItems[0].offsetWidth + gap;
        }

        function updateAgriNavButtons() {
            var scrollLeft = productsScroll.scrollLeft;
            var maxScroll = productsScroll.scrollWidth - productsScroll.clientWidth;
            prevAgriBtn.style.opacity = scrollLeft <= 0 ? '0.3' : '1';
            prevAgriBtn.style.pointerEvents = scrollLeft <= 0 ? 'none' : 'auto';
            nextAgriBtn.style.opacity = scrollLeft >= maxScroll - 1 ? '0.3' : '1';
            nextAgriBtn.style.pointerEvents = scrollLeft >= maxScroll - 1 ? 'none' : 'auto';
        }

        nextAgriBtn.addEventListener('click', function () {
            if (agriAnimating) return;
            agriAnimating = true;
            var amount = getAgriScrollAmount();
            productsScroll.scrollBy({ left: amount, behavior: 'smooth' });
            setTimeout(function () {
                agriAnimating = false;
                updateAgriNavButtons();
            }, 500);
        });

        prevAgriBtn.addEventListener('click', function () {
            if (agriAnimating) return;
            agriAnimating = true;
            var amount = getAgriScrollAmount();
            productsScroll.scrollBy({ left: -amount, behavior: 'smooth' });
            setTimeout(function () {
                agriAnimating = false;
                updateAgriNavButtons();
            }, 500);
        });

        productsScroll.addEventListener('scroll', updateAgriNavButtons);
        updateAgriNavButtons();
    }

    // --- 7. Product slider — state transition (no scroll, class swap only) ---
    var productTrack = document.getElementById('productSlider');
    var prevProdBtn = document.getElementById('prevProduct');
    var nextProdBtn = document.getElementById('nextProduct');

    if (productTrack && prevProdBtn && nextProdBtn) {
        var LOCK_TIME = 700;
        var locked = false;
        var items = productTrack.querySelectorAll('.products-item');
        var totalItems = items.length;

        function assignPositions() {
            var all = productTrack.querySelectorAll('.products-item');
            for (var i = 0; i < all.length; i++) {
                all[i].classList.remove('is-left', 'is-center', 'is-right');
            }
            if (all.length >= 3) {
                all[0].classList.add('is-left');
                all[1].classList.add('is-center');
                all[2].classList.add('is-right');
            } else if (all.length >= 1) {
                all[0].classList.add('is-center');
            }
        }

        function initSlider() {
            if (totalItems < 2) { assignPositions(); return; }
            // move last card before first so product-1 sits at index 1
            var last = productTrack.lastElementChild;
            productTrack.insertBefore(last, productTrack.firstElementChild);
            assignPositions();
        }

        function slideNext() {
            if (locked || totalItems < 2) return;
            locked = true;

            var all = productTrack.querySelectorAll('.products-item');
            for (var i = 0; i < all.length; i++) {
                all[i].classList.remove('is-left', 'is-center', 'is-right');
            }
            productTrack.appendChild(all[0]);
            assignPositions();

            setTimeout(function () { locked = false; }, LOCK_TIME);
        }

        function slidePrev() {
            if (locked || totalItems < 2) return;
            locked = true;

            var all = productTrack.querySelectorAll('.products-item');
            for (var i = 0; i < all.length; i++) {
                all[i].classList.remove('is-left', 'is-center', 'is-right');
            }
            var last = all[all.length - 1];
            productTrack.insertBefore(last, productTrack.firstElementChild);
            assignPositions();

            setTimeout(function () { locked = false; }, LOCK_TIME);
        }

        initSlider();
        nextProdBtn.addEventListener('click', slideNext);
        prevProdBtn.addEventListener('click', slidePrev);
    }

});