<html>

<head>
    <title>Search SEER </title>
</head>>
<h1>Display Search Results  </h1>
<?php

// sql info or use include 'file.inc'
require_once('conf/sqlinfo.php');

// The @ operator suppresses the display of any error messages
// mysqli_connect returns false if connection failed, otherwise a connection value
$conn = @mysqli_connect($sql_host,
    $sql_user,
    $sql_pass,
    $sql_db
);

// Checks if connection is successful
if (!$conn) 
{
    // Displays an error message
    echo "<p>Database connection failure</p>";
}
else
{
    //create table before the rest of the code this is for if there are no tables already in the db
		$db_query = "CREATE TABLE IF NOT EXISTS articleinfo
		(
							practice varchar(50) NOT NULL UNIQUE,
                            citationkey varchar(50),
                            article varchar(50),
							author varchar(50),
							title varchar(50),
                            journal varchar(50),
							year varchar(25),
                            eprint varchar(25),
                            eprinttype varchar(25),
                            eprintclass varchar(25),
                            publisher varchar(25), 
                            volume varchar(50),
                            journalNum number(10),
                            pages varchar(25),
                            annote varchar(25)";
			
			$queryResult = mysqli_query($conn, $db_query) or die ("<p> no table created. check values related to year and date<p>"
			."<p>Error code " . mysqli_errno($conn)
			. ":" . mysqli_error($conn)) . "</p>";

		//create each entry hard codded currently
		$practice = "tdd";
        $article= "Aniche:er";
        $author = "Aniche, M F and Testing, MA Gerosa Software and Verification and and and 2010";
        $title = "Most common mistakes in test-driven development practice: Results from an online survey with developers";
        $journal = "ieeexplore.ieee.org";

        $practice = "tdd";
        $article = "Janzen:2008fx";
        $author = "Janzen, D S and Saiedian, H,";
        $title = "Does Test-Driven Development Really Improve Software Design Quality?";
        $journal = "Software, IEEE";
        $year = "2008";
        $volume = "25";
        $number = "2";
        $pages = "77--84";

        $practice = "tdd";
        $author ="proceedingsAnonymous:O7UPDeq-";
        $title = "A prototype empirical evaluation of test driven development - Software Metrics, 2004. Proceedings. 10th International Symposium on";
        $year = "2001";
        $month = "aug";

        $practice = "tdd";
        $article ="2019arXiv190712290R";
        $author = "Romano, Simone and Fucci, Davide and Baldassarre, Maria Teresa and Caivano, Danilo and Scanniello, Giuseppe";
        $title = "An Empirical Assessment on Affective Reactions of Novice Developers when Applying Test-Driven Development";
        $journal = "arXiv.org";
        $year = "2019";
        $eprint = "1907.12290";
        $eprinttype = "arxiv";
        $eprintclass = "cs.SE";
        $pages = "arXiv:1907.12290";
        $month = "jul";
        $annote = "Accepted for publication at the 20th International Conference on Product-Focused Software Process Improvement (PROFES19)";

        $practice ="tdd";
        $article = "proceedingsVu:2009do";
        $title = "Evaluating Test-Driven Development in an Industry-Sponsored Capstone Project";
        $year = "2009";
        $publisher = "IEEE";
        $month = "mar";
		
		// Set up the SQL command to add the data into the table
		$query = "insert into articleinfo"
						."(SEpractice, article, author, title, year, volume)"
						. "values"
                        ."('$practice','$article','$author','$title', $year, '$publisher')";
                        
    //---------------------------------------------------------------------------------------------------------------------
    // Get data from the form
    $SEpractice = $_GET["SEpractice"];

    // Set up the SQL command to retrieve the data from the table
    // % symbol represent a wildcard to match any characters
    // like is a compairson operator
    $query = "SELECT * FROM $sql_tble WHERE SEpracticeText LIKE '$SEpractice%'";
    
    // executes the query and store result into the result pointer
    $result = mysqli_query($conn, $query);
    // checks if the execuion was successful
    if(!$result) {
        echo "<p>Something is wrong with ",	$query, "</p>";
        echo "<p>Check your table row names and input variables </p>";
    } else {
        // Display the retrieved records
        echo "<table border=\"1\">";
        echo "<tr>\n"
             ."<th scope=\"col\">SEpractice Code</th>\n"
             ."<th scope=\"col\">SEpractice Text</th>\n"
             ."</tr>\n";
        // retrieve current record pointed by the result pointer
        // Note the = is used to assign the record value to variable $row, this is not an error
        // the ($row = mysqli_fetch_assoc($result)) operation results to false if no record was retrieved
        // _assoc is used instead of _row, so field name can be used
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>",$row["SEpracticeCode"],"</td>";
            echo "<td>",$row["SEpracticeText"],"</td>";
            echo "<td>",$row["title"],"</td>";
            echo "<td>",$row["year"],"</td>";
            echo "<td>",$row["volume"]," </td>";
            echo "</tr>";

            echo "SEpractice: ",$row["SEpracticeCode"], "<br>";
            echo "SEpractice Code: ",$row["SEpracticeText"],"<br><br>";
            echo "Share: ",$row["title"],"<br>";
            echo "year Posted: ",$row["year"],"<br>";
            echo "volume: ", $row["volume"],"<br>";
            echo "<br><br>-------------------------------------- <br><br>";
        }
        echo "</table>";
        echo "<br> <a href = searchSEpracticeform.htm>SEpractice search page</a>";
        echo "<br> <a href = index.htm>Home Page<br></a>";

        // Frees up the memory, after using the result pointer
        mysqli_free_result($result);
    } // if successful query operation
    
    // close the database connection
    mysqli_close($conn);
} // if successful database connection

?>

</html>