
let miniList = {};
readMinisFromFile();


async function readMinisFromFile(){
    const response = await fetch("../../datas/minis.json", {cache: "no-store"});
    if(!response.ok)
        throw new Error(`Nem sikerült betölteni: ${response.status}`);

    const fileContent = await response.json();
    miniList = fileContent.minis;
    

    loadMiniToHtml(fileContent.minis);
}

function loadMiniToHtml(minis){
    let miniElement;
    let miniElements = "";
    let miniCardsElement = document.getElementById("miniCards");
    minis.forEach(element => {
        
       miniElement = 
       `<div class="col">
            <div class="card mini-card m-auto py-2 undead-gradient">
                <div class="row g-0">
                    <div class="col-5 col-sm-12 mini-list-stack">
                       <img src="../../src/images/minis/${nameToImageName(element.name)}.png" class="mini-list-image" alt="...">
                        <img src="../../src/images/statue/Statue_Base_Undead_Pose.png" class="mini-list-base" alt="...">
                    </div>
                    <div class="col-7 col-sm-12">
                        <div class="card-body d-flex justify-content-center align-content-center p-0">
                            <h5 class="card-title text-center m-auto">${element.name}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        miniElements = miniElements + "\n\n" + miniElement;
    });
    miniCardsElement.innerHTML = miniElements;
}

function nameToImageName(miniName){
    let imageName = miniName.replaceAll(" ","-").toLowerCase();
    return imageName;
}

function familyNameToStatueName(mainFamily,secondFamily){

}