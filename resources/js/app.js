import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

let themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
let themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

if (
  localStorage.getItem("color-theme") === "dark" || (!("color-theme" in localStorage) &&window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  document.documentElement.classList.add("dark"); // <-- Add this line
  themeToggleLightIcon.classList.remove("hidden");
} else {
  document.documentElement.classList.remove("dark"); // <-- Add this line (optional, for clarity)
  themeToggleDarkIcon.classList.remove("hidden");
}

let themeToggleBtn = document.getElementById("theme-toggle");

themeToggleBtn.addEventListener("click", function () {
  // Toggle icons
  themeToggleDarkIcon.classList.toggle("hidden");
  themeToggleLightIcon.classList.toggle("hidden");

  // Toggle dark mode
  const isDark = document.documentElement.classList.toggle("dark");
  
  // Save to localStorage
  localStorage.setItem("color-theme", isDark ? "dark" : "light");
});