import axios from 'axios';

const BASE_URL = "http://localhost:80/api";

export const equipmentClient = axios.create({
    baseURL: BASE_URL,
    withCredentials: true
});