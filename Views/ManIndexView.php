
Short description: that script accepts the different data sources with array data, does some calculations,
and out it as formatted table.

You can use json/php files for import or plaintext parameter (with data in json format).

--------------------------------------------------------------------------------

man - show this screen

import <json/php> <path to file> - use external file for import

plaintext json <correct json string> - use data from parameter directly

--------------------------------------------------------------------------------

Json-file should be correct json data-set (array of enities), ex: [{"xxx":"123"},{"xxx":"456","qqq":"www"}]

Php-file should be valid file with $raw_data variable, which contains the data

Plaintext parameter should be correct as json and quoted (for CLI correct work). Ex. (both types of quotes are mandatory): '[{"xxx":"123"},{"xxx":"456","qqq":"www"}]'

