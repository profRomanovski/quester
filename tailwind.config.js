module.exports = {
    mode: 'jit',
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            background: '#fff',
            background_form: '#a680ff',
            background_details: '#65B8B0'
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
