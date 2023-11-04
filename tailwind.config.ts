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
        secondary: {
          DEFAULT: '#004c45',
          '50': '#ecfffc',
          '100': '#bdfff8',
          '200': '#7bfff3',
          '300': '#31ffee',
          '400': '#00ffe1',
          '500': '#00edc9',
          '600': '#00bfa7',
          '700': '#009786',
          '800': '#00776c',
          '900': '#004c45',
          '950': '#003d3a',
        },
      },
    },
  },
  plugins: [require('flowbite-typography')],
} satisfies Config
