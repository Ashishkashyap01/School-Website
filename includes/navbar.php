<header class="header">

    <div class="container header-inner">

        <a href="/srs/" class="logo">

    <img
        src="<?= !empty($settings['logo'])
            ? '/srs/uploads/settings/' . htmlspecialchars($settings['logo'])
            : '/srs/assets/images/logo.png'; ?>"
        alt="<?= htmlspecialchars($settings['school_name']); ?>">

    <div class="logo-text">

        <h2>

            <?= htmlspecialchars($settings['school_name']); ?>

        </h2>

        <p>

            <?= htmlspecialchars($settings['tagline']); ?>

        </p>

    </div>

</a>

        <button class="menu-toggle" id="menuToggle">

            <span></span>
            <span></span>
            <span></span>

        </button>

        <nav class="nav" id="mainMenu">

            <a href="/srs/">Home</a>

            <a href="/srs/about">About</a>

            <a href="/srs/academics">Academics</a>

            <a href="/srs/admission">Admission</a>

            <a href="/srs/gallery">Gallery</a>

          
            <a href="/srs/teachers">Faculty</a>


            <a href="/srs/contact">Contact</a>

            <a href="/srs/admission" class="apply-btn">
                Admission Open
            </a>

        </nav>

    </div>

</header>