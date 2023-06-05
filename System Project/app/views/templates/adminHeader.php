<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ."/flickity.css"; ?>" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
    <title><?php echo SITENAME; ?></title>
    
    <script type="text/javascript" language="JavaScript">
        var element = document.querySelector("form");
        element.addEventListener("submit", function(event) {
            event.preventDefault();
            // actual logic, e.g. validate the form
            alert("Form submission cancelled.");
        });
    </script>
</head>
<body>
<header class="container-fluid bg-warning p-3">
    <div class="row d-flex align-items-center mx-3">
        <div class="col-1 bg-gradient text-center" style="background-color: darkblue">
            <p class="display-5 fw-bold text-warning">V</p>
        </div>
        <div class="col-5 text-white">
            <h5>
                <?php echo SITENAME; ?>
            </h5>
        </div>
        <div class="col-6 text-white text-end">
            <h5>
                <?php echo CATCHPHRASE; ?>
            </h5>
        </div>
    </div>

</header>

<?php require APPROOT . '/views/templates/adminNavbar.php'; ?>
<div class="container">
<?php flash('message'); ?>