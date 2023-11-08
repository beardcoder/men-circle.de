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
          DEFAULT: '#B76F2B',
          50: '#ECCCAE',
          100: '#E8C19D',
          200: '#E0AD7C',
          300: '#D8985B',
          400: '#D1833A',
          500: '#B76F2B',
          600: '#8A5320',
          700: '#5C3816',
          800: '#2F1C0B',
          900: '#010100',
          950: '#000000',
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
