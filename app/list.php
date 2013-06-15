<?php
require "includes.php";
$pdo = PDOHelper::fromConfig();
$zdj = new ZdjeciaRepository( $pdo );
$nie = new NieruchomosciRepository( $pdo );
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <style>
      .sortable li {
        cursor: pointer;
      }
    </style>
    <script>
    function sendUpdates( arr ) {
      for ( var i in arr ) {
        $.post("updatePos.php", {id: arr[i], pos: i} );
      }
    }
    $(function() {
      $( ".sortable" ).sortable({
        change: function() {
          var arr = $(this).sortable('toArray');
          sendUpdates( arr );
        }
      });
      $( ".sortable" ).disableSelection();
    });
    window.setTimeout(function() {
      $( ".sortable" ).each(function() {
        var arr = $(this).sortable('toArray');
        sendUpdates( arr );
      });
    }, 1000);
    </script>
  </head>
  <body>
<?php
$tabs = array("mieszkania", "domy", "dzialki", "lokale");
foreach ( $tabs as $tab ) {
  echo "<h2>$tab</h2>\n";
  echo "<ul class=\"sortable\">";
  foreach ( $nie->tab( $tab ) as $n ) {
    echo "<li id=\"{$n->getId()}\">";
    echo $n->getUlica();
    echo "<br/>";
    echo $n->getDzialTab();
    echo " ";
    echo $n->getDzialTyp();
    echo "<br/>";
    echo $n->getCena();
    echo "<br/>";
    foreach ( $zdj->getForNieruchomosc( $n->getId() ) as $z ) {
      echo "<img style=\"max-width:100px; max-height:100px;\" src=\"". getUrl($z->getUrl()) . "\"></img>";
    }
    echo "</li>";
  }
  echo "</ul>";
}
?>
  </body>
</html>
