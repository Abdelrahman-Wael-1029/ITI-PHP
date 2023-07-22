window.onload = () => {
  let skills = document.querySelectorAll("form>.skills>div>.allSkills");
  let spans = document.querySelectorAll("form>.skills>div>span");
  let mx = 0;
  skills.forEach((Element) => (mx = Math.max(mx, Element.clientWidth)));

  skills.forEach((Element) => (Element.style.width = mx + "px"));
  mx = 0;
  spans.forEach((Element) => (mx = Math.max(mx, Element.clientWidth)));
  spans.forEach((Element) => (Element.style.width = mx + "px"));

  let containters = document.querySelectorAll("form>div>div:not(.skills)");
  let mxS = 0;
  containters.forEach((element) => {
    mxS = Math.max(mxS, element.lastElementChild.clientWidth);
  });
  containters.forEach((element) => {
    element.lastElementChild.style.width = mxS + "px";
  });
  setCountry();
};

const addTocken = (data) => {
  localStorage.setItem("tocken", data);
};

const getCountry = async () => {
  let data = await fetch(
    "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries.json"
  );
  return data.json();
};

const setCountry = async () => {
  try {
    let data = await getCountry();
    let select = document.getElementById("country");
    data.forEach((country) => {
      let newEl = document.createElement("option");
      newEl.innerHTML = country.name;
      newEl.setAttribute("value", country.name);
      select.appendChild(newEl);
    });
  } catch (err) {
    console.log(err);
  }
};

const generateTocken = () => {
  let str = `!@#$%^&*()_+=-~[]{};:./<>?`;
  for (let i = 0; i < 10; ++i) {
    str += i;
  }
  // add all alphabets
  for (let i = "A"; i <= "Z"; ) {
    str += i;
    str += i.toLowerCase();
    i = String.fromCharCode(i.charCodeAt(0) + 1);
  }
  let tocken = ``;
  for (let i = 0; i < 20; ++i) {
    let idx = Math.floor(Math.random() * str.length);
    tocken += str[idx];
  }
  return tocken;
};
