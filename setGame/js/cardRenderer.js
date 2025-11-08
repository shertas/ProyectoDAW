async function renderCard(card) {
  const svgContent = await loadSVG(`./svg/${card.shape}.svg`);
  let shapesHTML = "";

  for (let i = 0; i < card.number; i++) {
    shapesHTML += `
      <div class="shape" style="color:${card.color}">
        ${applyFillToSVG(svgContent, card)}
      </div>`;
  }

  const html = `
    <div class="card ${card.color}">
      <div class="shape-container vertical">${shapesHTML}</div>
    </div>
  `;
  return html;
}

// Cargar SVG desde archivo
async function loadSVG(path) {
  const response = await fetch(path);
  return await response.text();
}

// Aplicar el relleno dinámico según la carta
function applyFillToSVG(svgContent, card) {
  let svg = svgContent;

  // Color del trazo
  svg = svg.replace(/stroke="[^"]*"/g, `stroke="${card.color}"`);

  if (card.fill === "color") {
    // Relleno sólido del color de la carta
    svg = svg.replace(/fill="none"/g, `fill="${card.color}"`);
  } else if (card.fill === "none") {
    // Sin relleno
    svg = svg.replace(/fill="[^"]*"/g, `fill="none"`);
  } else if (card.fill === "stripes") {
    // Relleno con patrón, reemplazando color dentro del pattern
    svg = svg.replace(/<rect width="1" height="8" fill="[^"]*"/g, `<rect width="1" height="8" fill="${card.color}"`);
    svg = svg.replace(/fill="none"/g, `fill="url(#stripes)"`);
  }

  return svg;
}
