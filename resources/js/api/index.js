import axios from "axios";

const client = axios.create({
    baseURL: import.meta.env.BASE_URL || 'http://localhost',
    headers: {
        'Content-Type': 'application/json',
    },
});

export const setTokenToClient = token => {
    client.defaults.headers.common.Authorization = 'Bearer ' + token;
};
export const removeTokenFromClient = () => {
    delete client.defaults.headers.common.Authorization;
};


export default client;
