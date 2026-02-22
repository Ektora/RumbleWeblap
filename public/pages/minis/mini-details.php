<?php

declare(strict_types=1);
require dirname(__DIR__, 2) . '/config.php';
require_once PRIVATE_BASE_PATH . '/app/miniLoadHelper.php';

$miniFilePath = PRIVATE_BASE_PATH . '/datas/minis.json';
$minisFile = file_get_contents($miniFilePath);
$data = json_decode($minisFile, true, 512, JSON_THROW_ON_ERROR);
$miniList = $data['minis'] ?? [];

$name = $_GET['name'] ?? 'abomination';

$index = getArrayIndexByName($miniList, $name);
$arrayLength = count($miniList);

$miniStatTypes = require PRIVATE_BASE_PATH . '/app/models/miniTypes.php';
$miniFamilies = $miniStatTypes['families'];
$miniCosts = $miniStatTypes['costs'];
$miniTypes = $miniStatTypes['types'];

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

    <div class="container d-flex justify-content-between mini-nav my-1">
        <a class="text-decoration-none text-white" href="/pages/minis/mini-details.php?name=<?php echo (string)getName($miniList[$index - 1 < 0 ? $arrayLength - 1 : $index - 1]['name']); ?>">
            <div class="mini-nav-item row <?php echo familyNameToGradient($miniList[$index - 1 < 0 ? $arrayLength - 1 : $index - 1]['main-family'], $miniList[$index - 1 < 0 ? $arrayLength - 1 : $index - 1]['second-family']) ?>-gradient">
                <p class="h5 m-auto col-sm-7 d-none d-sm-inline-block"><?php echo $miniList[$index - 1 < 0 ? $arrayLength - 1 : $index - 1]['name'] ?></p>
                <img src="/assets/images/minis/<?php echo getName($miniList[$index - 1 < 0 ? $arrayLength - 1 : $index - 1]['name']) ?>.png" class="col-12 col-sm-5 mini-nav-img img-fluid" alt="">
            </div>
        </a>
        <a class="text-decoration-none text-white" href="/pages/minis/mini-details.php?name=<?php echo (string)getName($miniList[$index + 1 == $arrayLength ? 0 : $index + 1]['name']); ?>">
            <div class="mini-nav-item row <?php echo familyNameToGradient($miniList[$index + 1 == $arrayLength ? 0 : $index + 1]['main-family'], $miniList[$index + 1 == $arrayLength ? 0 : $index + 1]['second-family']) ?>-gradient">
                <p class="h5 m-auto col-sm-7 d-none d-sm-block"><?php echo $miniList[$index + 1 == $arrayLength ? 0 : $index + 1]['name'] ?></p>
                <img src="/assets/images/minis/<?php echo getName($miniList[$index + 1 == $arrayLength ? 0 : $index + 1]['name']) ?>.png" class="col-12 col-sm-5 mini-nav-img img-fluid" alt="">
            </div>
        </a>
    </div>
    <div class="container" id="mini-infos">

        <div class="row <?php echo familyNameToGradient($miniList[$index]['main-family'], $miniList[$index]['second-family']) ?>-reverse-gradient">
            <div class="col-12 col-sm-7 d-flex align-items-center">
                <p class="h3 text-center m-auto"><?php echo $miniList[$index]['name'] ?></p>
            </div>
            <div class="col-12 col-sm-5  d-flex align-items-center">
                <div class="mini-info-stack position-relative m-auto">
                    <img src="<?php echo $miniFamilies[mergeFamilyNames($miniList[$index]['main-family'], $miniList[$index]['second-family'])]['imageSrc'] ?>" class="mini-info-family-image position-absolute" alt="">
                    <img src="<?php echo $miniTypes[$miniList[$index]['type']]['imageSrc'] ?>" class="mini-info-type-image position-absolute" alt="">
                    <img src="/assets/images/minis/<?php echo getName($miniList[$index]['name']) ?>.png" class="mini-info-image" alt="...">
                    <img src="/assets/images/statue/<?php echo familyNameToStatueName($miniList[$index]['main-family'], $miniList[$index]['second-family']) ?>.png" class="mini-info-base position-absolute start-50 bottom-0 translate-middle-x" alt="...">
                    <div class="mini-cost-container position-absolute">
                        <img src="/assets/images/icons/gold.png" class="mini-cost-image" alt="...">
                        <!--<span class="position-absolute d-inline-flex align-items-center top-50 start-50 translate-middle text-white fw-bold mini-cost-value">3</span>-->
                        <img src="<?php echo $miniCosts[$miniList[$index]['cost']]['imageSrc'] ?>" class="mini-cost-image-value position-absolute top-50 start-50 translate-middle" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>