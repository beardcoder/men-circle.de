import anime from 'animejs'

type Direction = 'left' | 'right' | 'top' | 'bottom'

export function fiosSetup(): void {
  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return
        applyAnimation(entry.target as HTMLElement)
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
    elements.forEach((element) => {
      const direction = element.getAttribute('data-fade') as Direction
      const { translateX, translateY } = getDirection(direction)
      anime({
        targets: element,
        opacity: 0,
        translateX,
        translateY,
        easing: 'easeInOutCubic',
        duration: 1,
      })
    })
    elements.forEach((element) => observer.observe(element))
  })
}

const directionTranslations: Record<Direction, { translateX: number; translateY: number }> = {
  left: { translateX: -100, translateY: 0 },
  right: { translateX: 100, translateY: 0 },
  top: { translateX: 0, translateY: -100 },
  bottom: { translateX: 0, translateY: 100 },
}

function getDirection(direction: Direction) {
  return directionTranslations[direction]
}

function applyAnimation(element: HTMLElement): void {
  anime({
    targets: element,
    opacity: { value: 1, duration: 1000 },
    translateX: { value: 0, duration: 800 },
    translateY: { value: 0, duration: 800 },
    easing: 'easeInOutCubic',
  })
}
