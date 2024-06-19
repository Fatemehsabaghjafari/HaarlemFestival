    <footer>

    </footer>

    <?php
        if (isset($scripts) && is_array($scripts)) {
            foreach ($scripts as $script) {
                if (is_array($script)) {
                    echo '<script';
                    foreach ($script as $attribute => $value) {
                        echo ' ' . htmlspecialchars($attribute, ENT_QUOTES) . '="' . htmlspecialchars($value, ENT_QUOTES) . '"';
                    }
                    echo '></script>';
                } else {
                    echo '<script src="' . htmlspecialchars($script, ENT_QUOTES) . '"></script>';
                }
            }
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
</body>
</html>
