import '@fontsource-variable/jost'
import 'leaflet/dist/leaflet.css'
import 'flowbite'

import { TwillImage } from '../../vendor/area17/twill-image'
import { fiosSetup } from './fios'

document.addEventListener('DOMContentLoaded', () => {
  new TwillImage()
})

fiosSetup()

const map = document.getElementById('map')
const leafletLoaded = new Event('leafletLoaded')
if (map) {
  import('leaflet').then((L) => {
    globalThis.L = L
    document.dispatchEvent(leafletLoaded)
  })
}
