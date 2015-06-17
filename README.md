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

```php
echo Selecta::build('ul#list.mr-list li[required] div.foo.bar input[name=hell][type=radio][value=yes][checked][required]');
```

will output:

```html
<ul id="list" class="mr-list">
	<li required>
		<div class="foo bar">
			<input name="hell" type="radio" value="yes" checked required>
		</div>
	</li>
</ul>
```

(indented for readability)

## Why?

Well, quite.