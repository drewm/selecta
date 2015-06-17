# Selecta: write HTML with a CSS selector

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