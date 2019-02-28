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
<?php acLoadmore('post'); ?>
```
2. add this in your html file
```
<div id="your-container">

  // this is where the ajax response will run
  
</div>
<button id="your-button">Read More</button> // the button that will trigger the ajax call
```

3. add this script in your js or before the `</body>` tag
```
<script>
jQuery(function($){
  $('#your-button').acLoadmore({ container: '#your-container' });
});
</script>
```
or
```
<script>
jQuery(function($){
  $('#your-button').acLoadmore({
    container: '#your-container',
    wp_query: {
      post_type: 'post',
      posts_per_page: 5
    }
  });
});
</script>
```

4. Create a template file in your theme `ac-loadmore-<post_type>.php`
in this example, since we are showing the post as the post type. Let's name our file as `ac-loadmore-post.php`
```
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

<?php the_excerpt(); ?>

<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
```

---

## $.acLoadmore Parameters
| Parameter | Type | Default | Description |
| ----------- | ----------- | ----------- | ----------- |
| container | string | none | the `id` or `class` of your container on where the ajax data will showy |
| wp_query | object | | an object containing the data for your wordpress query. see WP `Query table` below for more information |

### WP Query Object
| Parameter | Type | Default | Description |
| ----------- | ----------- | ----------- | ----------- |
| post_type | string | post | the post type of your query |
| posts_per_page | int | the value set in `Settings > Reading > Blog pages show at most` | the amount of posts to return |
| per_page | int | 1 | the page pagination to start the query |

See https://v2.wp-api.org/reference/posts/ for more wp_query options

