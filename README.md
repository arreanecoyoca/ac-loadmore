# ac-loadmore
a quick way to create Load more ajax funtionality in your wordpress site

## Installation
**Manually**
1. Upload the wordpress-seo folder to the /wp-content/plugins/ directory
2. Activate the Yoast SEO plugin through the ‘Plugins’ menu in WordPress
3. Go to “after activation” below

**From within WordPress**
1. Download the plugin
2. Visit "Plugins > Add New > Upload
3. Activate AC Loader plugin from your Plugins page

## After Activation
1. In your functions.php add this code `acLoadmore('post')`
2. add this script in your js or before the </body> tag
`$('.your-button').acLoadmore({ container: '#your-container' })
