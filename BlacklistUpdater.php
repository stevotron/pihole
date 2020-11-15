<?php

class BlacklistUpdater
{
  public static function go()
  {
    new self();
  }

  public function __construct()
  {
    $options = getopt('ed');

    if (isset($options['e'])) {
      $this->update(true);
      echo 'Enabled...';
    } elseif (isset($options['d'])) {
      $this->update(false);
      echo 'Disabled...';
    } else {
      echo 'Please provide a valid argument \'-e\' (enable) or \'-d\' (disable)';
    }

    echo "\n";

    exec("pihole restartdns reload");
  }

  private function update(bool $enable)
  {
    $bool = $enable ? '1' : '0';
    $command = 'sqlite3 "/etc/pihole/gravity.db" "UPDATE domainlist SET enabled = ' . $bool . ' WHERE comment LIKE \'%[auto-on-off]%\';"';
    
    exec($command);
  }
}
