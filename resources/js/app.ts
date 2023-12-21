import '@fontsource-variable/jost'
import 'flowbite'

import { TwillImage } from '../../vendor/area17/twill-image'
import { fiosSetup } from './fios'

document.addEventListener('DOMContentLoaded', () => {
  new TwillImage()
})

fiosSetup()
