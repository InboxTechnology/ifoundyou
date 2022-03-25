jQuery(document).ready(function() {
tinymce.init({
		height: "500px",
        plugins: [
            "image code print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link charmap hr pagebreak nonbreaking insertdatetime advlist lists textcolor wordcount contextmenu colorpicker textpattern media "
        ],
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | undo redo | image code | link fontsizeselect  | ',
        automatic_uploads: false,
        selector: '#description',
        file_picker_types: 'image',
        images_upload_url: '{{url("/admin/uploadaboutimage")}}',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/admin/uploadaboutimage');
            var token = $('input[name="_token"]').val();
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];
                console.log(file);
                var id = 'blobid' + (new Date()).getTime();
                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                var blobInfo = blobCache.create(id, file);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            };
            input.click();
        }
    });

});
