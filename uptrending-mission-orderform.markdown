# Mission: International Order Form
- **Tests** API integration, PHP, Javascript, problem solving
- **Difficulty** 4/5
- **Est. Time** 4 hours

## Briefing
A client wants to test the market for branded merchandise and they're starting off with a single 3D printed statue of their logo. The shipping is flat rate and international customers need to pay a different price. We must show the user the relevant price on page load, so the price needs to display the right price based on the user's location.

## Objective
The client would like to see a *proof of concept* app that accomplishes the following:

### Display a single product for sale
The price for US visitors is $20, outside the US is $25, Asian & Pacific countries (see [footnotes](#country-list) for list) are $30

### Sell the product
Process the orders through Stripe.com and store the order details - name, address & stripe confirmation number

## Requirements
1. Create a blank, public GitHub repo when you receive the mission and add "adriangonzales" as a collaborator
2. Price must be displayed correctly without user interaction
3. Stripe credentials should be configurable
Store orders in any datastore that doesn't require a separate server. (ex. text, csv, sqlite)
4. When complete, push your code to the repo and email [Adrian](mailto:adrian@uptrending.com)

### Technical Notes:
Don't worry about presentation at all, you can use the [HTML5 logo](http://www.w3.org/html/logo/) as an example image if you want. Use any (or no) framework you feel comfortable with, just stick to PHP for server-side. Utilize any libraries, APIs, or services where appropriate.

<a name="country-list"></a>**Asian & Pacific Countries:** Australia, Japan, Korea, India, Singapore, Philippines, China, Taiwan. All non-US countries not listed here receive International pricing.


---------- DEV WORK START ------------------

[[[ User Flow ]]]
1. User goes to page
2. User sees product w/ adjusted pricing based on browser geo-location
3. User clicks on "purchase"
4. User enters purchase information
5. User clicks on "complete purchase"
6. User gets purchase results message and email (if successful)


[[ Request Handler ]]

	[ General Request Parsing & Rendering ]

 

[[[ Components ]]]

	[[ Pages / Forms ]]

		[ Landing Page ]

		[ Purchase Info Form ]

		[ Purchase Results Page ]


 
[[ Payment Processor ]]

	[ Processor Handler ]

	[ Stripe API Processing ]



[[ Order Serializer ]]

	[ Serializer Handler ]

	[ CSV Serializer ]


Tasks:

[ok] - Browser geo location proof-of-concept
-- https://support.stripe.com/questions/can-i-display-prices-in-my-customers-local-currency 
-- http://stackoverflow.com/questions/4179000/best-way-to-detect-country-location-of-visitor 
[ok] - Stripe api proof-of-concept
-- https://stripe.com/docs/checkout/guides/php 
[ok] - CSV writer proof-of-concept
-- http://csv.thephpleague.com/installation/ 
-- https://github.com/parsecsv/parsecsv-for-php 
-- http://www.tutorialchip.com/php-csv-parser-class/

[ok] - application shell
[ok] - request handler / template renderer

[ok] - landing page template
[ok] - purchase info template
[ok] - purchase results template

[ok] - geolocated pricing structure

[X] - payments handler
[ok] - stripe payments processing

[ok] - payments results display

[X] - order serializer handler
[ok] - csv order saving

[ok] - geolocated pricing display








