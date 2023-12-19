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
        return client.post('/api/calendar_results/' + id, data).then(res => res.data);
    },
    getCalendarResultsList() {
        return client.get('/api/calendar_results').then(res => res.data);
    },
    getCalendarResultsItem(id) {
        return client.get('/api/calendar_results/' + id).then(res => res.data);
    },
    createCalendarResultsItem(data) {
        return client.post('/api/calendar_results', data).then(res => {
            return res.data;
        });
    },
    updateCalendarResultsItem(id, data) {
        return client.post('/api/calendar_results/' + id, data).then(res => res.data);
    },

};

export default requests;
