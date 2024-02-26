/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./view/**/*.{php, js, html}",
    "./view/dashboard.php",
    "./index.php"
  ],
  theme: {
    extend: {
      colors: {
        'principal': '#696969',
        'azul-oscuro': '#0d1b3e',
      }
    },
  },
  plugins: [require("daisyui")],
}

