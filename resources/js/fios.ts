// fade-in-on-scroll.ts
type Direction = 'left' | 'right' | 'top' | 'bottom'

export function fiosSetup(): void {
  const observer = new IntersectionObserver(
    (entries: IntersectionObserverEntry[]) => {
      for (const entry of entries) {
        if (!entry.isIntersecting) continue
        const direction = entry.target.getAttribute('data-fade') as Direction
        applyAnimation(entry.target as HTMLElement, direction)
        observer.unobserve(entry.target)
      }
    },
    {
      root: null,
      rootMargin: '0px',
      threshold: 0.1,
    },
  )

  document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll<HTMLElement>('[data-fade]')
    for (const element of elements) observer.observe(element)
  })
}

/**
 * Applies an animation to the given element based on the given direction.
 *
 * @param element - the element to apply the animation to
 * @param direction - the direction of the animation
 */
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
