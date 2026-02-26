<?php

declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/config.php';
require_admin();
require_once PRIVATE_BASE_PATH . '/app/miniLoadHelper.php';
require_once PRIVATE_BASE_PATH . '/app/db.php';
require_once PRIVATE_BASE_PATH . '/app/miniRepository.php';

$repository = new MiniRepository(db());
$miniID = isset($_GET['id']) ? (int) $_GET['id'] : null;
$isNewMini = $miniID === null ? true : false;
$targetDir = BASE_PATH . '/assets/images/minis';
$oldMiniName = "";

$postMini = [
    'id' => -1,
    'name' => "",
    'cost' =>  1,
    'mini_type' => "",
    'main_family' => "",
    'second_family' => "",
    'description' => "",
    'leaderAbilityName' => "",
    'leaderAbilityDescription' => "",
    'leaderFunnyDescription' => ""
];

if (!$isNewMini) {
    $postMini = $repository->getMini((int)$miniID);
    $oldMiniName = $postMini['name'];
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? "";
    if ($action === 'addMini') {
        $secondFamily = trim((string) $_POST['miniSecondFamily'] ?? "");
        $secondFamily = ($secondFamily === "" || $secondFamily === "none") ? null : $secondFamily;
        $description =  trim((string) $_POST['miniDescription'] ?? "");
        $description = ($description === "") ? null : $description;
        $leaderAbilityName = trim((string) $_POST['miniLeaderAbilityName'] ?? "");
        $leaderAbilityName = ($leaderAbilityName === "") ? null : $leaderAbilityName;
        $leaderAbilityDescription = trim((string)$_POST['miniLeaderAbilityDescription'] ?? "");
        $leaderAbilityDescription = ($leaderAbilityDescription) ? null : $leaderAbilityDescription;
        $leaderFunnyDescription = trim((string)$_POST['miniLeaderFunnyDescription'] ?? "");
        $leaderFunnyDescription = ($leaderFunnyDescription === "") ? null : $leaderFunnyDescription;

        $postMini = [
            'id' => $miniID,
            'name' => trim($_POST['miniName']) ?? "",
            'cost' => (int) $_POST['miniCost'] ?? 1,
            'mini_type' => trim($_POST['miniType']) ?? "",
            'main_family' => (string) trim($_POST['miniMainFamily']) ?? "",
            'second_family' => $secondFamily,
            'description' => $description,
            'leaderAbilityName' => $leaderAbilityName,
            'leaderAbilityDescription' => $leaderAbilityDescription,
            'leaderFunnyDescription' => $leaderFunnyDescription
        ];
        if ($miniID === null) {
            $miniID = $repository->addMini($postMini);
        } else {
            $miniID = $repository->updateMini($postMini);
        }
        if ($postMini['name'] != $oldMiniName) {
            $baseName = (string) getName($oldMiniName);
            $targetDir = BASE_PATH . '/assets/images/minis';
            $targetPath = $targetDir . '/' . $baseName . '.png';
            if (is_file($targetPath))
                unlink($targetPath);
        }
        if (isset($_FILES['miniImage']) && $_FILES['miniImage']['error'] !== UPLOAD_ERR_NO_FILE) {
            $tmpPath = $_FILES['miniImage']['tmp_name'];
            $baseName = (string) getName($postMini['name']);
            
            $targetPath = $targetDir . '/' . $baseName . '.png';
            move_uploaded_file($tmpPath, $targetPath);
        }
        header('Location: /pages/admin/miniCreator.php?id=' . (int)($miniID) . '&name=' . (string)getName($postMini['name']));
        exit;
    } else if ($action === 'deleteMini') {
        $repository->deleteMini($miniID);
        $baseName = (string) getName($oldMiniName);
        $targetPath = $targetDir . '/' . $baseName . '.png';
        if (is_file($targetPath))
            unlink($targetPath);
        header('Location: /pages/admin/minis.php');
        exit;
    }
}

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
                <div class="mx-auto <?php echo $postMini['main_family'] != "" ? familyNameToGradient($postMini['main_family'],$postMini['second_family']) : 'alliance' ?>-gradient d-flex flex-column align-items-center" id="mini-creator-display-card">
                    <div class="position-relative mini-creator-display-stack " id="mini-creator-display-stack">
                        <img class="mini-creator-display-family-image position-absolute" id="mini-creator-display-family-image" src="/assets/images/icons/<?php echo $postMini['main_family'] != "" ? mergeFamilyNames($postMini['main_family'],$postMini['second_family']) : 'alliance' ?>.png" alt="">
                        <img class="mini-creator-display-type-image position-absolute" id="mini-creator-display-type-image" src="/assets/images/icons/<?php echo $postMini['mini_type'] != "" ? $postMini['mini_type'] : 'troop' ?>.png" alt="">
                        <?php if ($miniID === null || !is_file($targetDir . '/' . getName($postMini['name']) . '.png')): ?>
                        <img src="/assets/images/minis/kobold.png" class="mini-creator-display-image" id="mini-creator-display-image" alt="...">
                        <?php else: ?>
                        <img src="/assets/images/minis/<?php echo getName($postMini['name']) ?>.png" class="mini-creator-display-image" id="mini-creator-display-image" alt="...">
                        <?php endif; ?>
                        <img src="/assets/images/statue/Statue_Base_Neutral_Pose.png" class="mini-creator-display-base d-none d-sm-inline position-absolute start-50 bottom-0 translate-middle-x" alt="...">
                        <div class="mini-creator-display-cost-container position-absolute">
                            <img src="/assets/images/icons/gold.png" class="mini-creator-display-cost-image" alt="...">
                            <img src="/assets/images/icons/value_1.png" class="mini-creator-display-cost-image-value position-absolute top-50 start-50 translate-middle" id="mini-creator-display-cost-image-value" alt="...">
                        </div>
                    </div>
                    <?php if ($miniID === null): ?>
                        <p class="h3 mt-2" id="mini-creator-display-name">Mini név</p>
                    <?php else: ?>
                        <p class="h3 mt-2" id="mini-creator-display-name"><?php echo $postMini['name']; ?></p>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col">
                <form method="POST" id="mini-creator-form" action="" enctype="multipart/form-data">
                    <div class="row mb-2">
                        <label for="mini-creator-type" class="col-form-label">Típus</label>
                        <div class="d-flex justify-content-center">
                            <select name="miniType" class="form-select w-75" aria-label="Típus választó" id="mini-creator-type">
                                <option value="troop" <?php echo $postMini['mini_type'] === 'troop' ? 'selected' : '' ?>>Troop</option>
                                <option value="spell" <?php echo $postMini['mini_type'] === 'spell' ? 'selected' : '' ?>>Spell</option>
                                <option value="leader" <?php echo $postMini['mini_type'] === 'leader' ? 'selected' : '' ?>>Leader</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-name" class="col-form-label">Név</label>
                        <div class="d-flex justify-content-center">
                            <?php if ($miniID === null && $postMini['name'] === ''): ?>
                                <input name="miniName" type="text" class="form-control w-75" id="mini-creator-name" placeholder="Pl: Arthas, Abomination...">
                            <?php else: ?>
                                <input name="miniName" type="text" class="form-control w-75" id="mini-creator-name" placeholder="Pl: Arthas, Abomination..." value="<?php echo htmlspecialchars((string)$postMini['name'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-file" class="col-form-label">Kép</label>
                        <div class="d-flex justify-content-center">
                            <input name="miniImage" type="file" class="form-control w-75" id="mini-creator-file" accept="image/png">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-cost" class="col-form-label">Költség</label>
                        <div class="d-flex justify-content-center">
                            <input name="miniCost" type="number" class="form-control w-75" id="mini-creator-cost" value="1" min="0" max="9">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-description" class="col-form-label">Leírás</label>
                        <div class="d-flex justify-content-center">
                            <input name="miniDescription" type="text" class="form-control w-75" id="mini-creator-description" placeholder="Pl: This is a tanky mini...">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-leader-ability-name" class="col-form-label">Vezető képességének neve</label>
                        <div class="d-flex justify-content-center">
                            <input name="miniLeaderAbilityName" type="text" class="form-control w-75" id="mini-creator-leader-ability-name" placeholder="...">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-leader-ability-description" class="col-form-label">Vezető képességének leírása</label>
                        <div class="d-flex justify-content-center">
                            <input name="miniLeaderAbilityDescription" type="text" class="form-control w-75" id="mini-creator-leader-ability-description" placeholder="...">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-funny-description" class="col-form-label">Vezető vicces idézet</label>
                        <div class="d-flex justify-content-center">
                            <input name="miniLeaderFunnyDescription" type="text" class="form-control w-75" id="mini-creator-funny-description" placeholder="...">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="mini-creator-main-family" class="col-form-label">Fő család</label>
                        <div class="d-flex justify-content-center">
                            <select name="miniMainFamily" class="form-select w-75" id="mini-creator-main-family" aria-label="Fő család választó">
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
                            <select name="miniSecondFamily" class="form-select w-75" aria-label="Típus választó" id="mini-creator-second-family">
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
                    <div class="d-flex justify-content-around">
                        <div class="d-flex justify-content-center" action="POST">
                            <button type="submit" name="action" value="addMini" class="btn my-2">Küldés</button>
                        </div>
                        <?php if ($miniID != null): ?>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="action" value="deleteMini" class="btn my-2" onclick="return confirm('Biztos törlöd? a minit?');">Mini törlése</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/js/miniCreator.js" type="module" defer> </script>
</body>

</html>