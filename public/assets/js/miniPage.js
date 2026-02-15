
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
