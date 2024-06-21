<?php
    $stylesheets = [
        '/css/home.css',
        '/css/dance.css',
        '/css/admin.css'
    ];
    $title = 'Page Editor - Admin';
    include __DIR__ . '/../adminHeader.php';

    $content = $page->getBody();
?>

<h1 class="text-center fw-bolder text-dark ff-alata display-5 mt-3">Page Editor</h1>

<div class="d-flex justify-content-center">
    <button class="btn btn-outline-success px-3 my-4 py-3 m-2"  onclick="document.location.href='/admin/pages'">Back</button>
    <button class="btn btn-warning px-5 my-4 py-3 m-2" id="previewBtn" onclick="previewContent(this)">Preview</button>
    <button class="btn btn-danger px-5 my-4 py-3 m-2" onclick="saveContent()">Save</button>
</div>

<form method="post" action="" id="editor-form" name="form">
    <textarea name="editor" id="editor">
    <?= $content; ?>
    </textarea>
</form>
<div id="preview">
    <h3 class="text-center font-weight-bold">Preview</h3>

    <?php
    include __DIR__ . '/../header.php';
    ?>
    <span id="contentPlaceholder"></span>
    <?php
    include __DIR__ . '/../footer.php';
    ?>
</div>


<script>
    document.getElementById("preview").hidden = true;
    CKEDITOR.replace('editor');
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.height = 680;
    CKEDITOR.config.disallowedContent = 'img';
    CKEDITOR.addCss('.cke_editable img { max-width: 100% !important; height: auto !important; }');

    function previewContent(btn) {
        btn.textContent = (btn.textContent == "Continue editing") ? "Preview" : "Continue editing";
        var data = CKEDITOR.instances.editor.getData();
        data = data.replaceAll("!--", "").replaceAll("?--", "?");

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/admin/pagepreview", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                document.getElementById("contentPlaceholder").innerHTML = xhr.responseText;
                document.getElementById("editor-form").toggleAttribute("hidden");
                document.getElementById("preview").toggleAttribute("hidden");
            }
        };

        xhr.send("content=" + encodeURIComponent(data));
    }

    function saveContent() {
        var data = CKEDITOR.instances.editor.getData();
        data = data.replaceAll("!--", "").replaceAll("?--", "?");
        console.log(data);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/admin/updatepage", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                Swal.fire({
                    title: 'Success',
                    text: 'Content saved successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }
        };

        xhr.send("id=<?= $page->getId(); ?>&name=<?= $page->getName(); ?>&title=<?= $page->getTitle(); ?>&body=" + encodeURIComponent(data));
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>