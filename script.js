let pageUrl = window.location.pathname;
let getNav = document.querySelectorAll("nav div ul li a");

for (let i = 0; i < getNav.length; i++) {

  let pageUrlName = pageUrl.split("/");
  let pageUrlLength = pageUrlName.length - 1;

  let pageNav = getNav[i].pathname;
  let pageNavName = pageNav.split("/");
  let pageNavLength = pageNavName.length - 1;
  let pageFinalName = pageNavName[pageNavLength];
  let pageNavExists = pageUrl.includes(pageFinalName);

  if (pageNavExists == true) {
    getNav[i].style.cssText = "color: #31a6ff;";
  }
  else if (pageUrlName[pageUrlLength] == "") {
    getNav[0].style.cssText = "color: #31a6ff;";
  }
}
