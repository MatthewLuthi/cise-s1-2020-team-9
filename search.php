<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/pcooksey/bibtex-js/src/bibtex_js.js"></script>
</head>
<body>
    <bibtex src="bibtex/TDD Articles in Bibtex format.bib"></bibtex>
    <!-- <div id="bibtex_display"></div> -->
    <?php
    for ($x = 0; $x <= 10; $x++) {
        echo '<div id="bibtex_display"></div>';
    }
    ?>
</body>
</html>
