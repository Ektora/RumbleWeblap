import {Mini} from './models/Mini.js'; 
//let miniList = {};
let miniList = [];
readMinisFromFile();


async function readMinisFromFile(){
    const response = await fetch("../../datas/minis.json", {cache: "no-store"});
    if(!response.ok)
        throw new Error(`Nem sikerült betölteni: ${response.status}`);

    const fileContent = await response.json();
    //miniList = fileContent.minis;
    fileContent.minis.forEach(mini => {
        console.log(mini);
        miniList.push(new Mini(mini));
    })

    //loadMiniToHtml(fileContent.minis);
    loadMiniToHtml();
}

function loadMiniToHtml(){
    let miniElement;
    let miniElements = "";
    let miniCardsElement = document.getElementById("miniCards");
    miniList.forEach(mini => {
        
       miniElement = 
       `<div class="col">
            <div class="card mini-card position-relative m-auto py-2 ${familyNameToGradient(mini.mainFamily,mini.secondFamily)}-gradient">
                <div class="row g-0">
                    <div class="col-5 col-sm-12 position-relative mini-list-stack">
                        <img src="../../src/images/icons/${mini.familyNameToFamilyIcon()}.png" class="mini-family-image position-absolute" alt="">
                        <img src="../../src/images/icons/${mini.type}.png" class="mini-type-image position-absolute" alt="">
                        <img src="../../src/images/minis/${nameToImageName(mini.name)}.png" class="mini-list-image" alt="...">
                        <img src="../../src/images/statue/${familyNameToStatueName(mini.mainFamily,mini.secondFamily)}.png" class="mini-list-base d-none d-sm-inline position-absolute start-50 bottom-0 translate-middle-x" alt="...">
                        <div class="mini-cost-container position-absolute">
                            <img src="../../src/images/icons/gold.png" class="mini-cost-image" alt="...">
                            <!--<span class="position-absolute d-inline-flex align-items-center top-50 start-50 translate-middle text-white fw-bold mini-cost-value">3</span>-->
                                        <img src="../../src/images/icons/value_${mini.cost}.png" class="mini-cost-image-value position-absolute top-50 start-50 translate-middle" alt="...">
                        </div>
                    </div>
                    <div class="col-7 col-sm-12 align-content-center">
                        <div class="card-body d-flex justify-content-center  p-0">
                            <h5 class="card-title text-center m-auto mini-name">${mini.name}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        miniElements = miniElements + "\n\n" + miniElement;
        //console.log(element.id + " " + familyNameToStatueName(element["main-family"],element["second-family"]));
    });
    miniCardsElement.innerHTML = miniCardsElement.innerHTML + miniElements;
}

function nameToImageName(miniName){
    let imageName = miniName.replaceAll(" ","-").toLowerCase();
    return imageName;
}

function familyNameToStatueName(mainFamily,secondFamily){
    let statueBaseImageName;
    let mainFamilyHelper;
    let secondFamilyHelper;
    if(mainFamily == "" || mainFamily == null){
        statueBaseImageName = "Statue_Base_Neutral_Pose";
    }
    else if(secondFamily == "none"){
        mainFamilyHelper = mainFamily.slice(0,1).toUpperCase() + mainFamily.slice(1,mainFamily.length)
        statueBaseImageName = `Statue_Base_${mainFamilyHelper}_Pose`;
    }
    else{
        mainFamilyHelper = mainFamily.slice(0,1).toUpperCase() + mainFamily.slice(1,mainFamily.length);
        secondFamilyHelper = secondFamily.slice(0,1).toUpperCase() + secondFamily.slice(1,mainFamily.length)
        statueBaseImageName = `Statue_Base_Split_${mainFamilyHelper}_${secondFamilyHelper}_Pose`;
    }
    return statueBaseImageName;
}

function familyNameToGradient(mainFamily,secondFamily){
    let gradient = "";
    if(mainFamily == "" || mainFamily == null){
        gradient = "neutral";
    }
    gradient +=  mainFamily;

    if(secondFamily != "none"){
        gradient = gradient + "-" + secondFamily;
    }
    return gradient;
}

