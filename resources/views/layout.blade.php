<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- @vite(['resources/css/destyle.css', 'resources/css/main.css', 'resources/css/app.css']) -->
    <style>
/* destyle.css */

/*! destyle.css v4.0.0 | MIT License | https://github.com/nicolas-cusan/destyle.css */

/* Reset box-model and set borders */
/* ============================================ */

*,
::before,
::after {
  box-sizing: border-box;
  border-style: solid;
  border-width: 0;
}

/* Document */
/* ============================================ */

/**
 * 1. Correct the line height in all browsers.
 * 2. Prevent adjustments of font size after orientation changes in iOS.
 * 3. Remove gray overlay on links for iOS.
 */

html {
  line-height: 1.15; /* 1 */
  -webkit-text-size-adjust: 100%; /* 2 */
  -webkit-tap-highlight-color: transparent; /* 3*/
}

/* Sections */
/* ============================================ */

/**
 * Remove the margin in all browsers.
 */

body {
  margin: 0;
}

/**
 * Render the `main` element consistently in IE.
 */

main {
  display: block;
}

/* Vertical rhythm */
/* ============================================ */

p,
table,
blockquote,
address,
pre,
iframe,
form,
figure,
dl {
  margin: 0;
}

/* Headings */
/* ============================================ */

h1,
h2,
h3,
h4,
h5,
h6 {
  font-size: inherit;
  font-weight: inherit;
  margin: 0;
}

/* Lists (enumeration) */
/* ============================================ */

ul,
ol {
  margin: 0;
  padding: 0;
  list-style: none;
}

/* Lists (definition) */
/* ============================================ */

dt {
  font-weight: bold;
}

dd {
  margin-left: 0;
}

/* Grouping content */
/* ============================================ */

/**
 * 1. Add the correct box sizing in Firefox.
 * 2. Show the overflow in Edge and IE.
 */

hr {
  box-sizing: content-box; /* 1 */
  height: 0; /* 1 */
  overflow: visible; /* 2 */
  border-top-width: 1px;
  margin: 0;
  clear: both;
  color: inherit;
}

/**
 * 1. Correct the inheritance and scaling of font size in all browsers.
 * 2. Correct the odd `em` font sizing in all browsers.
 */

pre {
  font-family: monospace, monospace; /* 1 */
  font-size: inherit; /* 2 */
}

address {
  font-style: inherit;
}

/* Text-level semantics */
/* ============================================ */

/**
 * Remove the gray background on active links in IE 10.
 */

a {
  background-color: transparent;
  text-decoration: none;
  color: inherit;
}

/**
 * 1. Remove the bottom border in Chrome 57-
 * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
 */

abbr[title] {
  text-decoration: underline dotted; /* 2 */
}

/**
 * Add the correct font weight in Chrome, Edge, and Safari.
 */

b,
strong {
  font-weight: bolder;
}

/**
 * 1. Correct the inheritance and scaling of font size in all browsers.
 * 2. Correct the odd `em` font sizing in all browsers.
 */

code,
kbd,
samp {
  font-family: monospace, monospace; /* 1 */
  font-size: inherit; /* 2 */
}

/**
 * Add the correct font size in all browsers.
 */

small {
  font-size: 80%;
}

/**
 * Prevent `sub` and `sup` elements from affecting the line height in
 * all browsers.
 */

sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

/* Replaced content */
/* ============================================ */

/**
 * Prevent vertical alignment issues.
 */

svg,
img,
embed,
object,
iframe {
  vertical-align: bottom;
}

/* Forms */
/* ============================================ */

/**
 * Reset form fields to make them styleable.
 * 1. Make form elements stylable across systems iOS especially.
 * 2. Inherit text-transform from parent.
 */

button,
input,
optgroup,
select,
textarea {
  -webkit-appearance: none; /* 1 */
  appearance: none;
  vertical-align: middle;
  color: inherit;
  font: inherit;
  background: transparent;
  padding: 0;
  margin: 0;
  border-radius: 0;
  text-align: inherit;
  text-transform: inherit; /* 2 */
}

/**
 * Correct cursors for clickable elements.
 */

button,
[type="button"],
[type="reset"],
[type="submit"] {
  cursor: pointer;
}

button:disabled,
[type="button"]:disabled,
[type="reset"]:disabled,
[type="submit"]:disabled {
  cursor: default;
}

/**
 * Improve outlines for Firefox and unify style with input elements & buttons.
 */

:-moz-focusring {
  outline: auto;
}

select:disabled {
  opacity: inherit;
}

/**
 * Remove padding
 */

option {
  padding: 0;
}

/**
 * Reset to invisible
 */

fieldset {
  margin: 0;
  padding: 0;
  min-width: 0;
}

legend {
  padding: 0;
}

/**
 * Add the correct vertical alignment in Chrome, Firefox, and Opera.
 */

progress {
  vertical-align: baseline;
}

/**
 * Remove the default vertical scrollbar in IE 10+.
 */

textarea {
  overflow: auto;
}

/**
 * Correct the cursor style of increment and decrement buttons in Chrome.
 */

[type="number"]::-webkit-inner-spin-button,
[type="number"]::-webkit-outer-spin-button {
  height: auto;
}

/**
 * Correct the outline style in Safari.
 */

[type="search"] {
  outline-offset: -2px; /* 1 */
}

/**
 * Remove the inner padding in Chrome and Safari on macOS.
 */

[type="search"]::-webkit-search-decoration {
  -webkit-appearance: none;
}

/**
 * 1. Correct the inability to style clickable types in iOS and Safari.
 * 2. Fix font inheritance.
 */

::-webkit-file-upload-button {
  -webkit-appearance: button; /* 1 */
  font: inherit; /* 2 */
}

/**
 * Fix appearance for Firefox
 */
[type="number"] {
  -moz-appearance: textfield;
}

/**
 * Clickable labels
 */

label[for] {
  cursor: pointer;
}

/* Interactive */
/* ============================================ */

/*
 * Add the correct display in Edge, IE 10+, and Firefox.
 */

details {
  display: block;
}

/*
 * Add the correct display in all browsers.
 */

summary {
  display: list-item;
}

/*
 * Remove outline for editable content.
 */

[contenteditable]:focus {
  outline: auto;
}

/* Tables */
/* ============================================ */

/**
1. Correct table border color inheritance in all Chrome and Safari.
*/

table {
  border-color: inherit; /* 1 */
  border-collapse: collapse;
}

caption {
  text-align: left;
}

td,
th {
  vertical-align: top;
  padding: 0;
}

th {
  text-align: left;
  font-weight: bold;
}






        /* main.css */
        @charset "utf-8";

/*共通事項
--------------------*/
html{
	font-size: 100%;
}
body{
	font-family: "Helvetica Neue", "Helvetica", "Hiragino Sans", "Hiragino Kaku Gothic ProN", "Arial", "Yu Gothic medium", "Meiryo", sans-serif;
	color: #111;
	line-height: 1.8;
}
img{
	max-width: 100%;
	height: auto;
}
a{
	text-decoration: none;
	color: #000000;
	transition: 0.2s;
}
a:hover{
	opacity: 0.5;
	transition: 0.3s;
}

/*汎用block
-------------*/

.wrapper{
	width: 1024px;
	margin: 0 auto;
}



/*header
-------------*/
header{
    padding: 20px 0;
	display: flex;
}
header h1{
	width: 50%;
	
}
.main-nav ul{
	display: flex;
}
.main-nav ul li{
	margin-right: 30px;
}

.sns-nav ul{
	display: flex;
	width: 60%;
	padding-top: 10px;
}
.sns-nav ul li{
	margin-right: 10px;
}



/*main
---------------------*/
main{
	text-align: center;
}
h2{
	font-size: 30px;
	padding: 40px;
}
dl{
	display: flex;
}
dt{
	padding: 0 100px 20px 100px;
}
dd{
	text-align: left;
}
strong{
	font-weight: bold;
}
.more{
	text-align: right;
	text-decoration: underline;
	padding: 30px 0 20px 0;
}
button{
	background-color: white;
	border:2px solid;
	border-color: black;
	padding: 15px 60px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 20px;
	margin: 30px 30px;
	cursor: pointer;
}



.menu ul{
	display: flex;
	padding-top: 20px;
	
}
.menu ul li{
	width: 80%;
	margin: 10px 30px;
}

/*footer
-----------------------*/

footer{
	text-align: center;
}
.footer-nav ul{
	display: flex;
	padding-left: 400px;
}
.footer-nav ul li{
	padding: 40px 20px;
}
.footer-logo{
	padding: 0 0 30px 0;
}
.pec{
	text-align: left;
	padding-left: 210px;
}
.copy{
	padding: 40px 0 20px 0;
}


    </style>
    <title>Document</title>
</head>
<body>
    <header class="wrapper header-contents">
        <h1></h1>
        <nav class="main-nav">
            <ul>
                <li>ホーム</li>
                <li>人気ブレンド</li>
                <li>ご利用案内</li>
                <li>カート</li>
            </ul>
        </nav>
    </header>
    @yield('content')
</body>
</html>