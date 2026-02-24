import { Mini, secondaryAllowed } from "/assets/js/model/Mini.js";



const mini = new Mini();

updateSecondFamily(document.getElementById("mini-creator-main-family").value);
document.getElementById("mini-creator-name").addEventListener("input", changeName);
document.getElementById("mini-creator-type").addEventListener("change", changeType);
document.getElementById("mini-creator-cost").addEventListener("input", changeCost);
document.getElementById("mini-creator-main-family").addEventListener("change", changeMainFamily);
document.getElementById("mini-creator-second-family").addEventListener("change", changeSecondFamily);
document.getElementById("mini-creator-file").addEventListener("change",changeMiniImage);

function changeName(event){
    let targetElement = document.getElementById("mini-creator-display-name");
    if(event.target.value != "") {
        targetElement.textContent = event.target.value;
        mini.setName(event.target.value);
        console.log(mini.getImageName());
    }
    else{
        targetElement.textContent = "Mini név";
        mini.setName("");
    }
}

function changeType(event){
    const targetElement = document.getElementById("mini-creator-display-type-image");
    console.log(event.target.value);
    targetElement.src = `/assets/images/icons/${event.target.value}.png`;

}

function changeCost(event){
    const targetElement = document.getElementById("mini-creator-display-cost-image-value");
    console.log(event.target.value);
    targetElement.src = `/assets/images/icons/value_${event.target.value}.png`;

}

function changeMainFamily(event){
    updateSecondFamily(event.target.value);
    changeMainGradient(event.target.value);
    changeMainFamilyImage(event.target.value);
    mini.setMainFamily(event.target.value);
  
}

function changeSecondFamily(event){
    changeSecondGradient(event.target.value);
    changeSecondFamilyImage(event.target.value);
    mini.setSecondFamily(event.target.value);
}

function updateSecondFamily(mainValue){
    //const targetElement = document.getElementById("mini-creator-display-cost-image-value");
    const secondFamilySelectElement = document.getElementById("mini-creator-second-family");

    const allowed = new Set(secondaryAllowed[mainValue] ?? ["none"]);

    for(const opt of secondFamilySelectElement.options){
        opt.disabled = !allowed.has(opt.value);
    }

     if (!allowed.has(secondFamilySelectElement.value)) {
        secondFamilySelectElement.value = "none";
        changeMainGradient(event.target.value);
    }
}

function changeMainGradient(mainFamilyValue){
    const secondFamilySelectElement = document.getElementById("mini-creator-second-family");
    const miniDiv = document.getElementById("mini-creator-display-card");
    for (const cls of [...miniDiv.classList]) {
        if (cls.endsWith("-gradient")) miniDiv.classList.remove(cls);
    }
    if(secondFamilySelectElement.value == "none"){
        miniDiv.classList.add(`${mainFamilyValue}-gradient`);
    }
    else{
        miniDiv.classList.add(`${mainFamilyValue}-${secondFamilySelectElement.value}-gradient`);
    }
}

function changeSecondGradient(secondFamilyValue){
    const mainFamilySelectElement = document.getElementById("mini-creator-main-family");
    const miniDiv = document.getElementById("mini-creator-display-card");
    for (const cls of [...miniDiv.classList]) {
        if (cls.endsWith("-gradient")) miniDiv.classList.remove(cls);
    }
    miniDiv.classList.add(`${mainFamilySelectElement.value}-${secondFamilyValue}-gradient`);

}

function changeMainFamilyImage(mainFamilyValue){
    const secondFamilySelectElement = document.getElementById("mini-creator-second-family");
    const familyImageElement = document.getElementById("mini-creator-display-family-image");
    if(secondFamilySelectElement.value == "none"){
        familyImageElement.src = `/assets/images/icons/${mainFamilyValue}.png`;
    }
    else{
        familyImageElement.src = `/assets/images/icons/${mainFamilyValue}${secondFamilySelectElement.value}.png`;
    }
}

function changeSecondFamilyImage(secondFamilyValue){
    const mainFamilySelectElement = document.getElementById("mini-creator-main-family");
    const familyImageElement = document.getElementById("mini-creator-display-family-image");

    familyImageElement.src = `/assets/images/icons/${mainFamilySelectElement.value}${secondFamilyValue}.png`;

}

function changeMiniImage(miniImage){
    const displayImageElement = document.getElementById("mini-creator-display-image");
    const image = miniImage.target.files[0];
    let imageSrc = URL.createObjectURL(image);
    displayImageElement.src = imageSrc;
}