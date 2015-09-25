# htmlpurifier-filter_camo
HTMLPurifier Filter to convert images to route through a camo proxy server

## Camo Server
Make sure you have a working setup of Camo before enabling this, otherwise your images will not show.
For more information, see this repo.
[https://github.com/atmos/camo](https://github.com/atmos/camo)

## Install
Add Camo.php to the /lib/htmlpurifiercustom directory in your Mahara web root.

You will need to edit the Camo.php file to add in your Camo server URL and key at lines 23/24

Edit filters.xml in the same directory to add the following
<filter>
    <filename>Camo</filename>
    <site>YOUR CAMO URL</site>
</filter>

Log into Mahara and go to /admin/extensions/filter.php

Click install
