        </div> <!-- End of main-content -->
    </div> <!-- End of wrapper -->

    <footer class="admin-footer">
        <div class="footer-content">
            <p>&copy; <?= date('Y') ?> Foody Catering - Admin Panel</p>
        </div>
    </footer>

    <script>
    $(document).ready(function() {
        // Toggle sidebar on mobile
        $('#sidebarToggle').click(function() {
            $('.wrapper').toggleClass('sidebar-open');
        });
        
        // Tooltip initialization
        $('[data-toggle="tooltip"]').tooltip();
        
        // Prevent double form submission
        $('form').on('submit', function() {
            $(this).find('button[type="submit"]').prop('disabled', true);
        });
    });
    </script>
</body>
</html>
