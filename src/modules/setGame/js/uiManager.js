$(document).ready(async function () {
    let deck = generateDeck();
    //let deck = generateEasyDeck();
    deck = shuffleDeck(deck);
    await renderDeck(deck);
});
