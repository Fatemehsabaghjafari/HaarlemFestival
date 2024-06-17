    <footer>
        <div class="footer-background">
            <form>
                <label for="email">Would you like to be notified </br>
                        for the upcoming events and discounts?</label>
                <div class="subscription-form">
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                    <input class="button" type="submit" value="Subscribe">
                </div>
            </form>
        </div>
        
        <div class="social-footer">
            <div>
                <p>Contact us</p>
                <div class="social-icons">
                    <i class="fas fa-envelope"></i>
                    <i class="fab fa-whatsapp"></i>
                </div>
            </div>
            <div>
                <p>Follow us</p>
                <div class="social-icons">
                    <i class="fab fa-instagram"></i>
                    <i class="fa-brands fa-x-twitter"></i>
                    <i class="fa-brands fa-youtube"></i>
                </div>
            </div>
        </div>
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
