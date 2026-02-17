import {setupFamilyFilters, setupCostFilters, setupTypeFilters } from './miniPage.js';

document.addEventListener("DOMContentLoaded",init);

function init(){
    //readMinisFromFile();
    //loadFamiliesToFilter(Families);
    setupFamilyFilters();
    //loadTypesToFilter(Types);
    setupTypeFilters();
    //loadCostsToFilter(Costs);
    setupCostFilters();
}







