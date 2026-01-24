
export function loadMiniToHtml(miniList, families, types){
    let miniElement;
    let miniElements = "";
    let miniCardsElement = document.getElementById("miniCards");
    miniList.forEach(mini => {
        
       miniElement = 
       `<div class="col">
            <a class="text-decoration-none text-white" href=/pages/minis/mini-details.html?id=${encodeURIComponent(mini.id)}>
            <div class="card mini-card position-relative m-auto py-2 ${mini.familyNameToGradient()}-gradient"
                data-main-family=${mini.mainFamily}
                data-second-family=${mini.secondFamily}>
                <div class="row g-0">
                    <div class="col-5 col-sm-12 position-relative mini-list-stack">
                        <img src="${families[mini.mergeFamilyNames()].imageSrc}" class="mini-family-image position-absolute" alt="">
                        <img src="${types[mini.type].imageSrc}" class="mini-type-image position-absolute" alt="">
                        <img src="/src/images/minis/${mini.getImageName()}.png" class="mini-list-image" alt="...">
                        <img src="../../src/images/statue/${mini.familyNameToStatueName()}.png" class="mini-list-base d-none d-sm-inline position-absolute start-50 bottom-0 translate-middle-x" alt="...">
                        <div class="mini-cost-container position-absolute">
                            <img src="/src/images/icons/gold.png" class="mini-cost-image" alt="...">
                            <!--<span class="position-absolute d-inline-flex align-items-center top-50 start-50 translate-middle text-white fw-bold mini-cost-value">3</span>-->
                                        <img src="/src/images/icons/value_${mini.cost}.png" class="mini-cost-image-value position-absolute top-50 start-50 translate-middle" alt="...">
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

export function loadFamiliesToFilter(families){
    let familyFilterElement;
    let familyFilterElements = "";
    let familyFilterDiv = document.getElementById("familyFilter");

    for(const [key,value] of Object.entries(families)){
        if(value["family-type"] != "split-family"){
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

    export function setupFamilyFilters(){
        document.getElementById("familyFilter").addEventListener("change", (event) => {
            if(!event.target.matches("input.filter-checkbox")) return;
            applyFamilyFilter();
        })
    }

    function applyFamilyFilter(){
        
        const selectedFamilies = new Set([...document.querySelectorAll("#familyFilter input.filter-checkbox:checked")].map(cb => cb.value));
        console.log(selectedFamilies);

        document.querySelectorAll(".mini-card").forEach(card => {
            const mainFamily = card.dataset.mainFamily;
            const secondFamily = card.dataset.secondFamily;

            const show = selectedFamilies.size === 0 || selectedFamilies.has(mainFamily) || selectedFamilies.has(secondFamily);

            card.closest(".col").classList.toggle("d-none",!show);
            
        });
    }