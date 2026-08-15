<footer class="footer">

    <div class="container footer-grid">

        <!-- School Info -->

        <div class="footer-brand">

          <img
    src="<?= !empty($settings['logo'])
        ? '/srs/uploads/settings/' . htmlspecialchars($settings['logo'])
        : '/srs/assets/images/logo.png'; ?>"
    alt="<?= htmlspecialchars($settings['school_name']); ?>"
    class="school-logo">
    
          <h3><?= htmlspecialchars($settings['school_name']); ?></h3>

           <p><?= htmlspecialchars($settings['tagline']); ?></p>

        </div>

        <!-- Quick Links -->

        <div class="footer-links">

            <h4>Quick Links</h4>

            <ul>

                <li><a href="/srs/">Home</a></li>

                <li><a href="/srs/about">About</a></li>

                <li><a href="/srs/admission">Admission</a></li>

                <li><a href="/srs/gallery">Gallery</a></li>

                <li><a href="/srs/contact">Contact</a></li>

            </ul>

        </div>

        <!-- Contact -->

        <div class="footer-contact">

            <h4>Contact Us</h4>

           <p>

<i class="fa-solid fa-location-dot"></i>

<?= nl2br(htmlspecialchars($settings['address'])); ?>

</p>

          <?php

$phones = preg_split('/\R/', trim($settings['phone']));

foreach ($phones as $phone):

    if (trim($phone) === '') continue;

?>

<p>

<a href="tel:<?= htmlspecialchars(trim($phone)); ?>">

<i class="fa-solid fa-phone"></i>

<?= htmlspecialchars(trim($phone)); ?>

</a>

</p>

<?php endforeach; ?>

        <?php

$emails = preg_split('/\R/', trim($settings['email']));

foreach ($emails as $email):

    if (trim($email) === '') continue;

?>

<p>

<a href="mailto:<?= htmlspecialchars(trim($email)); ?>">

<i class="fa-solid fa-envelope"></i>

<?= htmlspecialchars(trim($email)); ?>

</a>

</p>

<?php endforeach; ?>

            <!-- Social Icons -->

            <div class="social-links">

                <a href="YOUR_WHATSAPP_LINK"
                   target="_blank"
                   class="whatsapp">

                    <i class="fa-brands fa-whatsapp"></i>

                </a>

                <a href="<?= htmlspecialchars($settings['facebook']); ?>"
                   target="_blank"
                   class="facebook">

                    <i class="fa-brands fa-facebook-f"></i>

                </a>

         <!-------       <a href="<?= htmlspecialchars($settings['instagram']); ?>"
                   target="_blank"
                   class="instagram">

                    <i class="fa-brands fa-instagram"></i>

                </a>---->
                <a
href="<?= htmlspecialchars($settings['youtube']); ?>"
target="_blank">

<i class="fa-brands fa-youtube"></i>

</a>

            </div>

        </div>

    </div>

    <div class="copyright">

        © <?php echo date('Y'); ?>

        Sone Rising School | All Rights Reserved | Designed & Developed by
      <strong><?= htmlspecialchars($settings['school_name']); ?></strong>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="/srs/assets/js/hero.js"></script>
<script src="/srs/assets/js/navbar.js"></script>
<script src="/srs/assets/js/app.js"></script>
<script src="/srs/assets/js/contact.js"></script>
<script src="/srs/assets/js/admission.js"></script>
<script src="/srs/assets/js/counter.js"></script>

<!-- Global Image Viewer -->

<div id="imageViewerModal" class="image-viewer-modal">

    <span class="image-viewer-close">&times;</span>

    <img
        id="imageViewerPreview"
        class="image-viewer-content"
        src=""
        alt="Preview">

</div>

<script src="/srs/assets/js/image-viewer.js"></script>
</body>
</html>