/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./view/**/*.{php,js}",
    "./index.php"
  ],
  theme: {
    extend: {
      colors: {
        'azul-claro': '#243cff',
        'azul-oscuro': '#0d1b3e',
      }
    },
  },
  plugins: [],
}

