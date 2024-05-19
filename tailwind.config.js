/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./templates/*.php",
    "./homepage/*.php",
    "./auth/*.php",
    "./anggota/*.php",
    "./respository/*.php",
  ],
  theme: {
    screens: {
      sm: "480px",
      md: "768px",
      lg: "976px",
      xl: "1440px",
    },
    extend: {
      fontFamily: {
        header: ["Poppins"],
        body: ["Ubuntu"],
        fancy: ["Figtree"],
      },
      colors: {
        primary: "#FAF7F5",
        secondary: "#908393",
        header: "#291334",
        focus: "#D0CACE",
        fancy: "#EE6352",
        brightRed: "hsl(12, 88%, 59%)",
      },
    },
  },
  plugins: [],
};
