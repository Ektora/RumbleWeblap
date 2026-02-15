import { loadFamiliesToFilter, setupFamilyFilters, loadCostsToFilter, setupCostFilters, loadTypesToFilter, setupTypeFilters } from './miniPage.js';

document.addEventListener("DOMContentLoaded",init);

let miniList = [];


function init(){
    //readMinisFromFile();
    //loadFamiliesToFilter(Families);
    setupFamilyFilters();
    //loadTypesToFilter(Types);
    setupTypeFilters();
    //loadCostsToFilter(Costs);
    setupCostFilters();
}







