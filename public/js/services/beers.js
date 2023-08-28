const userInfo = JSON.parse(localStorage.getItem('user_info'));

const BeerService = {
    check: () => {
        return axios.get('/api/v1/check', {
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Authorization': userInfo.type+" "+ userInfo.access_token,
            }
        });
    }
}
