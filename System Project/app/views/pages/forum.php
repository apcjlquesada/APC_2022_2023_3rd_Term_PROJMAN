<?php require APPROOT . '/views/templates/header.php'; ?>
    <header class="container-fluid col-12 p-0">
        <h5 class="display-5 px-4 py-2" style="background-color: darkblue; color: White">
            <?php echo $data['title']; ?>
        </h5>
    </header>
    <section class="container p-2">
        <h3 class="text-center">
            <?php echo $data['heading']; ?>
        </h3>
    </section>

<?php require APPROOT . '/views/templates/footer.php'; ?>