/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
        primary:'#1D3655'
      },
      fontFamily:{
        Inter:['Inter','sans-serif'],
        Altivo:['Altivo','sans-serif']
      }
    },
  },
  plugins: [],
}