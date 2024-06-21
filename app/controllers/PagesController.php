<?php

require_once __DIR__ . '/../services/PagesService.php';
require_once __DIR__ . '/../services/DanceService.php';

class PagesController extends Controller
{
    private $service;
    private $danceService;
    public function __construct()
    {
        $this->service = new \App\Services\PagesService();
        $this->danceService = new \App\Services\DanceService();
    }

    public function index($name) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processPreviewContent();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $page = $this->service->getPage($name);

            // process the body content
            ob_start();
            eval("?>" . $page->getBody());
            $processedContent = ob_get_clean();
            $page->setBody($processedContent);

            include '../views/page.php';
        }
    }

    public function listPages($error = null) {
        $pages = $this->service->listAllPages();
        include '../views/admin/pages.php';
    }

    public function pageEditorView($name) {
        $page = $this->service->getPage($name);
        include '../views/admin/pageEditor.php';
    }

    public function createPage() {
        try {
            $name = $_POST['name'];
            $title = $_POST['title'];
            $body = "";

            $result = $this->service->addPage($name, $title, $body);

            if (!$result) {
                echo "Failed to add page";
                return;
            }

            header('Location: /admin/pages');
        } catch (Exception $e) {
            $this->listPages($e->getMessage());
            return;
        }
    }

    public function deletePage() {
        $id = $_POST['id'];

        $result = $this->service->deletePage($id);

        if (!$result) {
            echo "Failed to delete page";
            return;
        }

        header('Location: /admin/pages');
    }

    public function updatePage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $title = $_POST['title'];
            $body = $_POST['body'];

            $result = $this->service->updatePage($id, $name, $title, $body);

            if (!$result) {
                echo "Failed to update page";
                return;
            }

            header('Location: /admin/pages');
        }
    }

    public function processPreviewContent() {
        $content = $_POST['content'];

        ob_start();
        eval("?>" . $content);
        $processedContent = ob_get_clean();
        echo $processedContent;
    }
}