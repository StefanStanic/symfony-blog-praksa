const axios = require('axios');
document.addEventListener('DOMContentLoaded', () => {
    initOnDelete();
})


const initOnDelete = () => {
    document.querySelectorAll('.delete_post').forEach(item => {
        //ddocument, sa odredjenim key-em dodamo neki event
        item.addEventListener('click', (e) => {
            const postId = item.getAttribute('data-id');
            let deleteForm = new FormData();
            deleteForm.append('postId', postId);
            axios({
                method: 'post',
                url: '/post/delete',
                data: deleteForm
            }).then((response) => {
                document.getElementById('postData').innerHTML = response.data.html;
                initOnDelete();
            });
        });
    });
}