import jwt_decode from "jwt-decode";

// export const baseURL = 'https://crm.nbfx.tech/api';
// export const config = {
//     baseURL,
//     headers: {
//         'Content-Type': 'application/json',
//     },
//     proxy: {
//         protocol: 'https',
//         host: 'crm.nbfx.tech',
//         port: 443,
//     },
// };

const authProvider = {
    login: ({ username, password }) => {
        const request = new Request('https://crm.nbfx.tech/api/login_check', {
            method: 'POST',
            headers: new Headers({ 'Content-Type': 'application/json' }),
            body: JSON.stringify({ username, password }),
        });
        return fetch(request)
            .then(res => res.json())
            .then(({ token }) => {
                localStorage.setItem('token', token);
            })
            .catch(() => {
                throw new Error('Network error');
            });
    },
    logout: () => {
        localStorage.removeItem('token');
        return Promise.resolve();
    },
    checkAuth: () => localStorage.getItem('token') ? Promise.resolve() : Promise.reject(),
    checkError: (error) => {
        const status = error.status;
        if (status === 401 || status === 403) {
            localStorage.removeItem('token');
            return Promise.reject();
        }
        // other error code (404, 500, etc): no need to log out
        return Promise.resolve();
    },
    getIdentity: () => {
        console.log(jwt_decode(localStorage.getItem('token')));
        return Promise.resolve({
            id: 'user',
            fullName: 'John Doe',
        });
    },
    getPermissions: () => Promise.resolve(''),
};

export default authProvider;