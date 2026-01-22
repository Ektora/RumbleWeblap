
document.addEventListener("DOMContentLoaded",async () => {
    const menu = await fetch("../../pages/menu.html");
    const menuContent = await menu.text();
    //document.getElementById("menu-slot").innerHTML = menuContent;
    document.body.insertAdjacentHTML("afterbegin",menuContent);

    markActiveMenuLink();
});

function markActiveMenuLink(){
    const activePage = location.pathname;
    const links= document.querySelectorAll("a.nav-link[href]");
    links.forEach(element => {
        const absolutePath = element.getAttribute("href");
        const isActiveLink = activePage === absolutePath;

        element.classList.toggle("active",isActiveLink);
        element.closest(".nav-item").classList.toggle("menu-border-active",isActiveLink);
    });
    console.log(activePage);
    
}