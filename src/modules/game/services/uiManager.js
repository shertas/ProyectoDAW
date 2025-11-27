import { generateDeck, generateEasyDeck } from "./deckGenerator.js";
import { shuffleDeck } from "./shuffleDeck.js";
import { renderDeck } from "./deckRenderer.js";
$(document).ready(async function () {
    let deck = generateDeck();
    //let deck = generateEasyDeck();
    let shuffledDeck = shuffleDeck(deck);
    await renderDeck(shuffledDeck);
});
