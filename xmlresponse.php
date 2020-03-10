<?PHP
  namespace Chirp;

  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  class xmlResponse
  {

    function start()
    {
      header("Content-Type: text/xml");
      echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
      echo "<response>\n";
    }

    function command($method, $params = [], $encoded = [])
    {
      echo "  <command method=\"$method\">\n";
      if($params) {
        foreach($params as $key => $val) {
          echo "    <$key>" . htmlspecialchars($val) . "</$key>\n";
        }
      }
      if($encoded) {
        foreach($encoded as $key => $val) {
          echo "    <$key><![CDATA[$val]]></$key>\n";
        }
      }
      echo "  </command>\n";
    }

    function end()
    {
      echo "</response>\n";
      exit;
    }

  }
?>
