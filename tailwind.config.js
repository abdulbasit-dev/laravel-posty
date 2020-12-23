const colors = require('tailwindcss/colors')

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    pagination: theme => ({
        color: theme('colors.purple.600'),
        linkFirst: 'mr-6 border rounded',
        linkSecond: 'rounded-l border-l',
        linkBeforeLast: 'rounded-r border-r',
        linkLast: 'ml-6 border rounded',
    }),
      extend: {
        colors: {
            "primary": "#2D3748",
        }
      }
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('tailwindcss-plugins/pagination')
  ],
}
