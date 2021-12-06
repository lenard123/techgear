module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  mode: 'jit',
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    extend: {

      colors: {
        primary: {
          lighter: '#93C5FD',
          DEFAULT: '#3B82F6',
          darker: '#1D4ED8'
        }
      },

      fontFamily: {
        iceland: ['Iceland', 'cursive']
      },

      transitionProperty: {
        left: 'left',
        right: 'right'
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
