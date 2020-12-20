# Pi-hole

## Setup

Enable/disable specific entries in the `domainlist` table or groups using the `group` table.

The group called "Night block" or any entry with a comment including the string `[night-block]` will be enabled/disabled when the script is run.

Add a couple of crobjobs to enable blacklisting of distracting websites at night,

`sudo crontab -e`

```
00 09 * * * sudo /usr/bin/php /path/to/script.php -d
30 21 * * * sudo /usr/bin/php /path/to/script.php -e
```

## Distracting domains

### YouTube

googlevideo.com  
youtu.be  
youtube-nocookie.com  
youtube.com  
youtube.googleapis.com  
youtubei.googleapis.com  
ytimg.com  
ytimg.l.google.com  

## Next steps

Allow group names and comment strings to be passed through from the command line?
