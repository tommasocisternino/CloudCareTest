const AuthService = {
    login: (payload) => {
        return axios.post('/login', payload, {
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
            }
        });
    } ,

    logout: () => {
        return axios.get('/logout', {
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Authorization': USER_INFO.type+" "+ USER_INFO.access_token,
            }
        });
    }
}
