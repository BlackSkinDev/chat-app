
export const httpGet = async(url) => {
    let token = localStorage.getItem("access_token")
    const headers = {};
    if (token) headers.authorization = `Bearer ${token}`;

    const options = {
        url,
        method: 'GET',
        headers,
    };

    return new Promise(async (resolve, reject) => {
        try {
            const { data } = await axios(options);
            resolve(data)
        } catch (err){
            reject(err.response);
        }
    });
}

export const httpPost = async (url, data) => {
    let token = localStorage.getItem("access_token")
    const headers = {};
    if (token) headers.authorization = `Bearer ${token}`;

    const options = {
        url,
        method: 'POST',
        headers,
        data
    };

    return new Promise(async (resolve, reject) => {
        try {
            const { data } = await axios(options);
            resolve(data)
        } catch (err){
            reject(err.response);
        }
    })
}
