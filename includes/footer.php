<footer class="footer">
    <div class="container-footer">
        <div class="footer-grid">  

            <div class="footer-col footer-info-col">
                <p class="company-name"><?= $lang['company_name_prefix'] ?></p>
                <h2 class="name-strong">The Green Life</h2>
                <p class="company-chairman"><strong><?= $lang['chairman'] ?></strong> Phó Quốc Duy</p>
            </div>

            <div class="footer-col footer-info-mid">
                <h4><?= $lang['contact_title'] ?></h4>
                <ul class="footer-contact">
                    <li>
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                            <circle cx="12" cy="9" r="2.5" />
                        </svg>
                        <span><strong><?= $lang['address'] ?></strong> <?= $lang['address_content'] ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 012 2.18 2 2 0 014 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16z" />
                        </svg>
                        <span><strong><?= $lang['phone'] ?></strong> 0939 660 004</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        <span><strong><?= $lang['email'] ?></strong> phoquocduyvn@gmail.com</span>
                    </li>
                </ul>
            </div>

            <div class="footer-col">
                <h4><?= $lang['categories'] ?></h4>
                <ul class="footer-links">
                    <li><a href="about-us.php"><?= $lang['about_us'] ?></a></li>
                    <li><a href="grain-trading.php"><?= $lang['business_areas'] ?></a></li>
                    <li><a href=""><?= $lang['typical_products'] ?></a></li>
                    <li><a href=""><?= $lang['news_events'] ?></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 <?= $lang['copyright'] ?></p>
    </div>
</footer>