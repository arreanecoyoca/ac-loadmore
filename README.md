# AC Loadmore
A quick way to create Load more ajax funtionality in your wordpress site for your post, page, or any custom post types.

- no php code needed!
- just html and jquery is all you need!


## Installation
**Manually**
1. Upload the ac-loader folder to the /wp-content/plugins/ directory.
2. Activate AC Loader plugin from your Plugins page.

**From within WordPress**
1. Download the plugin.
2. Visit "Plugins > Add New > Upload.
3. Upload the .zip file and click `install now`.
4. Activate AC Loader plugin from your Plugins page.


## After Activation
1. Add this anywhere on your code where you want to display the file.
```
<div id="your-container">

  // this is where the ajax response will run
  
</div>
<button id="your-button">Read More</button> // the button that will trigger the ajax call
```

2. Add this script in your js or anywhere before the `</body>` tag.
```
<script>
jQuery(function($){
  $('#your-button').acLoadmore({ container: '#your-container' });
});
</script>
```
or use the code below if you need to query custom post types with extra arguments.
See here https://v2.wp-api.org/reference/posts/ for more wp_query options.
```
<script>
jQuery(function($){
  $('#your-button').acLoadmore({
    container: '#your-container',
    wp_query: {
      post_type: 'post', // the post type you want to display
      per_page: 5 // number of posts to retrieve,
      done: function(){ alert('ajax success'); },
      fail: function(){ alert('ajax failed'); },
      always: function(){ alert('ajax done'); }
    }
  });
});
</script>
```

3. Create a template file in your theme `ac-loadmore-<post_type>.php`.
In this example, since we are showing the post as the post type. Let's name our file as `ac-loadmore-post.php`.
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
| done | function | none | Event gets triggered after ajax call is successful |
| fail | function | none | Event gets triggered when ajax call fails |
| done | function | none | Event gets triggered everytime after ajax call |

### WP Query Object
| Parameter | Type | Default | Description |
| ----------- | ----------- | ----------- | ----------- |
| post_type | string | post | the post type of your query |
| per_page | int | the value set in `Settings > Reading > Blog pages show at most` | the amount of posts to return |
| page | int | 1 | the page pagination to start the query |

See https://v2.wp-api.org/reference/posts/ for more wp_query options

