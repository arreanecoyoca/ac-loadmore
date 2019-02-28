# ac-loadmore
a quick way to create Load more ajax funtionality in your wordpress site

## Installation
**Manually**
1. Upload the ac-loader folder to the /wp-content/plugins/ directory
2. Activate the Yoast AC Loader through the ‘Plugins’ menu in WordPress
3. Go to “after activation” below

**From within WordPress**
1. Download the plugin
2. Visit "Plugins > Add New > Upload
3. Activate AC Loader plugin from your Plugins page

## After Activation
1. In your functions.php add this code 
```
acLoadmore('post');
```
2. add this script in your js or before the </body> tag
```
$('#your-button').acLoadmore({ container: '#your-container' });
```
3. add this in your html file
```
<div id="your-container">

  // this is where the ajax response will run
  
</div>
<button id="your-button">Read More</button> // the button that will trigger the ajax call
```
4. Create a template file in your theme `ac-loadmore-<post_type>.php`
in this example, since we are showing the post as the post type. Let's name our file as `ac-loadmore-post.php`
```
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

<?php the_excerpt(); ?>

<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
```

## $.acLoadmore Parameters
| Syntax | Description |
| ----------- | ----------- |
| Header | Title |
| Paragraph | Text | 
