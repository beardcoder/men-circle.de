const dialog = document.querySelector<HTMLDialogElement>(
    '[data-component="newsletter-dialog"]',
);

function closeDialog() {
    dialog?.close();
}

// Funktion, um das letzte Öffnungsdatum zu speichern
function setLastPopupTime() {
    const now = new Date().getTime();
    localStorage.setItem('lastPopupTime', String(now));
}

// Funktion, um das Popup anzuzeigen, wenn es mehr als 2 Stunden her ist
function showPopupIfNeeded() {
    const lastPopupTime = Number(localStorage.getItem('lastPopupTime'));
    const now = new Date().getTime();
    const twoHours = 2 * 60 * 60 * 1000; // Zwei Stunden in Millisekunden

    if (!lastPopupTime || now - lastPopupTime > twoHours) {
        setTimeout(() => {
            dialog?.showModal();
            setLastPopupTime();
        }, 10000); // Popup nach 15 Sekunden öffnen
    }
}

// Zeige das Popup nur alle 2 Stunden
document.addEventListener('DOMContentLoaded', () => {
    showPopupIfNeeded();

    dialog
        ?.querySelector('[data-component="newsletter-dialog__close"]')
        ?.addEventListener('click', closeDialog);
});
