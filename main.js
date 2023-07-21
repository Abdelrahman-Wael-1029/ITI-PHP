window.onload = () => {
  let skills = document.querySelectorAll("form>.skills>div>.allSkills");
  let spans = document.querySelectorAll("form>.skills>div>span");
  let mx = 0;
  skills.forEach((Element) => (mx = Math.max(mx, Element.clientWidth)));

  skills.forEach((Element) => (Element.style.width = mx + "px"));

  spans.forEach((Element) => (mx = Math.max(mx, Element.clientWidth)));
  spans.forEach((Element) => (Element.style.width = mx + "px"));
};
