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
                    <li><a href="products.php"><?= $lang['typical_products'] ?></a></li>
                    <li><a href="news.php"><?= $lang['news_events'] ?></a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4><?= $lang['social_title'] ?></h4>
                <ul class="footer-links footer-social-links">
                    <li>
                        <a href="https://www.tiktok.com" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" class="social-svg"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                            <?= $lang['social_tiktok'] ?>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" class="social-svg"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            <?= $lang['social_fanpage'] ?>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" class="social-svg"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            <?= $lang['social_youtube'] ?>
                        </a>
                    </li>
                    <li>
                        <a href="https://zalo.me" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" class="social-svg"><path d="M2.5 2.5h7.6c2.7 0 4.9 2.2 4.9 4.9s-2.2 4.9-4.9 4.9H6.3v4.4l-3.8-4.4v-2.4c0-4.1 3.4-7.4 7.5-7.4h7.5c4.1 0 7.5 3.3 7.5 7.4s-3.3 7.4-7.4 7.4H15v-3.5h2.6c2.1 0 3.9-1.7 3.9-3.9s-1.7-3.9-3.9-3.9H10c-2.4 0-4.3 1.9-4.3 4.3v1.5H2.5V2.5z"/></svg>
                            <?= $lang['social_zalo'] ?>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 <?= $lang['copyright'] ?></p>
    </div>
</footer>