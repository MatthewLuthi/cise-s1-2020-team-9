<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
        use RenanBr\BibTexParser\Listener;
        use RenanBr\BibTexParser\Parser;
        use RenanBr\BibTexParser\Processor;

        require 'vendor/autoload.php';

        $listener = new Listener();
        $listener->addProcessor(new Processor\TagNameCaseProcessor(CASE_LOWER));
    
        $parser = new Parser();
        $parser->addListener($listener);  
    
        $parser->parseFile('/articles/TDD Articles in Bibtex format.bib'); // or parseFile('/path/to/file.bib')
        $entries = $listener->export();

        print_r($entries);

    ?>
</body>
</html>
