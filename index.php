<?php
$base    = getenv('BASE');
$typedb  = getenv('TYPEDB');
$serveur = getenv('SERVEUR');
$port    = getenv('PORT');
$user    = getenv('USER');
$paswd   = getenv('PASWD');
$table   = getenv('TABLE');
print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 3.2//EN'>\n";
print "<HTML>\n";
print "    <TITLE>typedb/$serveur:$port</TITLE>\n";
print "    <HEAD>\n";
print "        <META NAME='description' CONTENT='Contenu de table de BDD'/>\n";
print "        <META HTTP-EQUIV='Content-language' CONTENT='fr'>\n";
print "        <LINK REL='stylesheet' HREF='index.css' />\n";
print "        <LINK REL='icon' TYPE='image/png' HREF='icone2.png'/>\n";
print "    </HEAD>\n";
print "    <BODY>\n";
print "    <SPAN class='titre'>Contenu de la table $table</SPAN>\n";
print "    <BR />\n";
print "    <SPAN class='titre'>Base de donn&eacute;es : $base sur $serveur:$port ($typedb)</SPAN>\n";
print "    <BR /><BR /><BR />\n";
try {
    $dbh = new PDO("$typedb:host=$serveur;port=$port;dbname=$base", $user, $paswd);
    print "        <TABLE>\n";
    $resultat = $dbh->query("SELECT * from $table LIMIT 1");
    $champs = array_keys($resultat->fetch(PDO::FETCH_ASSOC));
    foreach($dbh->query("SELECT * from $table") as $row) {
        print "            <TR>\n";
        foreach( $champs as $champ ) {
            print '                <TD>' . $row[ "$champ" ] . "</TD>\n";
        }
        print "            <TR/>\n";
    }
    print "        </TABLE>\n";
    $dbh = null;
} catch (PDOException $e) {
    print 'Erreur !: ' . $e->getMessage() . '<br/>';
    die();
}
print "    </BODY>\n";
print "</HTML>\n";
?>
