$(document).ready(function() {
    ClassicEditor
        .create($('#addContentEditor')[0])
        .then(editor => {
            editor.model.document.on('change', () => {
                $('#addContent').val(editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create($('#addDescriptionEditor')[0])
        .then(editor => {
            editor.model.document.on('change', () => {
                $('#addDescription').val(editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });


});
