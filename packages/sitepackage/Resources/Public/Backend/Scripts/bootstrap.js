let editorPromise = null;

function loadScript(url)
{
    return new Promise((resolve, reject) => {
        const newScript = document.createElement('script');
        newScript.async = true
        newScript.onerror = reject;
        newScript.onload = (ev) => resolve(ev);
        newScript.src = url;
        document.head.appendChild(newScript);
    });
}

function loadEditor()
{
    if (editorPromise === null) {
        const scriptUrl = import.meta.url.replace(/\/[^\/]+\.js/, '/Contrib/jodit.min.js')
        editorPromise = loadScript(scriptUrl).then(() => window.Jodit);
    }
    return editorPromise;
}
const prefersLightColorScheme = () =>
  window &&
  window.matchMedia &&
  window.matchMedia('(prefers-color-scheme: light)').matches;

loadEditor().then(Jodit => {
    new Jodit('#message', {
        theme: prefersLightColorScheme() ? 'light' : 'dark',
    });
})
