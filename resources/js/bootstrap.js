import axios from 'axios';
// import Echo from 'laravel-echo';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



// window.Echo = new Echo({
//     broadcaster: 'reverb',
//     key: import.meta.env.VITE_REVERB_APP_KEY,
//     wsHost: import.meta.env.VITE_REVERB_HOST,
//     wsPort: import.meta.env.VITE_REVERB_PORT,
//     forceTLS: import.meta.env.VITE_REVERB_SCHEME === 'https',
//     enabledTransports: ['ws', 'wss'],
//   });
  