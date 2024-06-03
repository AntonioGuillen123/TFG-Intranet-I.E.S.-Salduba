/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {},
    colors: {
      black: colors.black,
      white: colors.white,
      gray: colors.slate,
      green: colors.emerald,
      purple: colors.violet,
      yellow: colors.amber,
      pink: colors.fuchsia,
      red: colors.red,
      blue: colors.blue,
      orange: colors.orange,
      indigo: colors.indigo,
      teal: colors.teal,
      lime: colors.lime,
      cyan: colors.cyan,
      rose: colors.rose,
      amber: colors.amber,
      sky: colors.sky,
      emerald: colors.emerald,
      fuchsia: colors.fuchsia,
    }
  },
  plugins: [],
}

