<div class="bg-info p-2 text-center">
    <hr>
    <p>All rights reserved &copy;- Designed by Khanam-2022</p>
</div>

<!-- cdn js -->
<?php require "./js/scriptlinks.html" ?>

<script>
    cartNo = document.getElementById('cartNo');
    cartNo.textContent = <?php Query::showCartNum(); ?>;
</script>
</body>

</html>