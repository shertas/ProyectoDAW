$(document).ready(async function () {
    let deck = generateDeck();
    deck = shuffleDeck(deck);
    await renderDeck(deck);
});
