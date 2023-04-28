<?php require APPROOT . '/views/templates/header.php'; ?>
    <header class="container-fluid col-12 p-0">
        <h1 class="display-5 px-4 py-2" style="background-color: darkblue; color: White">
            <?php echo $data["title"]; ?>
        </h1>
    </header>
    <section class="container p-2">
        <?php foreach($data["questions"] as $key => $value ) : ?>
            <div class="card m-3">
                <div class="card-header">
                    <h3><?php echo "Question#".$key ?></h3>
                </div>
            <?php foreach($value as $question => $answer) : ?>
                <div class="card card-body">
                    <h5><?php echo "Q: ". $question ?></h5>
                    <p><?php echo "A: ". $answer ?></p>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endforeach ?>
    </section>

<?php require APPROOT . '/views/templates/footer.php'; ?>