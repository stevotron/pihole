<?php

class BlacklistUpdater
{
  public static function go()
  {
    new self();
  }

  private function __construct()
  {
    $options = getopt('ed');

    if (isset($options['e'])) {
      $this->update('Day time only', '[day-time-only]', true);
      echo 'Domain blocking enabled...';
    } elseif (isset($options['d'])) {
      $this->update('Day time only', '[day-time-only]', false);
      echo 'Domain blocking disabled...';
    } else {
      echo 'Please provide a valid argument \'-e\' (enable) or \'-d\' (disable)';
    }

    echo "\n";
    echo 'Restarting Pi-hole DNS and reloading lists...';
    echo "\n";

    exec('pihole restartdns reload-lists');
  }

  private function update(?string $groupName, ?string $commentString, bool $enable)
  {
    $bool = $enable ? '1' : '0';

    if (isset($groupName)) {
      $escapedGroupName = SQLite3::escapeString($groupName);
      $command = 'sqlite3 "/etc/pihole/gravity.db" "UPDATE \'group\' SET enabled = ' . $bool . ' WHERE name = \\"' . $escapedGroupName . '\\";"';
      exec($command);
    }

    if (isset($commentString)) {
      $escapedCommentString = SQLite3::escapeString($commentString);
      $command = 'sqlite3 "/etc/pihole/gravity.db" "UPDATE domainlist SET enabled = ' . $bool . ' WHERE comment LIKE \\"%' . $escapedCommentString . '%\\";"';
      exec($command);
    }
  }
}
