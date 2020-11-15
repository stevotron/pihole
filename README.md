# pihole

Enable/disable specific entries in the `domainlist` table.

Any entry with a comment including the string `[auto-on-off]` will be enabled/disabled when the script is run.

Add a couple of crobjobs to enable blacklisting of distracting websites at night,

`sudo crontab -e`

Update with,

```
00 09 * * * sudo /usr/bin/php /path/to/script.php -d
30 21 * * * sudo /usr/bin/php /path/to/script.php -e
```

### Next steps

Make use of pihole groups?
