// fade-in-on-scroll.ts
type Direction = 'left' | 'right' | 'top' | 'bottom'

export function fiosSetup(): void {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return
        }

        const direction = entry.target.getAttribute('data-fade') as Direction
        applyAnimation(entry.target as HTMLElement, direction)
        observer.unobserve(entry.target)
      })
    },
    {
      root: null,
      rootMargin: '0px',
      threshold: 0.1,
    },
  )

  document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll<HTMLElement>('[data-fade]')
    elements.forEach((element) => observer.observe(element))
  })
}

function applyAnimation(element: HTMLElement, direction: Direction): void {
  element.style.opacity = '1'
  switch (direction) {
    case 'left':
      element.style.transform = 'translateX(0)'
      break
    case 'right':
      element.style.transform = 'translateX(0)'
      break
    case 'top':
      element.style.transform = 'translateY(0)'
      break
    case 'bottom':
      element.style.transform = 'translateY(0)'
      break
  }
}
