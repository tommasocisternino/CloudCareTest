const AuthService = {
    login: (payload) => {
        return axios.post('/login', payload, {
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
            }
        });
    }
}
