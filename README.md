# Selecta: write HTML with a CSS selector

[![Build Status](https://travis-ci.org/drewm/selecta.svg)](https://travis-ci.org/drewm/selecta)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/drewm/selecta/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/drewm/selecta/?branch=master)

## Usage

```php
echo Selecta::build('h1.welcome', 'Hello, world');
```

will output:

```html
<h1 class="welcome">Hello, world</h1>
```

Currently supports IDs, classes and attribute selectors.

### Class names

```php
echo Selecta::build('ul.list li');
```

will output:

```html
<ul class="list"><li></li></ul>
```

### IDs

```php
echo Selecta::build('div#contact');
```

will output:

```html
<div id="contact"></div>
```

### Attribute selectors

```php
echo Selecta::build('input[type=radio][name=color][value=blue][checked]');
```

will output:

```html
<input type="radio" name="color" value="blue" checked>
```

### Mix it up

All these can be combined and stacked:

```php
echo Selecta::build('form#contact div.field input[type=text][required]');
```

will output (indented for clarity):

```html
<form id="contact">
	<div class="field">
		<input type="text" required>
	</div>
</form>
```

## Why?

Sometimes you need to output a quick bit of HTML at a point where it's really inconvenient to use a full template. Creating strings of HTML in your code is horrible, so this something a bit more humane. 