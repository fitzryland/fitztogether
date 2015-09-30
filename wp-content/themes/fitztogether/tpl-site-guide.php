<?php /** tpl-site-guide.php **/
/*
Template Name: Site Guide Template
*/


get_header();

?>
<div class="main container">
    <div class="single_post_content">
        <h4>Site Guide</h4>
        <p style="font-size:18px;"><em>Visit the PixelSpoke WordPress Documentation site for information on <a href="http://docs.pixelspoke.com/docs/getting-started/">getting started</a>.</em></p>
        <ul>
          <li><a href="#sample-copy">Sample Copy</a></li>
          <li><a href="#image-sizes">Image Sizes</a></li>
          <li><a href="#content-info">Content Information</a></li>
        </ul>
        <div class="hr"><hr /></div>
        <h1 id="sample-copy">Sample Header 1 &mdash; stacked with headers</h1>
        <h2>Sample Header 2</h2>
        <h3>Sample Header 3</h3>
        <h4>Sample Header 4</h4>
        <h4>Sample Header 5</h4>
        <hr>
        <h1>Sample Header 1 &mdash; stacked with text</h1>
        <p><strong>Sample paragraph text</strong>: Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a href="#">Sample Link</a>.</p>
        <h2>Sample Header 2</h2>
        <p><strong>Sample paragraph text</strong>: Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a href="#">Sample Link</a>.</p>
        <h3>Sample Header 3</h3>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a href="#">Sample Link</a>.</p>
        <h4>Sample Header 4</h4>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        <h4>Sample Header 5</h4>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a href="#">Sample Link</a>.</p>
        <ul>
          <li><strong>Sample unordered list</strong>: Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
          <li>Aliquam tincidunt mauris eu risus.</li>
          <li>Vestibulum auctor dapibus neque.</li>
        </ul>
        <h3>Header 3</h3>
        <ol>
          <li><strong>Sample ordered list</strong>: Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
          <li>Aliquam tincidunt mauris eu risus.</li>
          <li>Vestibulum auctor dapibus neque.</li>
        </ol>
        <div class="hr"><hr /></div>
        <h2 id="image-sizes">Image Sizes</h2>
        <p><em>Note that .png and .gif files uploaded through the WordPress admin will not have the border and shadow displayed on pages. Only .jpg files will display borders and shadows.</em></p>
        <h3>Large Image &mdash; (650px max width in content area)</h3>
        <p><img class="alignnone" src="http://dummyimage.com/650x432/F26522/fff" alt="Large Image" width="650" height="432" /></p>
        <h3>Medium Image &mdash; (370px max width in content area)</h3>
        <p><img class="alignnone" src="http://dummyimage.com/370x246/F26522/fff" alt="Medium Image" width="370" height="246" /></p>
        <?php
        $smallw = '250';
        $smallh = '166';
        ?>
        <h3>Small Image &mdash; (<?php echo $smallw; ?>px max width in content area)</h3>
        <p><img class="alignnone" src="http://dummyimage.com/<?php echo $smallw; ?>x<?php echo $smallh; ?>/F26522/fff" alt="Small Image" width="<?php echo $smallw; ?>" height="<?php echo $smallh; ?>" /></p>
        <div class="hr"><hr /></div>
        <h2 id="content-info">Content Information</h2>
        <h3>Page Templates</h3>
        <ul>
          <li>Default Template</li>
          <li>Homepage Template &mdash; (<a href="<?php echo get_page_link(2); ?>">2</a>)</li>
          <li>Contact Page Template &mdash; (<a href="<?php echo get_page_link(4); ?>">4</a>)</li>
          <li>Sitemap Template &mdash; (<a href="<?php echo get_page_link(35); ?>">35</a>)</li>
          <li>Site Guide &mdash; (<a href="<?php echo get_page_link(45); ?>">45</a>)</li>
        </ul>
        <h3>Editable Custom Fields</h3>
        <p>The custom field area is located below the main body content editor.</p>
        <ul>
          <li>Home (<a href="<?php echo get_page_link(2); ?>">2</a>) &mdash; <em>Homepage Boxes</em>
            <ul>
              <li><code>Paragraph text</code></li>
              <li><code>Unordered list items</code></li>
              <li><code>Images with a max width of 254px</code></li>
            </ul>
          </li>
          <li>Home (<a href="<?php echo get_page_link(2); ?>">2</a>) &mdash; <em>Editable Sidebar CTAs</em>
            <ul>
              <li><code>&lt;h4&gt;Heading 4&lt;/h4&gt;</code></li>
              <li><code>Paragraph Text</code></li>
              <li><code>Unordered list items</code></li>
              <li><code>Images with a max width of 190px</code></li>
            </ul>
          </li>
        </ul>
        <h3>Icons</h3>
        <ul>
          <li><a href="mailto:docs@pixelspoke.com">Email PixelSpoke</a></li>
          <li><a href="#.pdf">Download a PDF Document</a></li>
          <li><a href="#.xls">Download a Excel Document</a></li>
          <li><a href="#.vcf">Download a vCard</a></li>
          <li><a href="#.doc">Download a Word Document</a></li>
          <li><a href="#.rss">Subscribe a Feed</a></li>
        </ul>
        <h3>Calls to Action</h3>
        <p><em>Calls to action are located in the sidebar.</em></p>
        <h3>Shortcodes</h3>
        <ul>
          <li><code>&#91;clear&#93;</code> can be used to clear floated images.</li>
          <li><code>&#91;hr&#93;</code> can be used to display a horizontal rule.</li>
          <li><code>&#91;button&#93;Your Text&#91;/button&#93;</code> displays a button.</li>
          <li><code>&#91;smalltext&#93;Your Text&#91;/smalltext&#93;</code> displays small text.</li>
          <li><code>&#91;bigtext&#93;Your Text&#91;/bigtext&#93;</code> displays small text.</li>
        </ul>
        <h3>Plugins Used for Copy</h3>
        <ul>
          <li><a href="http://docs.pixelspoke.com/docs/plugins/custom-field-template/">Advanced Custom Fields</a></li>
          <li><a href="http://docs.pixelspoke.com/docs/plugins/all-in-one-seo-pack/">All in One SEO Pack</a></li>
          <li><a href="http://docs.pixelspoke.com/docs/plugins/pagemash/">pageMash</a></li>
          <li><a href="http://docs.pixelspoke.com/docs/plugins/tinymce-advanced/">TinyMCE Advanced</a></li>
          <li><a href="http://docs.pixelspoke.com/docs/plugins/wp-jump-menu/">WP Jump Menu</a></li>
        </ul>
    </div><!-- .container -->
</div><!-- .main -->

<?php get_footer(); ?>
