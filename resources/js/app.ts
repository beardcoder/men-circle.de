import '@fontsource-variable/jost'
import 'leaflet/dist/leaflet.css'
import 'flowbite'

import { TwillImage } from '../../vendor/area17/twill-image'
import AOS from 'simple-aos'

document.addEventListener('DOMContentLoaded', () => {
  new TwillImage()
})
AOS.init({
  once: true,
})

const map = document.getElementById('map')
const leafletLoaded = new Event('leafletLoaded')
if (map) {
  import('leaflet').then((L) => {
    globalThis.L = L
    document.dispatchEvent(leafletLoaded)
  })
}
