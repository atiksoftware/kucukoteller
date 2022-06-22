// import BalloonEditor from '@ckeditor/ckeditor5-build-balloon';
// import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
import BalloonEditor from '@ckeditor/ckeditor5-build-balloon-block';
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

(()=>{

    let textareas = document.querySelectorAll('.textarea');

    textareas.forEach(textarea => { 
        let placeholder = textarea.getAttribute("placeholder");
        if(placeholder == null){
            placeholder = "Buraya bir metin yazınız...";
        }
        // get next div element after textarea
        let nextDiv = textarea.nextElementSibling; 
        if(nextDiv != null){
            nextDiv.remove();
        }

        const div = document.createElement("div"); 
        textarea.parentNode.insertBefore(div, textarea.nextSibling); 


        // BalloonEditor
        BalloonEditor
        .create(div, {
            placeholder: placeholder
        })
        .then(editor => {
            editor.setData( textarea.value ); 
            editor.model.document.on('change:data', () => {
                textarea.value = editor.getData();
            });
        })
        .catch(error => { 
        });
    })


})();


