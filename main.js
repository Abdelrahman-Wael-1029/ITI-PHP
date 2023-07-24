window.onload = () => {
  resetLabel();
  setCountry();
  generanteCode();
};

const generanteCode = () => {
  // length of code is 6
  let code = Math.floor(Math.random() * 100000);
  code = code.toString();
  while (code.length < 6) {
    code = code + Math.floor(Math.random() * 10);
  }
  let codeEl = document.querySelector(".code");
  if (!!codeEl)
    codeEl.innerHTML = code;
};

const resetLabel = () => {
  let containers = document.querySelectorAll("form>div>div");
  let mx = 0;
  containers.forEach((element) => {
    mx = Math.max(mx, element.firstElementChild.clientWidth);
  });
  containers.forEach((element) => {
    element.firstElementChild.style.width = mx + "px";
    element.firstElementChild.style.marginLeft = "var(--mainMargin)";
  });
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
    select.innerHTML = '';
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

// not used yet
/*
const login = async (e) => {
  e.preventDefault();
  
  let username = document.getElementById("userName").value;
  let password = document.getElementById("password").value;
  let email = document.getElementById("email").value;
  let phone = document.getElementById("phone").value;
  let country = document.getElementById("country").value;
  let department = document.getElementById("department").value;
  let address = document.getElementById("Address").value;
  let gender = document.querySelector(`input[name='gender']:checked`).value;
  let skills = [];
  let skill = document.querySelectorAll(`form>.skills>div`);
  skill.forEach((container) => {
    let name = container.firstElementChild.innerHTML;
    let allSkills =
      container.lastElementChild.querySelectorAll("input:checked");

    if (allSkills.length > 0) {
      allSkills = Array.from(allSkills).map((el) => el.value);
      console.log(allSkills);
      skills.push({ name, allSkills });
    }
  });

  form.submit();
};


const generateTocken = () => {
  let str = `!@#$%^&*()_+=-~[]{};:./<>?`;
  for (let i = 0; i < 10; ++i) {
    str += i;
  }
  // add all alphabets
  for (let i = "A"; i <= "Z";) {
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

*/