
document.addEventListener("DOMContentLoaded",async () => {
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