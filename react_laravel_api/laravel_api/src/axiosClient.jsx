

import axios from 'axios';

const AxiosClient = axios.create({
    baseURL: 'http://localhost:8000/api', // Adjust your API base URL
    headers: {
        'Content-Type': 'application/json',
    }
});

// Optionally, add an interceptor to set the Authorization header if a token exists
AxiosClient.interceptors.request.use(config => {
    const token = localStorage.getItem('token'); // Assuming token is stored in localStorage
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

export default AxiosClient;
