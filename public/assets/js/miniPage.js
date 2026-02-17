


export function setupFamilyFilters() {
    document.getElementById("familyFilter").addEventListener("change", (event) => {
        if (!event.target.matches("input.filter-checkbox")) return;
        //applyFamilyFilter();
        applyFilters();
    })
}



export function setupTypeFilters() {
    document.getElementById("typeFilter").addEventListener("change", (event) => {
        if (!event.target.matches("input.filter-checkbox")) return;
        //applyTypeFilter();
        applyFilters();
    })
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
