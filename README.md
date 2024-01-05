# ACME Widget Co code challenge

*WARNING: Not intended for use.*
==
---

## Description
This is part of a coding challenge meant to be completed, as much as possible, in ~4 hours. There are incomplete classes and methods.

This is a basic shopping cart with some rudimentary discount abilities, namely a BOGO 50% offer and a reduced shipping rates based on spend.

## Prerequisites
* [PHP](https://www.php.net/downloads.php) - I used 8.3 which was the most current stable at the time.
* [Composer](https://getcomposer.org/download/) - Install it local to the project or globally. 

## Getting Started

* Clone or otherwise download this project
* `composer install` or `php composer.phar install` depending on how you installed Composer.

## Assumptions

* There is no tax
* Discounts are applied prior to shipping.
* Only one discount per order and currently only applies to one qualifying product (if 4 Red Widgets are in the cart only 1 will be 50% off).
* I'm passing and displaying prices as integers to keep it simple and less error prone.
* Catalogs, products lists, shipping rates, etc would be retrieved from a resource.

## Usage

There is n browser or other useful interface at this time. You will need to run the unit tests to verify functionality.

* Run the test(s) `./vendor/phpunit/phpunit/phpunit tests/CartTest.php`


---
## Coding Challenge Instructions

### Acme Widget Co

Acme Widget Co are the leading provider of made up widgets and they’ve contracted you to create a proof of concept for their new sales system.

They sell three products –

| Product      | Code | Price  |
|--------------|------|--------|
| Red Widget   | R01  | $32.95 |
| Green Widget | G01  | $24.95 |
| Blue Widget  | B01  | $7.95  |

To incentivise customers to spend more, delivery costs are reduced based on the amount spent. Orders under $50 cost $4.95. For orders under $90, delivery costs $2.95. Orders of $90 or more have free delivery.

They are also experimenting with special offers. The initial offer will be “buy one red widget, get the second half price”.

Your job is to implement the basket which needs to have the following interface –

* It is initialised with the product catalogue, delivery charge rules, and offers (the format of how these are passed it up to you)
* It has an add method that takes the product code as a parameter.
* It has a total method that returns the total cost of the basket, taking into account
the delivery and offer rules.

Here are some example baskets and expected totals to help you check your implementation.

| Products                | Total  |
|-------------------------|--------|
|  B01, G01               | $37.85 |
| R01, R01                | $54.37 |
| R01, G01                | $60.85 |
| B01, B01, R01, R01, R01 | $98.27 |

What we expect to see –

* A solution written in easy to understand and update PHP
* A README file explaining how it works and any assumptions you’ve made
* Pushed to a public Github repo
