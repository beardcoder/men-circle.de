import '@fontsource-variable/jost'

import { TwillImage } from '../../vendor/area17/twill-image'

document.addEventListener('DOMContentLoaded', () => {
  new TwillImage()
})

document.addEventListener('DOMContentLoaded', () => {
  const target = document.querySelector('[data-apper]')
  if (!target) return

  target.classList.add('opacity-0')
  target.classList.add('-translate-x-10')
  target.classList.add('transition-all')
  target.classList.add('duration-1000')
  const callback = (entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) {
        return
      }
      entry.target.classList.add('opacity-100')
      entry.target.classList.add('translate-x-0')
    })
  }

  new IntersectionObserver(callback, { threshold: 0.2 }).observe(target)
})
