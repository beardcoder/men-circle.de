import type { Config } from 'tailwindcss'
import defaultTheme from 'tailwindcss/defaultTheme'

export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Jost Variable"', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: {
          DEFAULT: '#b7932b',
          '50': '#faf9ec',
          '100': '#f4f0cd',
          '200': '#eae09e',
          '300': '#dec966',
          '400': '#d3b33c',
          '500': '#b7932b',
          '600': '#a97c25',
          '700': '#875c21',
          '800': '#714b22',
          '900': '#613f22',
          '950': '#382010',
        },
      },
    },
  },
  plugins: [require('flowbite-typography')],
} satisfies Config
