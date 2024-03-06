import '@fontsource-variable/jost'
import 'leaflet/dist/leaflet.css'

import { TwillImage } from '../../vendor/area17/twill-image'


import('flowbite').then(({ initFlowbite }) => {
  initFlowbite()
})

document.addEventListener('DOMContentLoaded', () => {
  new TwillImage()

  const map = document.getElementById('map')
  const leafletLoaded = new Event('leafletLoaded')
  if (map) {
      import('leaflet').then((L) => {
          globalThis.L = L
          document.dispatchEvent(leafletLoaded)
        })
    }
})
