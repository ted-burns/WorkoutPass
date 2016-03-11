  <?php
function generate_hash() {
  return string_random('0123456789abcdef', 32);
}

function string_random($characters, $length)
{
  $string = '';
  for ($max = mb_strlen($characters) - 1, $i = 0; $i < $length; ++ $i)
  {
    $string .= mb_substr($characters, mt_rand(0, $max), 1);
  }
  return $string;
}
?>
