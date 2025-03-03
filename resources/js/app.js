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
    Array.from(elem.files).forEach((file) => {
      const blobUrl = window.URL.createObjectURL(file);
      output += `<div>
          <img id="item_image" src="${blobUrl}">
          <button type="button" class="change-pic-btn absolute top-0 right-0 bg-blue-600 dark:bg-blue-700 text-white dark:text-gray-800 rounded-md px-2 py-1 text-xs">
            Click Here To Change the pictures
          </button>
        </div>`;
    });
    previewArea.innerHTML = output;

   
    document.querySelectorAll('.change-pic-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        fileInput.click();
      });
    });
  };
// window.choseAgain = function() {
//   document.getElementById('item_file').click();};
//  i have used this function to call the file input but its exposed to the window object (window.choseAgain) and i dont want that so i used the event listener instead :)
  
  // fileInput.addEventListener('change', () => preview(fileInput));
});
