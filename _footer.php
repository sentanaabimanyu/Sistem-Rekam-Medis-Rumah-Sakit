            </div>
        </div>
    </div>
    <script>
    // Toggle class pada sidebar saat tombol menu diklik
    $("#menu-toggle").click(function(e) {
        //Mencegah reload halaman
        e.preventDefault(); 
        // Buka/tutup sidebar
        $("#wrapper").toggleClass("toggled"); 
    });
    </script>
</body>
</html>
