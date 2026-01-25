
export function loadMiniToHtml(miniList, families, types, costs) {
    let miniElement;
    let miniElements = "";
    let miniCardsElement = document.getElementById("miniCards");
    miniList.forEach(mini => {

        miniElement =
            `<div class="col">
            <a class="text-decoration-none text-white" href=/pages/minis/mini-details.html?id=${encodeURIComponent(mini.id)}>
            <div class="card mini-card position-relative m-auto py-2 ${mini.familyNameToGradient()}-gradient"
                data-type="${mini.type}"
                data-cost="${mini.cost}"
                data-main-family="${mini.mainFamily}"
                data-second-family="${mini.secondFamily}">
                <div class="row g-0">
                    <div class="col-5 col-sm-12 position-relative mini-list-stack">
                        <img src="${families[mini.mergeFamilyNames()].imageSrc}" class="mini-family-image position-absolute" alt="">
                        <img src="${types[mini.type].imageSrc}" class="mini-type-image position-absolute" alt="">
                        <img src="/src/images/minis/${mini.getImageName()}.png" class="mini-list-image" alt="...">
                        <img src="../../src/images/statue/${mini.familyNameToStatueName()}.png" class="mini-list-base d-none d-sm-inline position-absolute start-50 bottom-0 translate-middle-x" alt="...">
                        <div class="mini-cost-container position-absolute">
                            <img src="/src/images/icons/gold.png" class="mini-cost-image" alt="...">
                            <!--<span class="position-absolute d-inline-flex align-items-center top-50 start-50 translate-middle text-white fw-bold mini-cost-value">3</span>-->
                                        <img src="${costs[mini.cost].imageSrc}" class="mini-cost-image-value position-absolute top-50 start-50 translate-middle" alt="...">
                        </div>
                    </div>
                    <div class="col-7 col-sm-12 align-content-center">
                        <div class="card-body d-flex justify-content-center  p-0">
                            <h5 class="card-title text-center m-auto mini-name">${mini.name}</h5>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>`;
        miniElements = miniElements + "\n\n" + miniElement;
        //console.log(element.id + " " + familyNameToStatueName(element["main-family"],element["second-family"]));
    });
    miniCardsElement.innerHTML = miniCardsElement.innerHTML + miniElements;
}

export function loadFamiliesToFilter(families) {
    let familyFilterElement;
    let familyFilterElements = "";
    let familyFilterDiv = document.getElementById("familyFilter");

    for (const [key, value] of Object.entries(families)) {
        if (value["family-type"] != "split-family") {
            familyFilterElement =
                `<div class="filter-item">
                    <input type="checkbox" name="family" value="${key}" id="filter-${key}" class="filter-checkbox position-absolute">
                    <label for="filter-${key}" class="filter-label">
                        <img src="${value.imageSrc}" alt="">
                    </label>
                </div>`;
            familyFilterElements = familyFilterElements + "\n\n" + familyFilterElement;
        }
    }
    familyFilterDiv.innerHTML = familyFilterDiv.innerHTML + familyFilterElements;

}

export function setupFamilyFilters() {
    document.getElementById("familyFilter").addEventListener("change", (event) => {
        if (!event.target.matches("input.filter-checkbox")) return;
        //applyFamilyFilter();
        applyFilters();
    })
}

function applyFamilyFilter() {

    const selectedFamilies = new Set([...document.querySelectorAll("#familyFilter input.filter-checkbox:checked")].map(cb => cb.value));
    console.log(selectedFamilies);

    document.querySelectorAll(".mini-card").forEach(card => {
        const mainFamily = card.dataset.mainFamily;
        const secondFamily = card.dataset.secondFamily;

        const show = selectedFamilies.size === 0 || selectedFamilies.has(mainFamily) || selectedFamilies.has(secondFamily);

        card.closest(".col").classList.toggle("d-none", !show);

    });
}


export function loadTypesToFilter(types) {
    let typeFilterElement;
    let typeFilterElements = "";
    let typeFilterDiv = document.getElementById("typeFilter");

    for (const [key, value] of Object.entries(types)) {
        typeFilterElement =
            `<div class="filter-item">
                    <input type="checkbox" name="type" value="${key}" id="filter-type-${key}" class="filter-checkbox position-absolute">
                    <label for="filter-type-${key}" class="filter-label">
                        <img src="${value.imageSrc}" alt="">
                    </label>
                </div>`;
        typeFilterElements = typeFilterElements + "\n\n" + typeFilterElement;

    }
    typeFilterDiv.innerHTML = typeFilterDiv.innerHTML + typeFilterElements;
}

export function setupTypeFilters() {
    document.getElementById("typeFilter").addEventListener("change", (event) => {
        if (!event.target.matches("input.filter-checkbox")) return;
        //applyTypeFilter();
        applyFilters();
    })
}

function applyTypeFilter() {

    const selectedTypes = new Set([...document.querySelectorAll("#typeFilter input.filter-checkbox:checked")].map(cb => cb.value));
    console.log(selectedTypes);

    document.querySelectorAll(".mini-card").forEach(card => {
        const type = card.dataset.type;

        const show = selectedTypes.size === 0 || selectedTypes.has(type) ;

        card.closest(".col").classList.toggle("d-none", !show);

    });
}




export function loadCostsToFilter(costs) {
    let costFilterElement;
    let costFilterElements = "";
    let costFilterDiv = document.getElementById("costFilter");

    for (const [key, value] of Object.entries(costs)) {
        if(key > 6) continue;
        costFilterElement =
            `<div class="filter-item">
                    <input type="checkbox" name="cost" value="${key}" id="filter-cost-${key}" class="filter-checkbox position-absolute">
                    <label for="filter-cost-${key}" class="filter-label">
                        <img src="${value.imageSrc}" alt="">
                    </label>
                </div>`;
        costFilterElements = costFilterElements + "\n\n" + costFilterElement;

    }
    costFilterDiv.innerHTML = costFilterDiv.innerHTML + costFilterElements;

}

export function setupCostFilters() {
    document.getElementById("costFilter").addEventListener("change", (event) => {
        if (!event.target.matches("input.filter-checkbox")) return;
        //applyCostFilter();
        applyFilters();
    })
}

function applyCostFilter() {

    const selectedCosts = new Set([...document.querySelectorAll("#costFilter input.filter-checkbox:checked")].map(cb => cb.value));
    console.log(selectedCosts);

    document.querySelectorAll(".mini-card").forEach(card => {
        const cost= card.dataset.cost;

        const show = selectedCosts.size === 0 || selectedCosts.has(cost);

        card.closest(".col").classList.toggle("d-none", !show);

    });
}

function applyFilters() {

    const selectedCosts = new Set([...document.querySelectorAll("#costFilter input.filter-checkbox:checked")].map(cb => cb.value));
    const selectedTypes = new Set([...document.querySelectorAll("#typeFilter input.filter-checkbox:checked")].map(cb => cb.value));
    const selectedFamilies = new Set([...document.querySelectorAll("#familyFilter input.filter-checkbox:checked")].map(cb => cb.value));


    document.querySelectorAll(".mini-card").forEach(card => {
        const cost= card.dataset.cost;
        const type = card.dataset.type;
        const mainFamily = card.dataset.mainFamily;
        const secondFamily = card.dataset.secondFamily;

        const showFamily = selectedFamilies.size === 0 || selectedFamilies.has(mainFamily) || selectedFamilies.has(secondFamily);
        const showCost = selectedCosts.size === 0 || selectedCosts.has(cost);
        const showType = selectedTypes.size === 0 || selectedTypes.has(type);


        card.closest(".col").classList.toggle("d-none", !showFamily || !showCost || !showType);

    });
}
