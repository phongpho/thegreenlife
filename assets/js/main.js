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
    var BANNER_AUTOPLAY_DELAY = 5000; // 👉 Chỉnh thời gian tự chuyển ảnh ở đây (đơn vị: mili giây, 5000 = 5 giây)

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

    // --- 7. Slider chuyển qua lại (Fix lỗi lẹm trái do khoảng trống Gap) ---
    var productTrack = document.getElementById('productSlider');
    var prevProdBtn = document.getElementById('prevProduct');
    var nextProdBtn = document.getElementById('nextProduct');

    if (productTrack && prevProdBtn && nextProdBtn) {
        let isAnimating = false; // Khóa nút khi đang chạy hiệu ứng

        // Kỹ thuật trượt tới (Next)
        nextProdBtn.addEventListener('click', function () {
            if (isAnimating) return;
            isAnimating = true;

            var firstItem = productTrack.firstElementChild;
            // Tính chính xác chiều rộng thẻ + khoảng hở (gap)
            var gap = parseFloat(window.getComputedStyle(productTrack).gap) || 0;
            var scrollAmount = firstItem.offsetWidth + gap; 

            // 1. Trượt mượt mà tới thẻ tiếp theo
            productTrack.scrollBy({ left: scrollAmount, behavior: 'smooth' });

            // 2. Đợi trượt xong rồi tráo DOM
            setTimeout(function() {
                // Tắt hiệu ứng để giấu việc tráo thẻ
                productTrack.style.scrollBehavior = 'auto';
                productTrack.style.scrollSnapType = 'none';

                // Ném thẻ đầu xuống cuối
                productTrack.appendChild(firstItem);
                
                // Do thẻ số 2 đã được đẩy lên vị trí đầu tiên, ta reset trục cuộn về đúng 0
                productTrack.scrollLeft = 0;

                void productTrack.offsetWidth; // Bắt trình duyệt vẽ lại (reflow)

                // Bật lại hiệu ứng mượt
                productTrack.style.scrollBehavior = 'smooth';
                productTrack.style.scrollSnapType = 'x mandatory';
                
                isAnimating = false; 
            }, 500); 
        });

        // Kỹ thuật trượt lùi (Prev)
        prevProdBtn.addEventListener('click', function () {
            if (isAnimating) return;
            isAnimating = true;

            var lastItem = productTrack.lastElementChild;
            var gap = parseFloat(window.getComputedStyle(productTrack).gap) || 0;
            var scrollAmount = lastItem.offsetWidth + gap;

            // 1. Tắt hiệu ứng để âm thầm bốc thẻ cuối lên đầu tiên
            productTrack.style.scrollBehavior = 'auto';
            productTrack.style.scrollSnapType = 'none';
            
            productTrack.insertBefore(lastItem, productTrack.firstElementChild);
            
            // Neo thanh cuộn ở vị trí hiện tại ảo để giao diện không bị giật
            productTrack.scrollLeft = scrollAmount; 

            void productTrack.offsetWidth; // Reflow

            // 2. Bật lại hiệu ứng mượt
            productTrack.style.scrollBehavior = 'smooth';
            productTrack.style.scrollSnapType = 'x mandatory';
            
            // 3. Thực hiện kéo mượt về vị trí 0 (thẻ vừa được chèn lên đầu)
            setTimeout(function() {
                productTrack.scrollTo({ left: 0, behavior: 'smooth' });
                
                setTimeout(function() {
                    isAnimating = false;
                }, 500);
            }, 20);
        });
    }

});