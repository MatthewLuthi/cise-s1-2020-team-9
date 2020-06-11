<DOCTYPE! html>
<html>
<head>
</head>
<body>
<?php
    use RenanBr\BibTexParser\Listener;
    use RenanBr\BibTexParser\Parser;
    use RenanBr\BibTexParser\Processor;

    require 'vendor/autoload.php';

    $bibtex = <<<BIBTEX
    @article{einstein1916relativity,
    title={Relativity: The Special and General Theory},
    author={Einstein, Albert},
    year={1916}
    }
    BIBTEX;

    $listener = new Listener();
    $listener->addProcessor(new Processor\TagNameCaseProcessor(CASE_LOWER));
    
    $parser = new Parser();
    $parser->addListener($listener);  
    
    $parser->parseString($bibtex); // or parseFile('/path/to/file.bib')
    $entries = $listener->export();

    print_r($entries);
?>
</body>
</html>