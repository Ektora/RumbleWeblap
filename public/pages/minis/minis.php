<?php

declare(strict_types=1);
?>
<html>

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
        require dirname(__DIR__) . '/menu.php';
        ?>
    </nav>
    <div class="container">

        <div class="row">
            <div id="minisListDisplay"
                class="col-md-9 order-2 order-md-1">
                <div class="page-header">
                    <h1>Warcraft Rumble <span class="mini-color">Minik</span> listája</h1>
                    <p>Az oldalon találhatóak meg a Warcraft Rumble játékban jelenleg elérhető Minik, amiket család, típus és költség alapján lehet keresni.</p>
                </div>

                <div class="row pt-1 row-cols-1 row-cols-sm-3 row-cols-lg-4 row-cols-xl-5 g-2" id="miniCards">
                    <?php
                    $base_path = dirname(__DIR__, 3);
                    require_once $base_path . '/app/miniLoadHelper.php';

                    
                    $miniFilePath = $base_path . '/datas/minis.json';
                    $minisFile = file_get_contents($miniFilePath);
                    $data = json_decode($minisFile, true, 512, JSON_THROW_ON_ERROR);
                    $miniList = $data['minis'] ?? [];

                    $miniStatTypes = require $base_path . '/app/models/miniTypes.php';
                    $miniFamilies = $miniStatTypes['families'];
                    $miniCosts = $miniStatTypes['costs'];
                    $miniTypes = $miniStatTypes['types'];
                    ?>

                    <?php foreach ($miniList as $mini): ?>

                    <div class="col">
                        <a class="text-decoration-none text-white" href="/pages/minis/mini-details.php?name=<?php echo (string)getName($mini['name']); ?>">
                        <div class="card mini-card position-relative m-auto py-2 <?php echo familyNameToGradient($mini['main-family'],$mini['second-family']) ?>-gradient"
                            data-type="<?php echo $mini['type'] ?>"
                            data-cost="<?php echo $mini['cost'] ?>"
                            data-main-family="<?php echo $mini['main-family'] ?>"
                            data-second-family="<?php echo $mini['second-family'] ?>">
                            <div class="row g-0">
                                <div class="col-5 col-sm-12 position-relative mini-list-stack">
                                    <img src="<?php echo $miniFamilies[mergeFamilyNames($mini['main-family'],$mini['second-family'])]['imageSrc'] ?>" class="mini-family-image position-absolute" alt="">
                                    <img src="<?php echo $miniTypes[$mini['type']]['imageSrc'] ?>" class="mini-type-image position-absolute" alt="">
                                    <img src="/assets/images/minis/<?php echo getName($mini['name']) ?>.png" class="mini-list-image" alt="...">
                                    <img src="/assets/images/statue/<?php echo familyNameToStatueName($mini['main-family'],$mini['second-family']) ?>.png" class="mini-list-base d-none d-sm-inline position-absolute start-50 bottom-0 translate-middle-x" alt="...">
                                    <div class="mini-cost-container position-absolute">
                                        <img src="/assets/images/icons/gold.png" class="mini-cost-image" alt="...">
                                        <!--<span class="position-absolute d-inline-flex align-items-center top-50 start-50 translate-middle text-white fw-bold mini-cost-value">3</span>-->
                                                    <img src="<?php echo $miniCosts[$mini['cost']]['imageSrc'] ?>" class="mini-cost-image-value position-absolute top-50 start-50 translate-middle" alt="...">
                                    </div>
                                </div>
                                <div class="col-7 col-sm-12 align-content-center">
                                    <div class="card-body d-flex justify-content-center  p-0">
                                        <h5 class="card-title text-center m-auto mini-name"><?php echo $mini['name'] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <?php endforeach; ?>

                    
                </div>
            </div>
            <div id="minisListSearch" class="col-md-3 order-1 order-md-2">
                <div class="filterDiv">
                    <p class="h5 text-white">Mini kereső</p>
                    <input type="text" class="form-control" id="mini-list-search" placeholder="Pl: Arthas...">
                    <p class="h5 text-white">Család</p>
                    <div id="familyFilter">
                        <?php
                            foreach($miniFamilies as $key => $family){
                                if($family['family-type'] == "split-family")
                                    continue;
                                echo '<div class="filter-item">';
                                echo '  <input type="checkbox" name="family" value="' . $key . '" id="filter-' . $key . '" class="filter-checkbox position-absolute">';
                                echo '  <label for="filter-' . $key . '" class="filter-label">';
                                echo '      <img src="' . $family['imageSrc'] . '" alt="">';
                                echo '  </label>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                    
                </div>
                <div class="filterDiv">
                    <p class="h5 text-white">Mini típus</p>
                    <div id="typeFilter">
                        <?php
                            foreach($miniTypes as $key => $type){
                                echo '<div class="filter-item">';
                                echo '  <input type="checkbox" name="type" value="' . $key . '" id="filter-' . $key . '" class="filter-checkbox position-absolute">';
                                echo '  <label for="filter-' . $key . '" class="filter-label">';
                                echo '      <img src="' . $type['imageSrc'] . '" alt="">';
                                echo '  </label>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="filterDiv">
                    <p class="h5 text-white">Költség</p>
                    <div id="costFilter">
                        <?php
                            foreach($miniCosts as $key => $cost){
                                if($key > 6)
                                    break;
                                echo '<div class="filter-item">';
                                echo '  <input type="checkbox" name="cost" value="' . $key . '" id="filter-' . $key . '" class="filter-checkbox position-absolute">';
                                echo '  <label for="filter-' . $key . '" class="filter-label">';
                                echo '      <img src="' . $cost['imageSrc'] . '" alt="">';
                                echo '  </label>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/main.js" type="module"></script>
    <script src="/assets/js/menu.js"></script>
</body>

</html>