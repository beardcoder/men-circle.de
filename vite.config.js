import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.ts'],
      refresh: true,
    }),
  ],

  server: {
    host: true,
    hmr: {
      host: process.env.DDEV_HOSTNAME,
      protocol: 'wss',
    },
  },
})
