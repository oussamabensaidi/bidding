import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import { Reverb } from '@ably/reverb';

// Configure Reverb
window.Echo = new Echo({
    broadcaster: Reverb,
    key: import.meta.env.VITE_REVERB_KEY, // Use your Reverb key from .env
    wsHost: import.meta.env.VITE_REVERB_HOST || 'realtime.ably.io',
    wsPort: import.meta.env.VITE_REVERB_PORT || 443,
    disableStats: true,
    forceTLS: true
});
