<?php
/*
Plugin Name: ImmoPress
Plugin URI:  http://www.cccc.de/
Description: Erlaubt den einfachen Expose-Import von Immobilienscout24.de in WordPress.
Version:     0.0.5
Author:      4c media
Author URI:  http://www.cccc.de/
License:     GPL2

Copyright 2012 4c media (dev@cccc.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// remove when deploying
//define('WP_DEBUG', true);

require __DIR__ . '/vendor/autoload.php';

$ImmoPress = new ImmoPress();