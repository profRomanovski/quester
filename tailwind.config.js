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
            background: '#7FC8F8',
            background_form: '#ac80ff',
            background_details: '#65B8B0',
            background_light_form:'#757bc8'

        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
