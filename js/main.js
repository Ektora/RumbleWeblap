import {Mini} from './models/Mini.js'; 
import { loadFamiliesToFilter, loadMiniToHtml, setupFamilyFilters, loadCostsToFilter, setupCostFilters, loadTypesToFilter, setupTypeFilters } from './miniPage.js';
import { Families, Types, Costs } from './models/MiniTypes.js';

document.addEventListener("DOMContentLoaded",init);

let miniList = [];


function init(){
    readMinisFromFile();
    loadFamiliesToFilter(Families);
    setupFamilyFilters();
    loadTypesToFilter(Types);
    setupTypeFilters();
    loadCostsToFilter(Costs);
    setupCostFilters();
}

async function readMinisFromFile(){
    const response = await fetch("../../datas/minis.json", {cache: "no-store"});
    if(!response.ok)
        throw new Error(`Nem sikerült betölteni: ${response.status}`);

    const fileContent = await response.json();
    fileContent.minis.forEach(mini => {
        console.log(mini);
        miniList.push(new Mini(mini));
    })

    loadMiniToHtml(miniList, Families ,Types, Costs);
}






