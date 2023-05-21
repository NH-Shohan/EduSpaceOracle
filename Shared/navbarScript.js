function toggleMenu() {
  // Get the menu element by id
  const menu = document.getElementById("menu");
  // If the menu has the responsive class, remove it
  if (menu.className === "responsive") {
    menu.className = "";
    // Otherwise, add it
  } else {
    menu.className = "responsive";
  }

  const iconClass = document.querySelector(".icon");
  iconClass.innerHTML = `
        <i onclick="" class="fa fa-times"></i>
    `;
  document.querySelector(".navbar_auth_link").style.display = "block";
  iconClass.addEventListener("click", function () {
    if (iconClass.innerHTML == `<i class="fa fa-bars"></i>`) {
      iconClass.innerHTML = `<i class="fa fa-times"></i>`;
      document.querySelector(".navbar_auth_link").style.display = "block";
    } else {
      iconClass.innerHTML = `<i class="fa fa-bars"></i>`;
      document.querySelector(".navbar_auth_link").style.display = "none";
    }
  });
}
