<?php
/**
 * Password generator script
 * @author  Rutger Laurman (twitter.com/lekkerduidelijk)
 */

  // Set default number of passwords to generate
  $amount = isset($_GET['amount']) ? $_GET['amount'] : 5;

  // Set default length
  $length = isset($_GET['length']) ? $_GET['length'] : 8;

  // Create random string with given length
  // Uses ASCII table for speed improvement
  function generatePassword($length){
    $length = intval($length);
    $returnString = '';
    for ($count = 0; $count < $length; $count++) {
      switch (mt_rand(0,3)) {
        case 0:
          $char = array(33, 35, 36, 37, 63, 64); // ! # $ % ? @
          $char = chr($char[array_rand($char)]);
          break;
        case 1:
          $char = chr(mt_rand(97,122)); // a to z
          break;
        case 2:
          $char = chr(mt_rand(48,57)); // 0 to 9
          break;
        case 3:
          $char = chr(mt_rand(65,90)); // A to Z

      }
      $returnString .= $char;
    }
    // Convert ASCII chars to HTML valid characters
    return htmlentities($returnString);
  }
?>
<html>
<head>
  <title>Password generator</title>
  <style type="text/css">
    * { font-family: Helvetica,Arial,Verdana,sans-serif; }
    p { color: #444; }
    input, button { font-size: 16px; }
    label, button { cursor: pointer; }
    pre { font-size: 17px; font-family: monospace; }
    small { color: #999; text-align: right; }
    li { line-height: 180%; }
    li input { font-family: monospace; }
  </style>
</head>
<body>
  <h1>Password generator</h1>
  <p id="predefined">
    <a href="<?php echo $_SERVER['PHP_SELF'];?>">Default</a> |
    <a href="<?php echo $_SERVER['PHP_SELF'];?>?amount=5&amp;length=24" title="24 chars">MySQL</a> |
    <a href="<?php echo $_SERVER['PHP_SELF'];?>?amount=5&amp;length=12">12</a> |
    <a href="<?php echo $_SERVER['PHP_SELF'];?>?amount=5&amp;length=16">16</a>
  </p>
  <form method="get">
    <fieldset>
      <legend>Generate passwords</legend>
      <p>
        Give me <input type="text" name="amount" size="2" value="<?php echo $amount ?>" />
        passwords with
        <input type="text" name="length" size="2" value="<?php echo $length ?>" />
        characters.
        <button type="submit">Generate</button>
      </p>
    </fieldset>
   </form>
   <ol>
   <?php // Show passwords on screen
    for($i = 0; $i < $amount; $i++) : ?>
     <li><input value="<?php echo generatePassword($length) ?>" size="<?php echo $length ?>" /></li>
    <?php endfor; ?>
  </ol>
  <hr>
  <small>coded by <a href="http://github.com/lekkerduidelijk">lekkerduidelijk</a></small>
</body>
</html>
