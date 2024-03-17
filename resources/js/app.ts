import '@fontsource-variable/jost'
import 'leaflet/dist/leaflet.css'

import('flowbite').then(({ initFlowbite }) => {
  initFlowbite()
})

document.addEventListener('DOMContentLoaded', () => {
  const map = document.getElementById('map')
  const leafletLoaded = new Event('leafletLoaded')
  if (map) {
      import('leaflet').then((L) => {
          globalThis.L = L
          document.dispatchEvent(leafletLoaded)
        })
    }
})
