# Description

A shortcode to add a suitable unit of time to a dynamic date. Uses some fuzzy-
logic to display units of time. 

*  Units are "days", "weeks", "months" or "years".
*  Only the most significant unit will be shown.
*  More of a lesser unit are preferred over fractions. Example: '6 weeks' and 
not '1.5 months' or '15 months' and not '1.25 years'.
*  Whole larger units are preferred over multiple smaller units. Example '1 
month' and not '4 weeks'.
*  less significant units are truncated. Example '3 weeks and 6 days' will 
become just '3 weeks'.


## Shortcode Usage

To show your age, fill in the shortcode attributes with your birth date. Example
suppose I was a millenium baby, born on the first of January, 2000. I would show
my age with:

    I am [get_age year"2000" month="01" day="01"] old.
    
In 2013 this would show my age as

    I am 13 years old.
    

## Usage

**shortcode name:**

**`get_age`** - `[get_age year="yyyy" month="mm" day="dd"]` 

**shortcode attributes**:

**`year`** *(manditory)* - a 4 digit year code.

**`month`** *(manditory)* - 2 digit month, indexing from 1 eg. `January` = `01`.S

**`day`** *(manditory)* - 2 digit day, indexing from 1.

If `year` `month` or `day` are missing an `ERROR` is returned indicating the 
missing field(s).


# Installation

This WordPress plugin consists of a single `.php` file.

1.  Upload the `get-age.php` file to your `/wp-content/plugins/` directory.
2.  Activate it through the 'Plugins' menu in WordPress. No more configuration
necessary.


# Change Log

## Versions

### 1.0

*  Initial Release

# ToDo List

*  Add multilingual support