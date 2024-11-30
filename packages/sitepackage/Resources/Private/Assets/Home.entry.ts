const usePopup = (dialog: HTMLDialogElement) => {
  const lastPopupTime = Number(localStorage.getItem('lastPopupTime'));
  const now = new Date().getTime();
  const twoHours = 2 * 60 * 60 * 1000;

  if (!lastPopupTime || now - lastPopupTime > twoHours) {
    setTimeout(() => {
      dialog?.showModal();
      setLastPopupTime();
    }, 10000);
  }

  dialog
    ?.querySelector('[data-component="newsletter-dialog__close"]')
    ?.addEventListener('click', closeDialog);

  function closeDialog() {
    dialog?.close();
  }

  function setLastPopupTime() {
    const now = new Date().getTime();
    localStorage.setItem('lastPopupTime', String(now));
  }
}
document.addEventListener('DOMContentLoaded', () => {
  Array.from(document.querySelectorAll<HTMLDialogElement>('[data-component="newsletter-dialog"]')).map(usePopup)
});
