<?php

declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/config.php';
require_admin();
require_once PRIVATE_BASE_PATH . '/app/db.php';
require_once PRIVATE_BASE_PATH . '/app/miniRepository.php';


?>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magyar Rumble weblap</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <nav id="menu-slot">
        <?php
        require BASE_PATH . '/pages/menu.php';
        ?>
    </nav>
    <div class="container pt-2" id="mini-creator-display">
        <p class="h2">Warcraft Rumble <span class="mini-color">Minik</span> ADMIN szerkesztője</p>
        <div class="row">
            <div class="col">
                <div class="alliance-gradient mx-auto d-flex flex-column align-items-center" id="mini-creator-display-card">
                    <div class="position-relative mini-creator-display-stack " id="mini-creator-display-stack">
                        <img class="mini-creator-display-family-image position-absolute" id="mini-creator-display-family-image" src="/assets/images/icons/alliance.png" alt="">
                        <img class="mini-creator-display-type-image position-absolute" id="mini-creator-display-type-image" src="/assets/images/icons/troop.png" alt="">
                        <img src="/assets/images/minis/kobold.png" class="mini-creator-display-image" id="mini-creator-display-image" alt="...">
                        <img src="/assets/images/statue/Statue_Base_Neutral_Pose.png" class="mini-creator-display-base d-none d-sm-inline position-absolute start-50 bottom-0 translate-middle-x" alt="...">
                        <div class="mini-creator-display-cost-container position-absolute">
                            <img src="/assets/images/icons/gold.png" class="mini-creator-display-cost-image" alt="...">
                            <img src="/assets/images/icons/value_1.png" class="mini-creator-display-cost-image-value position-absolute top-50 start-50 translate-middle" id="mini-creator-display-cost-image-value" alt="...">
                        </div>
                    </div>
                    <p class="h3 mt-2" id="mini-creator-display-name">Mini név</p>
                </div>
            </div>
            <div class="col">
                <form method="POST" id="mini-creator-form" action="">
                    <div class="row mb-2">
                        <label for="mini-creator-type" class="col-form-label">Típus</label>
                        <div class="d-flex justify-content-center">
                            <select class="form-select w-75" aria-label="Típus választó" id="mini-creator-type">
                                <option value="troop" selected>Troop</option>
                                <option value="spell">Spell</option>
                                <option value="leader">Leader</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-name" class="col-form-label">Név</label>
                        <div class="d-flex justify-content-center">
                            <input type="text" class="form-control w-75" id="mini-creator-name" placeholder="Pl: Arthas, Abomination...">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-file" class="col-form-label">Kép</label>
                        <div class="d-flex justify-content-center">
                            <input type="file" class="form-control w-75" id="mini-creator-file" accept="image/png">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-cost" class="col-form-label">Költség</label>
                        <div class="d-flex justify-content-center">
                            <input type="number" class="form-control w-75" id="mini-creator-cost" value="1" min="0" max="9">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-description" class="col-form-label">Leírás</label>
                        <div class="d-flex justify-content-center">
                            <input type="text" class="form-control w-75" id="mini-creator-description" placeholder="Pl: This is a tanky mini...">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-funny-description" class="col-form-label">Vezető vicces idézet</label>
                        <div class="d-flex justify-content-center">
                            <input type="text" class="form-control w-75" id="mini-creator-funny-description" placeholder="...">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-main-family" class="col-form-label">Fő család</label>
                        <div class="d-flex justify-content-center">
                            <select class="form-select w-75" id="mini-creator-main-family" aria-label="Fő család választó">
                                <option value="alliance" selected>Alliance</option>
                                <option value="beast">Beast</option>
                                <option value="blackrock">Blackrock</option>
                                <option value="cenarion">Cenarion</option>
                                <option value="horde">Horde</option>
                                <option value="undead">Undead</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-second-family" class="col-form-label">Másodlagos család</label>
                        <div class="d-flex justify-content-center">
                            <select class="form-select w-75" aria-label="Típus választó" id="mini-creator-second-family">
                                <option value="none" selected>Nincs</option>
                                <option value="alliance">Alliance</option>
                                <option value="beast">Beast</option>
                                <option value="blackrock">Blackrock</option>
                                <option value="cenarion">Cenarion</option>
                                <option value="horde">Horde</option>
                                <option value="undead">Undead</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn my-2">Küldés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/js/miniCreator.js" type="module" defer> </script>
</body>

</html>