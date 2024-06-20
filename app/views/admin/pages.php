<?php
    /**
     * @var Page $page
     */
    $stylesheets = [
        'css/home.css',
    ];
    $title = 'Pages - Admin';
    include __DIR__ . '/../adminHeader.php';

?>
    <main>
        <div class="container mt-5">
            <h2>Add New Page</h2>
            <?php if (isset($error) && !empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form action="/admin/createpage" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">URL</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="home-page">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Home Page">
                </div>
                <button type="submit" class="btn btn-primary">Add Page</button>
            </form>

            <hr>

            <h2>All Pages</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>URL</th>
                    <th>Title</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td>
                            <?php echo $page->getId(); ?>
                        </td>
                        <td>
                            <a href="/pages/<?php echo $page->getName(); ?>" target="_blank"><?php echo "/pages/" . $page->getName(); ?></a>
                        </td>
                        <td>
                            <?php echo $page->getTitle(); ?>
                        </td>
                        <td class="text-end">
                            <a href="/admin/pageeditor/<?php echo $page->getName(); ?>" class="btn btn-primary btn-sm">Edit</a>
                            <form action="/admin/deletepage" method="POST" class="d-inline-block">
                                <input type="hidden" name="id" value="<?php echo $page->getId(); ?>">
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<?php
    include __DIR__ . '/footer.php';
?>