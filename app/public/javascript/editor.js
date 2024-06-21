import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import ImageTool from '@editorjs/image';

// Initialize Editor.js
const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        header: Header,
        list: List,
        image: {
            class: ImageTool,
            config: {
                endpoints: {
                    byFile: 'http://localhost:8008/uploadFile', // Your backend file uploader endpoint
                    byUrl: 'http://localhost:8008/fetchUrl', // Your endpoint that provides uploading by URL
                }
            }
        }
    }
});

// Save button handler
document.getElementById('save-button').addEventListener('click', () => {
    editor.save().then((outputData) => {
        console.log('Article data: ', outputData);
    }).catch((error) => {
        console.error('Saving failed: ', error);
    });
});