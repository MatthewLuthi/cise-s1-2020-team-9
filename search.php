<html>

<head>
    <title>Search SEER </title>
</head>>
<h1>Display Search Results  </h1>
<?php

// sql info or use include 'file.inc'
require_once('conf/sqlinfo.inc.php');

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
    //create table before the rest of the code 
		$db_query = "CREATE TABLE IF NOT EXISTS postStatus
		(
							StatusCode varchar(5) NOT NULL UNIQUE,
							StatusText varchar(255) NOT NULL,
							SharePermission varchar(10),
							Date varchar(10),
							Permission varchar(50))";
			
			$queryResult = mysqli_query($conn, $db_query) or die ("<p> no table created.<p>"
			."<p>Error code " . mysqli_errno($conn)
			. ":" . mysqli_error($conn)) . "</p>";

		// Get data from the form
		$statusCode    = $_POST["statuscode"];
        $statusText	= $_POST["statustext"];
		$sharePermission= $_POST["share"];
		$date = $_POST["date"];
		$permissionType = $_POST["Permission"];

		$selectedPermission = implode(", ",$permissionType);
		

		// Set up the SQL command to add the data into the table
		$query = "insert into postStatus"
						."(StatusCode, StatusText, SharePermission, Date, Permission)"
						. "values"
						."('$statusCode','$statusText','$sharePermission', $date, '$selectedPermission')";
    
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
            echo "<td>",$row["SharePermission"],"</td>";
            echo "<td>",$row["Date"],"</td>";
            echo "<td>",$row["Permission"]," </td>";
            echo "</tr>";

            echo "SEpractice: ",$row["SEpracticeCode"], "<br>";
            echo "SEpractice Code: ",$row["SEpracticeText"],"<br><br>";
            echo "Share: ",$row["SharePermission"],"<br>";
            echo "Date Posted: ",$row["Date"],"<br>";
            echo "Permission: ", $row["Permission"],"<br>";
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