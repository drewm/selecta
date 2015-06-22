# Selecta: write HTML with a CSS selector

[![Build Status](https://travis-ci.org/drewm/selecta.svg)](https://travis-ci.org/drewm/selecta)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/drewm/selecta/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/drewm/selecta/?branch=master)

Use a CSS selector to wrap your content with HTML tags.

```php
echo Selecta::wrap('h1.welcome', 'Hello, world');
```

will output:

```html
<h1 class="welcome">Hello, world</h1>
```

## Why?

Sometimes you need to output a quick bit of HTML at a point where it's really inconvenient to use a full template. Creating strings of HTML in your code is horrible, so this something a bit more humane. 

## Usage

Currently supports IDs, classes and attribute selectors.

### Class names

```php
echo Selecta::wrap('ul.list li', 'So listy');
```

will output:

```html
<ul class="list"><li>So listy</li></ul>
```

### IDs

```php
echo Selecta::wrap('div#contact', 'Call me');
```

will output:

```html
<div id="contact">Call me</div>
```

### Attribute and Pseudo-class selectors

```php
echo Selecta::build('input[type=radio][name=color][value=blue]:checked');
```

will output:

```html
<input type="radio" name="color" value="blue" checked>
```

Currently supports `:checked` and `:disabled` pseudo-classes.

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

## Methods

The following methods are available:

`Selecta::wrap(selector, contents)` will wrap the contents with the tags created by the selector.

`Selecta::open(selector)` will open the tags created by the selector.

`Selecta::close(selector)` will close the tags created by the selector. Note that the order of tags is reversed - you can use the same selector string with `open()` and `close()` to get valid tag pairs.

`Selecta::build(selector, contents, open, close)` will do everything - build the tags, optionally wrap the contents, optionally open and optionally close the tags. 

### Opening and closing

Don't have a template to hand but need to output some structural markup?

```php
echo Selecta::open('section.sidebar div');
echo $CMS->display_all_my_weird_sidebar_junk();
echo Selecta::close('section div');
```

