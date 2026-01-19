<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ title }}</title>

    <link href="../third/jscss/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

<nav class="navbar navbar-expand navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="index.php?a=home">ConfortClasses</a>

    <div class="ms-auto">
        <a class="btn btn-sm btn-outline-light me-2"
           href="index.php?a=login">Login</a>

        <a class="btn btn-sm btn-outline-warning"
           href="index.php?a=logout">Logout</a>
    </div>
</nav>

{% if menu is defined %}
    {{ menu | raw }}
{% endif %}

<main class="container mt-4">
    {{ content | raw }}
</main>

{% if footer is defined %}
    {{ footer | raw }}
{% endif %}

<script src="../third/jscss/bootstrap.min.js"></script>
</body>
</html>
