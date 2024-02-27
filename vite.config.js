import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

const port = 5173
const origin = `${process.env.DDEV_PRIMARY_URL}:${port}`

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.ts'],
      refresh: true,
    }),
  ],

  server: {
    host: '0.0.0.0',
    port,
    strictPort: true,
    origin,
  },
})
