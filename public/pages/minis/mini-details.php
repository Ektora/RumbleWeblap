<?php
    declare(strict_types=1);
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
            require dirname(__DIR__) . '/menu.php';
        ?>
    </nav>
    <?php
                    //echo $_SERVER['HTTP_HOST'] ?? '';
                    $base_path = dirname(__DIR__, 3);
                    require_once $base_path . '/app/miniLoadHelper.php';
                    $miniFilePath = $base_path . '/datas/minis.json';
                    $minisFile = file_get_contents($miniFilePath);
                    $data = json_decode($minisFile, true, 512, JSON_THROW_ON_ERROR);
                    $miniList = $data['minis'] ?? [];

                    $name = $_GET['name'] ?? 'abomination';
                    
                    $index = getArrayIndexByName($miniList,$name);
                    $arrayLength = count($miniList);
                    
                    ?>
    <div class="container d-flex justify-content-between mini-nav my-1">
        <div class="mini-nav-item row <?php echo familyNameToGradient($miniList[$index-1 < 0 ? $arrayLength-1 : $index-1]['main-family'],$miniList[$index-1 < 0 ? $arrayLength-1 : $index-1]['second-family']) ?>-gradient">
            <p class="h5 m-auto col-sm-7 d-none d-sm-inline-block"><?php echo $miniList[$index-1 < 0 ? $arrayLength-1 : $index-1]['name'] ?></p>
            <img src="/assets/images/minis/<?php echo getName($miniList[$index-1 < 0 ? $arrayLength-1 : $index-1]['name']) ?>.png" class="col-12 col-sm-5 mini-nav-img img-fluid" alt="">
        </div>
        <div class="mini-nav-item row <?php echo familyNameToGradient($miniList[$index+1 == $arrayLength ? 0 : $index+1]['main-family'],$miniList[$index+1 == $arrayLength ? 0 : $index+1]['second-family']) ?>-gradient">
            <p class="h5 m-auto col-sm-7 d-none d-sm-block"><?php echo $miniList[$index+1 == $arrayLength ? 0 : $index+1]['name'] ?></p>
            <img src="/assets/images/minis/<?php echo getName($miniList[$index+1 == $arrayLength ? 0 : $index+1]['name']) ?>.png" class="col-12 col-sm-5 mini-nav-img img-fluid" alt="">
        </div>
    </div>
    <div class="container" id="mini-infos">
        
        <div class="row <?php echo familyNameToGradient($miniList[$index]['main-family'],$miniList[$index]['second-family']) ?>-reverse-gradient">
            <div class="col-12 col-sm-7 d-flex align-items-center">
                <p class="h3 text-center m-auto"><?php echo $miniList[$index]['name'] ?></p>
            </div>
            <div class="col-12 col-sm-5 position-relative ">
                <img src="/assets/images/minis/<?php echo getName($miniList[$index]['name']) ?>.png" class="img-fluid" alt="...">
            </div>
        </div>
    </div>
</body>
</html>