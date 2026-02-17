<?php
declare(strict_types=1);


function mergeFamilyNames(string $mainFamilyName,string $secondFamilyName) : string{
    $familyName = "";
    $familyName .=  $mainFamilyName;

    if($secondFamilyName != "none"){
        $familyName .= $secondFamilyName;
    }
    return $familyName;
}

    function getName(string $name) : string{
        //$imageName = this.name.replaceAll(" ","-").toLowerCase();
        $name = strtolower(str_replace(" ","-",$name));
        return $name;
    }

    function getArrayIndexByName(array $miniList,string $name) : int{
        foreach($miniList as $index => $mini){
            if($name == getName($mini['name']))
                return $index;
        }
        return 0;
    }

    function familyNameToStatueName(string $mainFamily, string $secondFamily) : string{
    $statueBaseImageName = "";
    //let mainFamilyHelper;
    //let secondFamilyHelper;
    if($mainFamily == "neutral"){
        $statueBaseImageName = "Statue_Base_Neutral_Pose";
    }
    else if($secondFamily == "none"){
        //mainFamilyHelper = this.mainFamily.slice(0,1).toUpperCase() + this.mainFamily.slice(1,this.mainFamily.length)
        $statueBaseImageName = 'Statue_Base_' . ucfirst($mainFamily) . '_Pose';
    }
    else{
        //mainFamilyHelper = this.mainFamily.slice(0,1).toUpperCase() + this.mainFamily.slice(1,this.mainFamily.length);
        //secondFamilyHelper = this.secondFamily.slice(0,1).toUpperCase() + this.secondFamily.slice(1,this.secondFamily.length)
        $statueBaseImageName = 'Statue_Base_Split_' . ucfirst($mainFamily) . '_' . ucfirst($secondFamily) . '_Pose';
    }
    return $statueBaseImageName;
}

    function familyNameToGradient(string $mainFamily, string $secondFamily) : string{
    $gradient = "";
    $gradient .=  $mainFamily;

    if($secondFamily != "none"){
        $gradient = $gradient . "-" . $secondFamily;
    }
    return $gradient;
}


?>