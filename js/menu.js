
document.addEventListener("DOMContentLoaded",async () => {
    const menu = await fetch("../../pages/menu.html");
    const menuContent = await menu.text();
    //document.getElementById("menu-slot").innerHTML = menuContent;
    document.body.insertAdjacentHTML("afterbegin",menuContent);
})