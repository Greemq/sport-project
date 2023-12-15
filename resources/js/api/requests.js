import client from "../api/index.js";

const requests = {
    fileUpload(data) {
        return client.post('/api/file-upload', data,{headers: {'content-type': 'multipart/form-data'}}).then(res => res.data);
    },
    getNewsList() {
        return client.get('/api/news').then(res => res.data);
    },
    getNewsItem(id) {
        return client.get('/api/news/' + id).then(res => res.data);
    },
    createNewsItem(data) {
        return client.post('/api/news', data).then(res => {
            return res.data;
        });
    },
    updateNewsItem(id, data) {
        return client.post('/api/news/' + id, data).then(res => res.data);
    }
};

export default requests;
