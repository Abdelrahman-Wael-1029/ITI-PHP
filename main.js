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
  console.log(containters);
  let mxF = 0,
    mxS = 0;
  containters.forEach((element) => {
    mxF = Math.max(mxF, element.firstElementChild.clientWidth);
    mxS = Math.max(mxS, element.lastElementChild.clientWidth);
  });
  containters.forEach((element) => {
    // element.firstElementChild.style.width = mxF + "px";
    element.lastElementChild.style.width = mxS + "px";
  });
  setCountry(); 
};

// .then((data) => data.json())
// .then((data)=>console.log(data))
// .catch((data) => console.log(data));

const getCountry = async () => {
  let data = await fetch(
    "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries.json"
  );
  return data.json();
};

const setCountry = async () => {
  let data = await getCountry();
  let select = document.getElementById("country");
  data.forEach((country) => {
    let newEl = document.createElement("option");
    newEl.innerHTML = country.name;
    newEl.setAttribute("value", country.name);
    select.appendChild(newEl);
  });
};
