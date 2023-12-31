import client from "../api/index.js";

const requests = {
    changeTheme(data) {
        return client.post('/api/change_theme', data).then(res => res.data);
    },
    getScheme() {
        return client.get('/api/get_theme').then(res => res.data);
    },
    fileUpload(data) {
        return client.post('/api/file-upload', data, {headers: {'content-type': 'multipart/form-data'}}).then(res => res.data);
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
        return client.post('/api/news/' + id + '/update', data).then(res => res.data);
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
        return client.post('/api/calendar_results/' + id + '/update', data).then(res => res.data);
    },
    getFilesList() {
        return client.get('/api/files').then(res => res.data);
    },
    getFilesItem(id) {
        return client.get('/api/files/' + id).then(res => res.data);
    },
    createFilesItem(data) {
        return client.post('/api/files', data).then(res => {
            return res.data;
        });
    },
    updateFilesItem(id, data) {
        return client.post('/api/files/' + id + '/update', data).then(res => res.data);
    },
    getAthleteList() {
        return client.get('/api/athlete').then(res => res.data);
    },
    getAthleteItem(id) {
        return client.get('/api/athlete/' + id).then(res => res.data);
    },
    createAthleteItem(data) {
        return client.post('/api/athlete', data).then(res => {
            return res.data;
        });
    },
    updateAthleteItem(id, data) {
        return client.post('/api/athlete/' + id + '/update', data).then(res => res.data);
    },
    applicationsList(data) {
        return client.get('/api/applications', {params: data}).then(res => res.data);
    },

    getGalleryList(data) {
        return client.get('/api/photo_gallery', {params: data}).then(res => res.data);
    },
    getGalleryItem(id) {
        return client.get('/api/photo_gallery/' + id).then(res => res.data);
    },
    createGalleryItem(data) {
        return client.post('/api/photo_gallery', data).then(res => res.data);
    },
    updateGalleryItem(id, data) {
        return client.post('/api/photo_gallery/' + id + '/update', data).then(res => res.data);
    },
    getVideoGalleryList(data) {
        return client.get('/api/video_gallery', {params: data}).then(res => res.data);
    },
    getVideoGalleryItem(id) {
        return client.get('/api/video_gallery/' + id).then(res => res.data);
    },
    createVideoGalleryItem(data) {
        return client.post('/api/video_gallery', data).then(res => res.data);
    },
    updateVideoGalleryItem(id, data) {
        return client.post('/api/video_gallery/' + id + '/update', data).then(res => res.data);
    },
    getUsersList(data) {
        return client.get('/api/users', {params: data}).then(res => res.data);
    },
    getUsersItem(id) {
        return client.get('/api/users/' + id).then(res => res.data);
    },
    updateUsersItem(id, data) {
        return client.get('/api/users/' + id, data).then(res => res.data);
    },
    createUsersItem(data) {
        return client.post('/api/users', data).then(res => {
            return res.data;
        });
    },

};

export default requests;
