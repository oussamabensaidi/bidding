import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

let themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
let themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

if (
  localStorage.getItem("color-theme") === "dark" || (!("color-theme" in localStorage) &&window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  document.documentElement.classList.add("dark"); 
  themeToggleLightIcon.classList.remove("hidden");
} else {
  document.documentElement.classList.remove("dark"); 
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



document.addEventListener('DOMContentLoaded', () => {
  const fileInput = document.getElementById('item_file');
  const previewArea = document.querySelector('.preview-area');
  const imageInput = document.getElementById('image-input');
  const imagePreview = document.querySelector('#image-preview');

  const preview = (elem, output = '') => {
    imageInput.style.display = "none";
    imagePreview.style.display = "block";

    Array.from(elem.files).forEach((file, index) => {
      const blobUrl = window.URL.createObjectURL(file);
      // Only add the button to the first image
      if (index === 0) {
        output += `<div class="relative inline-block">
        <button type="button" class="change-pic-btn absolute top-1 left-1 bg-blue-600 dark:bg-blue-700 text-white dark:text-gray-800 rounded-md px-3 py-1 text-xs whitespace-nowrap">
          Click Here To Change the Pictures
        </button>
            <img src="${blobUrl}" class="preview-image">
          </div>`;
      } else {
        output += `<div class="inline-block">
            <img src="${blobUrl}" class="preview-image">
          </div>`;
      }
    });

    previewArea.innerHTML = output;

    // Add click handler to the button
    const changePicBtn = document.querySelector('.change-pic-btn');
    if (changePicBtn) {
      changePicBtn.addEventListener('click', () => fileInput.click());
    }
  };

  fileInput.addEventListener('change', () => preview(fileInput));
});