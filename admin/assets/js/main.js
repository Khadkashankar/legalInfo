$(document).ready(function() {
    ClassicEditor
        .create(document.querySelector('#addContentEditor'))
        .then(editor => {
            editor.model.document.on('change', () => {
                document.getElementById('addContent').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#addDescriptionEditor'))
        .then(editor => {
            editor.model.document.on('change', () => {
                document.getElementById('addDescription').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
});
