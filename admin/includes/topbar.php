<header class="topbar">

    <div class="topbar-left">

        <button id="menuToggle" class="menu-toggle"> 

            ☰

        </button>

        <h1>

            Dashboard

        </h1>

    </div>

    <div class="topbar-right">

        <div class="search-box">

            <input
                type="text"
                placeholder="Search...">

        </div>

        <div class="notification">

            🔔

            <span class="badge">

                0

            </span>

        </div>

        <div class="profile-box">

            <div class="profile-image">

                <img
                    src="/srs/assets/images/logo.png"
                    alt="Admin">

            </div>

            <div class="profile-info">

                <strong>

                    <?= htmlspecialchars($_SESSION['admin']['name']) ?>

                </strong>

                <small>

                    <?= htmlspecialchars($_SESSION['admin']['role']) ?>

                </small>

            </div>

        </div>

    </div>

</header>