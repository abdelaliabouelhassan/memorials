

import axios from 'axios';
import router from '../router/routes'

// Configure the default headers for axios:
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// If there's a token in the localStorage, set it as the default Authorization header:
if (localStorage.getItem('token')) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
}
// Handle token expiration or invalid tokens:
axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            // Remove the token from local storage:
            localStorage.removeItem('token');
            // Reset the axios Authorization header:
            axios.defaults.headers.common['Authorization'] = 'Bearer';
            // Redirect the user to the login page:
            if (!window.location.pathname.startsWith('/profile/')) {
                // Redirect the user to the login page:
                router.push({ name: 'login' });
            }
            
        }
        return Promise.reject(error);
    }
);

