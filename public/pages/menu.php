    
        <nav class="navbar navbar-expand-sm container mb-1">
            <div class="container"> 
                <span class="navbar-brand mb-0 h1 fw-bold">Warcrat Rumble</span>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item px-1 menu-border">
                            <a class="nav-link fw-bold" href="/index.php">FŐOLDAL</a>
                        </li>
                        <li class="nav-item px-1 menu-border">
                            <a class="nav-link fw-bold" href="/pages/minis/minis.php">MINI</a>
                        </li>
                        <li class="nav-item px-1 menu-border">
                            <a class="nav-link fw-bold disabled" href="/pages/raid.php">RAID</a>
                        </li>
                        <li class="nav-item px-1 menu-border">
                            <a class="nav-link fw-bold disabled" href="D">DUNGEON</a>
                        </li>
                        <?php if(isAdmin() == true):?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ADMIN
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fw-bold" href="/pages/admin/minis.php">MINIK</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <?php if(isAdmin() == true):?>
                    <form class="my-auto ms-auto" method="POST" action="/pages/admin/logout.php">
                        <button class="btn btn-outline-success" type="submit">Kijelentkezés</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
