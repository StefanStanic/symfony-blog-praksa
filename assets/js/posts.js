const axios = require('axios');
document.addEventListener('DOMContentLoaded', () => {
    initOnDelete();
    initOnUpdate();
    initOnUpdateClick();
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

const initOnUpdate = () => {
    document.querySelectorAll('.update_post').forEach(item => {
        item.addEventListener('click', (e) => {
            const title = item.getAttribute('data-title');
            const short_text = item.getAttribute('data-short-text');

            //populate inputs with current values
            document.getElementById('title').value = title;
            document.getElementById('short_text').value = short_text;
        })
    })
}

const initOnUpdateClick = () => {
    document.getElementById('update_post_button').addEventListener('click', () => {
        const title = document.getElementById('title').value;
        const short_text = document.getElementById('short_text').value;
        let updateForm = new FormData();
        updateForm.append('title', title);
        updateForm.append('short_text', short_text);


        //post request
        axios({
            method: 'post',
            url: '/post/update',
            data: updateForm
        }).then((response) => {
            document.getElementById('postData').innerHTML = response.data.html;
            initOnUpdate();
        });
    })
}